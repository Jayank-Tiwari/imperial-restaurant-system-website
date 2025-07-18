<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // OPTION 1: Sales Overview
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $totalOrders = Order::count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $monthlyOrders = Order::whereMonth('created_at', now()->month)->count();

        // OPTION 4: Recent Orders (except cancelled)
        $recentOrders = Order::whereNotIn('order_status', ['cancelled'])
                            ->latest()
                            ->take(5)
                            ->get();

        // OPTION 5: Order status summary (excluding cancelled)
        $statusCounts = [
            'pending' => Order::where('order_status', 'pending')->count(),
            'confirmed' => Order::where('order_status', 'confirmed')->count(),
            'preparing' => Order::where('order_status', 'preparing')->count(),
            'out_for_delivery' => Order::where('order_status', 'out_for_delivery')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
        ];

        // Graph: Revenue in Last 7 Days
        $graphLabels = [];
        $graphData = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $graphLabels[] = $day->format('D');
            $graphData[] = Order::whereDate('created_at', $day)->where('payment_status', 'paid')->sum('total_amount');
        }

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'monthlyOrders',
            'recentOrders',
            'statusCounts',
            'graphLabels',
            'graphData'
        ));
    }
}
