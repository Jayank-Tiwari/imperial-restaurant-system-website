@extends('delivery.sidebar')

@section('title', __('messages.delivery_dashboard') . ' - ' . __('messages.imperial_spice'))
@section('active', 'dashboard')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <h2>@lang('messages.assigned_orders')</h2>
            <div class="badge bg-primary fs-6">
                {{ $deliveries->count() }} @lang('messages.active_deliveries')
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ __(session('success')) }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ __(session('error')) }}</div>
        @endif

        @if ($deliveries->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>@lang('messages.order_id')</th>
                            <th>@lang('messages.customer_name')</th>
                            <th>@lang('messages.delivery_address')</th>
                            <th>@lang('messages.total_amount')</th>
                            <th>@lang('messages.payment_method')</th>
                            <th>@lang('messages.payment_status')</th>
                            <th>@lang('messages.assigned_at')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td><strong>#{{ $delivery->order_id }}</strong></td>
                                <td>{{ $delivery->order->user->name }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $delivery->order->delivery_address }}</strong>
                                        @if ($delivery->order->postal_code)
                                            <br><small class="text-muted">@lang('messages.postal_code'):
                                                {{ $delivery->order->postal_code }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td><strong>{{ __('messages.currency') }}{{ number_format($delivery->order->total_amount, 2) }}</strong>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $delivery->order->payment_method == 'card' ? 'primary' : 'warning text-dark' }}">
                                        <i
                                            class="fas {{ $delivery->order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} me-1"></i>
                                        @lang('messages.payment_method_' . ($delivery->order->payment_method ?? 'unknown'))
                                    </span>
                                    @if ($delivery->order->payment_method == 'cash')
                                        <br><small class="text-muted">(@lang('messages.collect_payment'))</small>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $delivery->order->payment_status === 'paid' ? 'success' : ($delivery->order->payment_status === 'failed' ? 'danger' : 'warning text-dark') }}">
                                        @lang('messages.payment_status_' . $delivery->order->payment_status)
                                    </span>
                                    @if ($delivery->order->payment_method == 'cash' && $delivery->order->payment_status == 'pending')
                                        <br><small class="text-success">@lang('messages.collect_on_delivery')</small>
                                    @endif
                                </td>
                                <td>{{ $delivery->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $delivery->status == 'delivered' ? 'success' : ($delivery->status == 'out_for_delivery' ? 'primary' : 'info') }}">
                                        @lang('messages.delivery_status_' . $delivery->status)
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('delivery.orders.show', $delivery->order_id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>@lang('messages.view_details')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Payment Collection Instructions -->
            @if ($deliveries->where('order.payment_method', 'cash')->where('order.payment_status', 'pending')->count() > 0)
                <div class="alert alert-warning mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-exclamation-triangle me-2"></i>@lang('messages.cash_collection_reminder')
                    </h5>
                    <p class="mb-0">
                        @lang('messages.cash_collection_instructions')
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li>@lang('messages.verify_otp_before_delivery')</li>
                        <li>@lang('messages.collect_exact_amount')</li>
                        <li>@lang('messages.mark_payment_received')</li>
                        <li>@lang('messages.provide_receipt_if_requested')</li>
                    </ul>
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $deliveries->count() }}</h5>
                            <p class="card-text">@lang('messages.total_assigned')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $deliveries->where('status', 'delivered')->count() }}</h5>
                            <p class="card-text">@lang('messages.delivered_today')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">{{ $deliveries->where('status', 'out_for_delivery')->count() }}</h5>
                            <p class="card-text">@lang('messages.out_for_delivery')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ __('messages.currency') }}{{ number_format($deliveries->where('order.payment_method', 'cash')->where('order.payment_status', 'pending')->sum('order.total_amount'), 2) }}
                            </h5>
                            <p class="card-text">@lang('messages.cash_to_collect')</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>@lang('messages.no_deliveries_assigned')</h4>
                <p>@lang('messages.no_deliveries_assigned_message')</p>
                <i class="fas fa-truck fa-3x text-muted mt-3"></i>
            </div>
        @endif
    </main>
@endsection
