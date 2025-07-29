
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
                            <th>@lang('messages.total')</th>
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
                                <td>#{{ $order->id }}</td>
                                <td>{{ __('messages.currency') }}{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'danger' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td><span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span></td>
                                <td>
                                    {{ $order->delivery->otp ?? __('messages.not_available') }}
                                </td>
                                <td>
                                    {{ ucfirst($order->delivery->status ?? __('messages.not_assigned')) }}
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">@lang('messages.no_orders_placed_yet')</div>
        @endif
    </main>
@endsection
