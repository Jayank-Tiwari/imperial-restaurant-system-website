@extends('admin.sidebar')
@section('title', __('messages.assign_delivery'))
@section('active', 'delivery')

@section('content')
<div class="container-fluid py-3">
    <h4 class="mb-3">@lang('messages.assign_orders_to_delivery_staff')</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.delivery.assign') }}" method="POST" class="row gy-2 gx-3 align-items-center">
        @csrf
        <div class="col-auto">
            <select name="staff_id" class="form-select" required>
                <option value="">@lang('messages.select_delivery_staff')</option>
                @foreach ($staff as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <select name="order_id" class="form-select" required>
                <option value="">@lang('messages.select_order')</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">#{{ $order->id }} - @lang('messages.currency'){{ $order->total_amount }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">@lang('messages.assign')</button>
        </div>
    </form>

    <hr class="my-4">

    <h5>@lang('messages.delivery_staff_list')</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>@lang('messages.name')</th>
                <th>@lang('messages.email')</th>
                <th>@lang('messages.assigned_deliveries')</th>
                <th>@lang('messages.delivered')</th>
                <th>@lang('messages.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staff as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->deliveries()->count() }}</td>
                    <td>{{ $user->deliveries()->where('status', 'delivered')->count() }}</td>
                    <td>
                        <a href="{{ route('admin.delivery.orders', $user->id) }}" class="btn btn-sm btn-outline-primary">@lang('messages.view_orders')</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
