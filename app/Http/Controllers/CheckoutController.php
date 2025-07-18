<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // Show checkout page if cart is not empty
    public function show()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before proceeding to checkout.');
        }

        return view('checkout.index', compact('cartItems'));
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

        $total = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);

        // Create dine-in order
        $order = Order::create([
            'user_id'       => $user->id,
            'payment_status'=> 'pending',
            'order_status'  => 'confirmed',
            'total_amount'  => $total,
            'delivery_type' => 'dinein',
            'table_no'      => $request->table_no,
        ]);

        // Add order items
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity'     => $item->quantity,
                'price'        => $item->menuItem->price,
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('menu')->with('success', 'Dine-in order placed successfully!');
    }

    // Store delivery request and redirect to Stripe
    public function storeDelivery(Request $request)
    {
        $request->validate([
            'address'      => 'required|string',
            'postal_code'  => 'required|string',
        ]);

        $validPostalCodes = ['08800', '08801', '08802']; // Hardcoded 4km radius zip codes

        if (!in_array($request->postal_code, $validPostalCodes)) {
            return back()->with('error', 'Delivery only available within 4km radius');
        }

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);
        $deliveryFee = 3.99;
        $total = $subtotal + $deliveryFee;

        // Temporarily store order details in session
        Session::put('delivery_order', [
            'user_id'     => $user->id,
            'total'       => $total,
            'address'     => $request->address,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('stripe.checkout');
    }

    // Stripe calls this after successful payment
    public function paymentSuccess()
    {
        $data = Session::pull('delivery_order');
        if (!$data) {
            return redirect()->route('menu')->with('error', 'No pending order.');
        }

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $data['user_id'])->with('menuItem')->get();

        $order = Order::create([
            'user_id'        => $data['user_id'],
            'payment_status' => 'paid',
            'order_status'   => 'confirmed',
            'total_amount'   => $data['total'],
            'delivery_type'  => 'delivery',
            'delivery_address' => $data['address'],
        ]);

        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity'     => $item->quantity,
                'price'        => $item->menuItem->price,
            ]);
        }

        CartItem::where('user_id', $data['user_id'])->delete();

        return redirect()->route('menu')->with('success', 'Delivery order placed successfully!');
    }
}
