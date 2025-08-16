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
                            <th>Discount</th>
                            <th>@lang('messages.payment_method')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>
                                </td>
                                <td><strong>{{ __('messages.currency') }}{{ number_format($order->total_amount, 2) }}</strong>
                                </td>
                                <td>
                                    @if ($order->discount_percentage)
                                        <span class="badge bg-success">{{ $order->discount_percentage }}%</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- OTP Instructions for Delivery Orders -->
            @if ($orders->where('delivery_type', 'delivery')->where('delivery.otp', '!=', null)->count() > 0)
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
            @if ($orders->where('payment_method', 'cash')->where('payment_status', 'pending')->count() > 0)
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
                            <h5 class="card-title">
                                {{ $orders->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count() }}
                            </h5>
                            <p class="card-text">@lang('messages.active_orders')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ __('messages.currency') }}{{ number_format($orders->sum('total_amount'), 2) }}</h5>
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
