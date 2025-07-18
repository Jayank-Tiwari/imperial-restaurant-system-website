<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeliveryController extends Controller
{
    public function index()
    {
        $staff = User::where('role', 'delivery')->get(); // Adjust role value accordingly
        $orders = Order::whereNotIn('order_status', ['delivered', 'cancelled'])->get();

        return view('admin.delivery.index', compact('staff', 'orders'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'staff_id' => 'required|exists:users,id'
        ]);

        $order = Order::findOrFail($request->order_id);

        // Generate OTP
        $otp = mt_rand(100000, 999999);

        $delivery = Delivery::create([
            'order_id' => $order->id,
            'staff_id' => $request->staff_id,
            'otp' => $otp,
            'status' => 'assigned',
        ]);

        $order->update([
            'delivery_id' => $delivery->id,
            'order_status' => 'out_for_delivery',
        ]);

        return back()->with('success', 'Delivery assigned and OTP generated.');
    }

    public function viewOrders($id)
    {
        $staff = User::findOrFail($id);
        $deliveries = Delivery::where('staff_id', $id)->with('order')->get();

        return view('admin.delivery.orders', compact('staff', 'deliveries'));
    }
}
