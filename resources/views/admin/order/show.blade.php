@extends('admin.sidebar')

@section('title', __('messages.order_number') . ' #'.$order->id.' - ' . __('messages.imperial_spice'))
@section('active', 'order')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>@lang('messages.order_number') #{{ $order->id }}</h2>
        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> @lang('messages.back_to_orders')
        </a>
    </div>

    <!-- Order Summary -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    @lang('messages.customer_info')
                </div>
                <div class="card-body">
                    <p><strong>@lang('messages.name'):</strong> {{ $order->user->name }}</p>
                    <p><strong>@lang('messages.email_address'):</strong> {{ $order->user->email }}</p>
                    <p><strong>@lang('messages.phone_number'):</strong> {{ $order->user->phone ?? __('messages.not_available') }}</p>
                    <p><strong>@lang('messages.order_placed_at'):</strong> {{ $order->created_at->format('d M Y - h:i A') }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    @lang('messages.order_details')
                </div>
                <div class="card-body">
                    <p><strong>@lang('messages.type'):</strong> 
                        <span class="badge bg-{{ $order->delivery_type == 'dinein' ? 'success' : ($order->delivery_type == 'delivery' ? 'warning text-dark' : 'info') }}">
                            @lang('messages.' . $order->delivery_type)
                        </span>
                    </p>
                    @if($order->delivery_type == 'dinein')
                        <p><strong>@lang('messages.table_no'):</strong> {{ $order->table_no }}</p>
                    @elseif($order->delivery_type == 'delivery')
                        <p><strong>@lang('messages.delivery_address'):</strong> {{ $order->delivery_address }}</p>
                    @endif
                    <p><strong>@lang('messages.status'):</strong> 
                        <span class="badge bg-secondary">@lang('messages.order_status_' . $order->order_status)</span>
                    </p>
                    <p><strong>@lang('messages.payment_status'):</strong> 
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                            @lang('messages.payment_status_' . $order->payment_status)
                        </span>
                    </p>
                    <p><strong>@lang('messages.total_amount'):</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    @lang('messages.ordered_items')
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>@lang('messages.item')</th>
                                <th>@lang('messages.qty')</th>
                                <th>@lang('messages.price')</th>
                                <th>@lang('messages.subtotal')</th>
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
                                <td colspan="3" class="text-end">@lang('messages.total')</td>
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
