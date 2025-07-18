@extends('admin.sidebar')

@section('title', 'Orders - Imperial Spice')
@section('active', 'order')

@section('content')
    <div class="container-fluid px-3 px-md-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap pt-3 pb-3 border-bottom">
            <h1 class="h2 mb-2">Order Management</h1>
        </div>

        <!-- Filter Buttons -->
        <form method="GET" class="mb-4">
            <div class="row gy-2 gx-3 align-items-center">
                <!-- Order Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold">Order Status:</label>
                </div>
                <div class="col-auto">
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.order.index') }}"
                            class="btn btn-outline-primary {{ request('status') == 'all' || !request('status') ? 'active' : '' }}">
                            All
                        </a>
                        @foreach (['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'] as $status)
                            <a href="{{ route('admin.order.index', array_merge(request()->except('page'), ['status' => $status])) }}"
                                class="btn btn-outline-secondary {{ request('status') == $status ? 'active' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold">Payment:</label>
                </div>
                <div class="col-auto">
                    <select name="payment" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (['pending', 'paid', 'failed'] as $pay)
                            <option value="{{ $pay }}" {{ request('payment') == $pay ? 'selected' : '' }}>
                                {{ ucfirst($pay) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">All Orders</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th class="text-start">Items</th>
                                <th>Total</th>
                                <th>Type</th>
                                <th>Order Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->created_at->format('d M Y - h:i A') }}</td>
                                    <td class="text-start">
                                        <ul class="list-unstyled mb-0 small">
                                            @foreach ($order->orderItems as $item)
                                                <li>{{ $item->menuItem->name }} <small>(x{{ $item->quantity }})</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if ($order->delivery_type == 'delivery') bg-warning text-dark
                                        @elseif($order->delivery_type == 'dinein') bg-success
                                        @else bg-info @endif">
                                            {{ ucfirst($order->delivery_type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.order.updateStatus', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-select form-select-sm" name="order_status"
                                                onchange="this.form.submit()"
                                                {{ $order->order_status == 'delivered' ? 'disabled' : '' }}>
                                                @foreach (['pending', 'confirmed', 'preparing', 'out_for_delivery', 'cancelled', 'delivered'] as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $order->order_status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <form method="POST" action="{{ route('admin.order.updatePayment', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-select form-select-sm" name="payment_status"
                                                onchange="this.form.submit()">
                                                @foreach (['pending', 'paid', 'failed'] as $payStatus)
                                                    <option value="{{ $payStatus }}"
                                                        {{ $order->payment_status == $payStatus ? 'selected' : '' }}>
                                                        {{ ucfirst($payStatus) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.order.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">No orders found for this status.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-3">
                    {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
