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
                            @lang('messages.delivery_type_' . $order->delivery_type)
                        </span>
                    </p>
                    @if($order->delivery_type == 'dinein')
                        <p><strong>@lang('messages.table_no'):</strong> {{ $order->table_no }}</p>
                    @elseif($order->delivery_type == 'delivery')
                        <p><strong>@lang('messages.delivery_address'):</strong> {{ $order->delivery_address }}</p>
                        @if($order->postal_code)
                            <p><strong>@lang('messages.postal_code'):</strong> {{ $order->postal_code }}</p>
                        @endif
                        @if($order->delivery_charge && $order->delivery_charge > 0)
                            <p><strong>@lang('messages.delivery_charge'):</strong> €{{ number_format($order->delivery_charge, 2) }}</p>
                        @endif
                    @endif
                    
                    <p><strong>@lang('messages.order_status'):</strong> 
                        <span class="badge bg-{{ $order->order_status == 'delivered' ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'secondary') }}">
                            @lang('messages.order_status_' . $order->order_status)
                        </span>
                    </p>
                    
                    <p><strong>@lang('messages.payment_method'):</strong> 
                        <span class="badge bg-{{ $order->payment_method == 'card' ? 'primary' : 'warning text-dark' }}">
                            <i class="fas {{ $order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} me-1"></i>
                            @lang('messages.payment_method_' . ($order->payment_method ?? 'unknown'))
                        </span>
                        @if($order->payment_method == 'cash')
                            @if($order->delivery_type == 'delivery')
                                <small class="text-muted d-block mt-1">(@lang('messages.cash_on_delivery'))</small>
                            @else
                                <small class="text-muted d-block mt-1">(@lang('messages.pay_at_restaurant'))</small>
                            @endif
                        @endif
                    </p>
                    
                    <p><strong>@lang('messages.payment_status'):</strong> 
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'failed' ? 'danger' : 'warning text-dark') }}">
                            @lang('messages.payment_status_' . $order->payment_status)
                        </span>
                        @if($order->payment_method == 'cash' && $order->payment_status == 'pending')
                            <small class="text-muted d-block mt-1">
                                @if($order->delivery_type == 'delivery')
                                    @lang('messages.payment_due_on_delivery')
                                @else
                                    @lang('messages.payment_due_at_restaurant')
                                @endif
                            </small>
                        @endif
                    </p>
                    
                    <p><strong>@lang('messages.total_amount'):</strong> 
                        <span class="fw-bold text-success">€{{ number_format($order->total_amount, 2) }}</span>
                    </p>

                    @if($order->delivery_type == 'delivery' && $order->delivery_otp)
                        <div class="alert alert-info mt-3">
                            <strong>@lang('messages.delivery_otp'):</strong> 
                            <span class="fs-5 fw-bold text-primary">{{ $order->delivery_otp }}</span>
                            <br>
                            <small>@lang('messages.share_otp_with_delivery_person')</small>
                        </div>
                    @endif
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
                            @php
                                $itemsTotal = 0;
                            @endphp
                            @foreach ($order->orderItems as $item)
                                @php
                                    $itemSubtotal = $item->price * $item->quantity;
                                    $itemsTotal += $itemSubtotal;
                                @endphp
                                <tr>
                                    <td>{{ $item->menuItem->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>€{{ number_format($item->price, 2) }}</td>
                                    <td>€{{ number_format($itemSubtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end">@lang('messages.subtotal'):</td>
                                <td>€{{ number_format($itemsTotal, 2) }}</td>
                            </tr>
                            @if($order->delivery_charge && $order->delivery_charge > 0)
                                <tr>
                                    <td colspan="3" class="text-end">@lang('messages.delivery_charge'):</td>
                                    <td>€{{ number_format($order->delivery_charge, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="text-end">@lang('messages.tax') (10%):</td>
                                <td>€{{ number_format($order->total_amount - $itemsTotal - ($order->delivery_charge ?? 0), 2) }}</td>
                            </tr>
                            <tr class="fw-bold table-success">
                                <td colspan="3" class="text-end">@lang('messages.total'):</td>
                                <td>€{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Order Actions (for cash payments) -->
            @if($order->payment_method == 'cash' && $order->payment_status == 'pending')
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-exclamation-triangle me-1"></i>@lang('messages.cash_payment_pending')
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            @if($order->delivery_type == 'delivery')
                                @lang('messages.customer_will_pay_cash_on_delivery')
                            @else
                                @lang('messages.customer_will_pay_cash_at_restaurant')
                            @endif
                        </p>
                        <form method="POST" action="{{ route('admin.order.updatePayment', $order->id) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="payment_status" value="paid">
                            <button type="submit" class="btn btn-success btn-sm" 
                                    onclick="return confirm('@lang('messages.confirm_cash_payment_received')')">
                                <i class="fas fa-check-circle me-1"></i>@lang('messages.mark_as_paid')
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
