@extends('admin.sidebar')
@section('title', __('messages.delivery_orders'))
@section('active', 'delivery')

@section('content')
<div class="container py-3">
    <h4 class="mb-3">@lang('messages.orders_for') {{ $staff->name }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>@lang('messages.order_number_short')</th>
                <th>@lang('messages.total')</th>
                <th>@lang('messages.status')</th>
                <th>@lang('messages.otp')</th>
                <th>@lang('messages.updated')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $delivery)
                <tr>
                    <td>#{{ $delivery->order->id }}</td>
                    <td>@lang('messages.currency'){{ $delivery->order->total_amount }}</td>
                    <td>{{ ucfirst($delivery->status) }}</td>
                    <td>{{ $delivery->otp }}</td>
                    <td>{{ $delivery->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
