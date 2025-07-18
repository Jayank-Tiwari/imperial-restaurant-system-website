<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.menuItem'])->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('order_status', $request->status);
        }

        if ($request->filled('payment')) {
            $query->where('payment_status', $request->payment);
        }

        $orders = $query->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.menuItem']);
        return view('admin.order.show', compact('order'));
    }
    public function updatePayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,pending,failed',
        ]);


        $order->update(['payment_status' => $request->payment_status]);

        return back()->with('success', 'Payment status updated successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,confirmed,preparing,out_for_delivery,delivered,cancelled',
        ]);

        if ($order->order_status === 'delivered') {
            return back()->with('error', 'Delivered orders cannot be updated.');
        }

        $order->update(['order_status' => $request->order_status]);

        return back()->with('success', 'Order status updated successfully.');
    }

}
