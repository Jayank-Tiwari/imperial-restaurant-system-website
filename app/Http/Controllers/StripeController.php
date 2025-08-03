<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use App\Mail\OrderPlaced;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    /**
     * Start Stripe Checkout session
     */
    public function checkout()
    {
        $data = Session::get('delivery_order');

        if (!$data) {
            return redirect()->route('checkout')->with('error', 'No pending order.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => ['name' => 'Imperial Spice Delivery Order'],
                        'unit_amount' => $data['total'] * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.payment.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout'),
        ]);

        return redirect($session->url);
    }

    /**
     * Handle successful payment
     */
    public function paymentSuccess()
    {
        $stripeSessionId = request()->get('session_id');

        if (!$stripeSessionId) {
            return redirect()->route('menu')->with('error', 'Invalid session.');
        }

        $data = Session::pull('delivery_order');
        if (!$data) {
            return redirect()->route('menu')->with('error', 'No pending order.');
        }

        $cartItems = CartItem::where('user_id', $data['user_id'])->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Cart is empty.');
        }

        // ✅ Create order
        $order = Order::create([
            'user_id' => $data['user_id'],
            'payment_status' => 'paid',
            'payment_method' => 'card',
            'order_status' => 'confirmed',
            'total_amount' => $data['total'],
            'delivery_type' => 'delivery',
            'delivery_address' => $data['address'],
            'delivery_fee' => $data['delivery_fee'],
            'tax' => $data['tax'],
        ]);

        // ✅ Create order items
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity' => $item->quantity,
                'price' => $item->menuItem->price,
            ]);
        }

        // ✅ Store payment in payments table
        Payment::create([
            'order_id' => $order->id,
            'stripe_payment_id' => $stripeSessionId,
            'status' => 'succeeded',
            'amount' => $data['total'],
            'paid_at' => Carbon::now(),
        ]);

        // Send email notification to restaurant
        try {
            Mail::to(config('mail.restaurant_email', env('RESTAURANT_EMAIL')))
                ->send(new OrderPlaced($order));
        } catch (\Exception $e) {
            \Log::error('Failed to send order notification email: ' . $e->getMessage());
        }

        // ✅ Clear cart
        CartItem::where('user_id', $data['user_id'])->delete();

        return redirect()->route('user.dashboard')->with('success', 'Payment successful and order placed!');
    }
}
