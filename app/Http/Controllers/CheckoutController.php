<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    // Show checkout page if cart is not empty
    public function show()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('menuItem')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before checkout.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);
        $deliveryFee = 50.00; // Hardcoded delivery fee for delivery orders

        // Discount logic
        $isEligibleForDiscount = !$user->has_one_time_discount;
        $discountPercentage = 0;
        $discountAmount = 0;
        $finalTotal = $subtotal + $deliveryFee;

        if ($isEligibleForDiscount) {
            $discountPercentage = rand(15, 20);
            $discountAmount = (($subtotal + $deliveryFee) * $discountPercentage) / 100;
            $finalTotal = ($subtotal + $deliveryFee) - $discountAmount;
        }

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'deliveryFee',
            'isEligibleForDiscount',
            'discountPercentage',
            'discountAmount',
            'finalTotal'
        ));
    }

    // Store dine-in order
    public function storeDineIn(Request $request)
    {
        $request->validate(['table_no' => 'required|integer']);

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        // Check if table is already booked
        $isBooked = Order::where('delivery_type', 'dinein')
            ->where('table_no', $request->table_no)
            ->whereIn('order_status', ['pending', 'confirmed', 'preparing'])
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($isBooked) {
            return back()->with('error', 'Selected table is currently unavailable. Please choose another.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);

        // Create dine-in order
        $order = Order::create([
            'user_id' => $user->id,
            'payment_status' => 'pending',
            'payment_method' => 'cash',
            'order_status' => 'confirmed',
            'total_amount' => $subtotal,
            'delivery_type' => 'dinein',
            'table_no' => $request->table_no,
        ]);

        // Add order items
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity' => $item->quantity,
                'price' => $item->menuItem->price,
            ]);
        }

        // Send email notification to restaurant
        try {
            Mail::to(env('RESTAURANT_EMAIL', 'restaurant@imperialspice.com'))
                ->send(new OrderPlaced($order));
        } catch (\Exception $e) {
            \Log::error('Failed to send order notification email: ' . $e->getMessage());
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('menu')->with('success', 'Dine-in order placed successfully!');
    }

    // Store delivery request and redirect to Stripe
    public function storeDelivery(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => 'required|in:card,cash',
        ]);

        $deliveryCharges = [
            '08880' => 0.00,
            '08800' => 0.00,
            '08812' => 2.00,
            '08870' => 4.00,
        ];

        if (!array_key_exists($request->postal_code, $deliveryCharges)) {
            return back()->with('error', 'Delivery only available within 4km radius');
        }

        $deliveryFee = $deliveryCharges[$request->postal_code];

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);
        $total = $subtotal + $deliveryFee;

        $discountPercentage = null;

        if (!$user->has_one_time_discount) {
            $discountPercentage = rand(15, 20);
            $discountAmount = ($total * $discountPercentage) / 100;
            $total -= $discountAmount;

            $user->has_one_time_discount = true;
            $user->save();
        }

        if ($request->payment_method === 'cash') {
            $order = Order::create([
                'user_id' => $user->id,
                'payment_status' => 'pending',
                'payment_method' => 'cash',
                'order_status' => 'confirmed',
                'total_amount' => $total,
                'discount_percentage' => $discountPercentage,
                'delivery_type' => 'delivery',
                'delivery_address' => $request->address,
                'delivery_fee' => $deliveryFee,
            ]);

            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'menu_item_id' => $item->menu_item_id,
                    'quantity' => $item->quantity,
                    'price' => $item->menuItem->price,
                ]);
            }

            // Send email notification to restaurant
            try {
                Mail::to(env('RESTAURANT_EMAIL', 'restaurant@imperialspice.com'))
                    ->send(new OrderPlaced($order));
            } catch (\Exception $e) {
                \Log::error('Failed to send order notification email: ' . $e->getMessage());
            }

            // Clear the user's cart
            CartItem::where('user_id', $user->id)->delete();

            // Redirect with a success message
            return redirect()->route('user.dashboard')->with('success', 'Your order has been placed successfully!');
        } else {
            // --- Existing logic for Card Payment ---

            // Store order details in session for Stripe
            Session::put('delivery_order', [
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'discount_percentage' => $discountPercentage,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
            ]);

            return redirect()->route('stripe.checkout');
        }
    }


    // Stripe calls this after successful payment
    public function paymentSuccess()
    {
        $data = Session::pull('delivery_order');
        if (!$data) {
            return redirect()->route('menu')->with('error', 'No pending order found.');
        }

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $data['user_id'])->with('menuItem')->get();

        $order = Order::create([
            'user_id' => $data['user_id'],
            'payment_status' => 'paid',
            'payment_method' => 'card',
            'order_status' => 'confirmed',
            'total_amount' => $data['total'],
            'delivery_type' => 'delivery',
            'delivery_address' => $data['address'],
            'delivery_fee' => $data['delivery_fee'],
        ]);

        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity' => $item->quantity,
                'price' => $item->menuItem->price,
            ]);
        }

        try {
            Mail::to(env('RESTAURANT_EMAIL', 'restaurant@imperialspice.com'))
                ->send(new OrderPlaced($order));
        } catch (\Exception $e) {
            \Log::error('Failed to send order notification email: ' . $e->getMessage());
        }

        CartItem::where('user_id', $data['user_id'])->delete();

        return redirect()->route('menu')->with('success', 'Delivery order placed successfully!');
    }
}