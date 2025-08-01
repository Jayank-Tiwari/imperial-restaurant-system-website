<?php
namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryDashboardController extends Controller
{
    public function deliveredOrders()
    {
        $userId = Auth::id();

        $deliveries = Delivery::with('order')
            ->where('staff_id', $userId)
            ->where('status', 'delivered')
            ->latest()
            ->get();

        return view('delivery.delivered_orders', compact('deliveries'));
    }
    // List assigned orders
    public function index()
    {
        $staffId = Auth::id();

        $deliveries = Delivery::with('order')
            ->where('staff_id', $staffId)
            ->where('status', 'assigned')
            ->get();

        return view('delivery.dashboard', compact('deliveries'));
    }

    // Show individual order & OTP form
    public function show($id)
    {
        $staffId = Auth::id();

        $delivery = Delivery::with('order')
            ->where('staff_id', $staffId)
            ->where('order_id', $id)
            ->firstOrFail();

        return view('delivery.show', compact('delivery'));
    }

    // Verify OTP and mark as delivered
    public function verifyOtp(Request $request, $id)
    {
        $request->validate(['otp' => 'required|string|size:6']);

        $staffId = Auth::id();
        $delivery = Delivery::where('staff_id', $staffId)
            ->where('order_id', $id)
            ->firstOrFail();

        if ($delivery->otp === $request->otp) {
            // Update delivery status
            $delivery->status = 'delivered';
            $delivery->save();
            
            $order = $delivery->order;
            $order->order_status = 'delivered';
            
            // If payment method is cash and status is pending, mark as paid
            if ($order->payment_method === 'cash' && $order->payment_status === 'pending') {
                $order->payment_status = 'paid';
            }
            
            $order->save();

            return redirect()->route('delivery.dashboard')->with('success', 'OTP verified successfully. Order marked as delivered and payment collected.');
        }

        return back()->with('error', 'Incorrect OTP. Please try again.');
    }
}
