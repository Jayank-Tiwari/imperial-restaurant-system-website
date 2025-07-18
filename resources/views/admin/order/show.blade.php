@extends('admin.sidebar')

@section('title', 'Order #'.$order->id.' - Imperial Spice')
@section('active', 'order')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Order #{{ $order->id }}</h2>
        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Orders
        </a>
    </div>

    <!-- Order Summary -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    Customer Info
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                    <p><strong>Order Placed At:</strong> {{ $order->created_at->format('d M Y - h:i A') }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Order Details
                </div>
                <div class="card-body">
                    <p><strong>Order Type:</strong> 
                        <span class="badge bg-{{ $order->delivery_type == 'dinein' ? 'success' : ($order->delivery_type == 'delivery' ? 'warning text-dark' : 'info') }}">
                            {{ ucfirst($order->delivery_type) }}
                        </span>
                    </p>
                    @if($order->delivery_type == 'dinein')
                        <p><strong>Table No:</strong> {{ $order->table_no }}</p>
                    @elseif($order->delivery_type == 'delivery')
                        <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                    @endif
                    <p><strong>Status:</strong> 
                        <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span>
                    </p>
                    <p><strong>Payment Status:</strong> 
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </p>
                    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Ordered Items
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->menuItem->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total</td>
                                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
