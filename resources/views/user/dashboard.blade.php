@extends('user.sidebar')

@section('title', __('messages.user_dashboard') . ' - ' . __('messages.imperial_spice'))
@section('active', 'dashboard')

@section('content')
<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }
    
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-orange), #e67e22);
        border-radius: 16px;
        color: white;
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(211, 84, 0, 0.2);
    }
    
    .stat-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        height: 100%;
        border: 1px solid #f8f9fa;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 1.25rem;
    }
    
    .icon-orange { background: var(--soft-orange); color: var(--primary-orange); }
    .icon-green { background: #e8f5e9; color: #2e7d32; }
    .icon-blue { background: #e3f2fd; color: #1565c0; }
    .icon-purple { background: #f3e5f5; color: #7b1fa2; }
    
    .table-container {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #f8f9fa;
    }
    
    .custom-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #e9ecef;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .custom-table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #495057;
    }
    
    .badge-soft-success { background: #e8f5e9; color: #2e7d32; }
    .badge-soft-warning { background: #fff8e1; color: #f57f17; }
    .badge-soft-info { background: #e3f2fd; color: #1565c0; }
    
    .info-card {
        border-radius: 12px;
        border: none;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border-left: 5px solid var(--primary-orange);
    }
    
    .main-wrapper {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding-bottom: 3rem;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 main-wrapper">
    <!-- Welcome Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="fw-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
            <p class="mb-0 text-white-50 fs-5">Here is an overview of your recent orders and activity.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('menu') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-dark shadow-sm transition">
                <i class="fas fa-utensils me-2" style="color: var(--primary-orange);"></i> @lang('messages.browse_menu')
            </a>
        </div>
    </div>

    <!-- Order Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-orange">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $orders->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">@lang('messages.total_orders')</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $orders->where('order_status', 'delivered')->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">@lang('messages.completed_orders')</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-clock"></i>
                </div>
                <h2 class="fw-bold mb-1">
                    {{ $orders->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count() }}
                </h2>
                <p class="text-muted mb-0 fw-semibold">@lang('messages.active_orders')</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-purple">
                    <i class="fas fa-wallet"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ __('messages.currency') }}{{ number_format($orders->sum('total_amount'), 2) }}</h2>
                <p class="text-muted mb-0 fw-semibold">@lang('messages.total_spent')</p>
            </div>
        </div>
    </div>

    <!-- Instructions / Alerts -->
    <div class="row g-4 mb-4">
        @if ($orders->where('delivery_type', 'delivery')->where('delivery.otp', '!=', null)->count() > 0)
        <div class="col-lg-6">
            <div class="card info-card p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-shield-alt text-success me-2"></i> @lang('messages.delivery_otp_instructions')</h5>
                <p class="text-muted small mb-3">@lang('messages.customer_otp_instructions')</p>
                <ul class="text-muted small mb-0 ps-3">
                    <li>@lang('messages.provide_otp_to_delivery_person')</li>
                    <li>@lang('messages.verify_order_before_sharing_otp')</li>
                </ul>
            </div>
        </div>
        @endif

        @if ($orders->where('payment_method', 'cash')->where('payment_status', 'pending')->count() > 0)
        <div class="col-lg-6">
            <div class="card info-card p-4" style="border-left-color: #f57f17;">
                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-money-bill-wave text-warning me-2"></i> @lang('messages.payment_instructions')</h5>
                <p class="text-muted small mb-3">@lang('messages.cash_payment_instructions')</p>
                <ul class="text-muted small mb-0 ps-3">
                    <li>@lang('messages.cod_instruction')</li>
                    <li>@lang('messages.exact_change_recommended')</li>
                </ul>
            </div>
        </div>
        @endif
    </div>

    <!-- Orders Table -->
    <div class="table-container">
        <h4 class="fw-bold mb-4 px-2">@lang('messages.my_orders')</h4>
        @if ($orders->count())
            <div class="table-responsive">
                <table class="table custom-table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>@lang('messages.order_id')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('messages.type')</th>
                            <th>Status</th>
                            <th>@lang('messages.total')</th>
                            <th>@lang('messages.payment_method')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-bold text-dark">#{{ $order->id }}</span>
                                </td>
                                <td>
                                    <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> {{ $order->created_at->format('M d, Y') }}</span>
                                </td>
                                <td>
                                    @if($order->delivery_type == 'delivery')
                                        <span class="badge badge-soft-info px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-motorcycle me-1"></i> @lang('messages.delivery_type_delivery')</span>
                                    @elseif($order->delivery_type == 'pickup')
                                        <span class="badge badge-soft-warning px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-shopping-bag me-1"></i> @lang('messages.delivery_type_pickup')</span>
                                    @elseif($order->delivery_type == 'dinein')
                                        <span class="badge badge-soft-success px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-utensils me-1"></i> @lang('messages.delivery_type_dinein')</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        if($order->order_status == 'delivered') $statusClass = 'bg-success';
                                        elseif(in_array($order->order_status, ['preparing', 'out_for_delivery'])) $statusClass = 'bg-primary';
                                        elseif($order->order_status == 'confirmed') $statusClass = 'bg-info';
                                        elseif($order->order_status == 'cancelled') $statusClass = 'bg-danger';
                                    @endphp
                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 fw-semibold">
                                        @lang('messages.order_status_' . $order->order_status)
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold fs-6">{{ __('messages.currency') }}{{ number_format($order->total_amount, 2) }}</span>
                                        @if ($order->discount_percentage)
                                            <span class="text-success small fw-semibold"><i class="fas fa-tag"></i> {{ $order->discount_percentage }}% off</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($order->payment_method == 'card')
                                        <span class="fw-semibold"><i class="fas fa-credit-card text-primary me-2"></i>Card</span>
                                    @elseif($order->payment_method == 'cash')
                                        <span class="fw-semibold"><i class="fas fa-money-bill-wave text-success me-2"></i>Cash</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 my-4">
                <div class="mb-3">
                    <i class="fas fa-receipt fa-4x text-muted opacity-25"></i>
                </div>
                <h4 class="text-dark fw-bold mb-2">@lang('messages.no_orders_yet')</h4>
                <p class="text-muted mb-4 fs-5">@lang('messages.no_orders_placed_yet')</p>
                <a href="{{ route('menu') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm" style="background: var(--primary-orange); border: none;">
                    <i class="fas fa-utensils me-2"></i>@lang('messages.browse_menu')
                </a>
            </div>
        @endif
    </div>
</main>
@endsection
