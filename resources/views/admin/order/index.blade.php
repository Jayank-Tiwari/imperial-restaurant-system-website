@extends('admin.sidebar')

@section('title', __('messages.orders') . ' - ' . __('messages.imperial_spice'))
@section('active', 'order')

@section('content')
    <div class="container-fluid px-3 px-md-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap pt-3 pb-3 border-bottom">
            <h1 class="h2 mb-2">@lang('messages.order_management')</h1>
        </div>

        <!-- Filter Buttons -->
        <form method="GET" class="mb-4">
            <div class="row gy-2 gx-3 align-items-center">
                <!-- Order Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold">@lang('messages.order_status'):</label>
                </div>
                <div class="col-auto">
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.order.index') }}"
                            class="btn btn-outline-primary {{ request('status') == 'all' || !request('status') ? 'active' : '' }}">
                            @lang('messages.all')
                        </a>
                        @foreach (['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'] as $status)
                            <a href="{{ route('admin.order.index', array_merge(request()->except('page'), ['status' => $status])) }}"
                                class="btn btn-outline-secondary {{ request('status') == $status ? 'active' : '' }}">
                                @lang('messages.order_status_' . $status)
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Status Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold">@lang('messages.payment'):</label>
                </div>
                <div class="col-auto">
                    <select name="payment" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">@lang('messages.all')</option>
                        @foreach (['pending', 'paid', 'failed'] as $pay)
                            <option value="{{ $pay }}" {{ request('payment') == $pay ? 'selected' : '' }}>
                                @lang('messages.payment_status_' . $pay)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Payment Method Filter -->
                <div class="col-auto">
                    <label class="form-label mb-0 fw-bold">@lang('messages.payment_method'):</label>
                </div>
                <div class="col-auto">
                    <select name="payment_method" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">@lang('messages.all')</option>
                        @foreach (['card', 'cash'] as $method)
                            <option value="{{ $method }}" {{ request('payment_method') == $method ? 'selected' : '' }}>
                                @lang('messages.payment_method_' . $method)
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
                <h6 class="mb-0">@lang('messages.all_orders')</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>@lang('messages.order_number')</th>
                                <th>@lang('messages.customer')</th>
                                <th>@lang('messages.date')</th>
                                <th class="text-start">@lang('messages.items')</th>
                                <th>@lang('messages.total')</th>
                                <th>@lang('messages.type')</th>
                                <th>@lang('messages.order_status')</th>
                                <th>@lang('messages.payment')</th>
                                <th>@lang('messages.payment_method')</th>
                                <th>@lang('messages.actions')</th>
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
                                    <td><strong>€{{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if ($order->delivery_type == 'delivery') bg-warning text-dark
                                        @elseif($order->delivery_type == 'dinein') bg-success
                                        @else bg-info @endif">
                                            @lang('messages.delivery_type_' . $order->delivery_type)
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
                                                        @lang('messages.order_status_' . $status)
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
                                                        @lang('messages.payment_status_' . $payStatus)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <span class="badge 
                                            @if($order->payment_method == 'card') bg-primary
                                            @elseif($order->payment_method == 'cash') bg-warning text-dark
                                            @else bg-secondary @endif">
                                            <i class="fas 
                                                @if($order->payment_method == 'card') fa-credit-card
                                                @elseif($order->payment_method == 'cash') fa-money-bill-wave
                                                @else fa-question @endif me-1"></i>
                                            @lang('messages.payment_method_' . ($order->payment_method ?? 'unknown'))
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.order.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            @lang('messages.view')
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">@lang('messages.no_orders_found_for_status')
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
