@extends('user.sidebar')

@section('title', __('messages.user_dashboard') . ' - ' . __('messages.imperial_spice'))
@section('active', 'dashboard')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4">@lang('messages.my_orders')</h2>

        @if ($orders->count())
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>@lang('messages.order_id')</th>
                            <th>@lang('messages.type')</th>
                            <th>@lang('messages.total')</th>
                            <th>@lang('messages.payment_method')</th>
                            <th>@lang('messages.payment_status')</th>
                            <th>@lang('messages.order_status')</th>
                            <th>@lang('messages.delivery_otp')</th>
                            <th>@lang('messages.delivery_status')</th>
                            <th>@lang('messages.placed_at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $order->delivery_type == 'dinein' ? 'success' : ($order->delivery_type == 'delivery' ? 'warning text-dark' : 'info') }}">
                                        @lang('messages.delivery_type_' . $order->delivery_type)
                                    </span>
                                </td>
                                <td><strong>{{ __('messages.currency') }}{{ number_format($order->total_amount, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_method == 'card' ? 'primary' : 'warning text-dark' }}">
                                        <i class="fas {{ $order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} me-1"></i>
                                        @lang('messages.payment_method_' . ($order->payment_method ?? 'unknown'))
                                    </span>
                                    @if($order->payment_method == 'cash')
                                        <br>
                                        <small class="text-muted">
                                            @if($order->delivery_type == 'delivery')
                                                (@lang('messages.cod_short'))
                                            @else
                                                (@lang('messages.pay_at_restaurant_short'))
                                            @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : ($order->payment_status === 'failed' ? 'danger' : 'warning text-dark') }}">
                                        @lang('messages.payment_status_' . $order->payment_status)
                                    </span>
                                    @if($order->payment_method == 'cash' && $order->payment_status == 'pending')
                                        <br>
                                        <small class="text-muted">
                                            @if($order->delivery_type == 'delivery')
                                                @lang('messages.pay_on_delivery_note')
                                            @else
                                                @lang('messages.pay_at_restaurant_note')
                                            @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->order_status === 'delivered' ? 'success' : ($order->order_status === 'cancelled' ? 'danger' : 'info') }}">
                                        @lang('messages.order_status_' . $order->order_status)
                                    </span>
                                </td>
                                <td>
                                    @if($order->delivery_type == 'delivery')
                                        @if($order->delivery && $order->delivery->otp)
                                            <span class="badge bg-secondary fs-6 fw-bold">{{ $order->delivery->otp }}</span>
                                            <br><small class="text-muted">@lang('messages.share_with_delivery_person')</small>
                                        @else
                                            <span class="text-muted">{{ __('messages.not_available') }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted">@lang('messages.not_applicable')</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->delivery_type == 'delivery')
                                        @if($order->delivery)
                                            <span class="badge bg-{{ $order->delivery->status == 'delivered' ? 'success' : ($order->delivery->status == 'out_for_delivery' ? 'primary' : 'info') }}">
                                                @lang('messages.delivery_status_' . $order->delivery->status)
                                            </span>
                                        @else
                                            <span class="text-muted">@lang('messages.not_assigned')</span>
                                        @endif
                                    @else
                                        <span class="text-muted">@lang('messages.not_applicable')</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- OTP Instructions for Delivery Orders -->
            @if($orders->where('delivery_type', 'delivery')->where('delivery.otp', '!=', null)->count() > 0)
                <div class="alert alert-success mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-shield-alt me-2"></i>@lang('messages.delivery_otp_instructions')
                    </h5>
                    <p class="mb-0">
                        @lang('messages.customer_otp_instructions')
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li>@lang('messages.provide_otp_to_delivery_person')</li>
                        <li>@lang('messages.verify_order_before_sharing_otp')</li>
                        <li>@lang('messages.otp_required_for_delivery_completion')</li>
                    </ul>
                </div>
            @endif

            <!-- Payment Instructions for Cash Orders -->
            @if($orders->where('payment_method', 'cash')->where('payment_status', 'pending')->count() > 0)
                <div class="alert alert-info mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-info-circle me-2"></i>@lang('messages.payment_instructions')
                    </h5>
                    <p class="mb-0">
                        @lang('messages.cash_payment_instructions')
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li>@lang('messages.cod_instruction')</li>
                        <li>@lang('messages.dinein_instruction')</li>
                        <li>@lang('messages.exact_change_recommended')</li>
                    </ul>
                </div>
            @endif

            <!-- Order Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $orders->count() }}</h5>
                            <p class="card-text">@lang('messages.total_orders')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $orders->where('order_status', 'delivered')->count() }}</h5>
                            <p class="card-text">@lang('messages.completed_orders')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">{{ $orders->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count() }}</h5>
                            <p class="card-text">@lang('messages.active_orders')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('messages.currency') }}{{ number_format($orders->sum('total_amount'), 2) }}</h5>
                            <p class="card-text">@lang('messages.total_spent')</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>@lang('messages.no_orders_yet')</h4>
                <p>@lang('messages.no_orders_placed_yet')</p>
                <a href="{{ route('menu') }}" class="btn btn-primary">
                    <i class="fas fa-utensils me-2"></i>@lang('messages.browse_menu')
                </a>
            </div>
        @endif
    </main>
@endsection
