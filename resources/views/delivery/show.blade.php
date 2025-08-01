@extends('delivery.sidebar')

@section('title', __('messages.order_details') . ' - ' . __('messages.imperial_spice'))
@section('active', 'dashboard')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>@lang('messages.order_details') #{{ $delivery->order_id }}</h2>
        <a href="{{ route('delivery.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>@lang('messages.back_to_dashboard')
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="row">
        <!-- Order Information -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>@lang('messages.order_information')
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.customer_name'):</strong> 
                                    <span>{{ $delivery->order->user->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.customer_phone'):</strong> 
                                    <span>{{ $delivery->order->user->phone ?? __('messages.not_available') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.total_amount'):</strong> 
                                    <span class="fw-bold text-success">{{ __('messages.currency') }}{{ number_format($delivery->order->total_amount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.payment_method'):</strong> 
                                    <span class="badge bg-{{ $delivery->order->payment_method == 'card' ? 'primary' : 'warning text-dark' }}">
                                        <i class="fas {{ $delivery->order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} me-1"></i>
                                        @lang('messages.payment_method_' . $delivery->order->payment_method)
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.payment_status'):</strong> 
                                    <span class="badge bg-{{ $delivery->order->payment_status === 'paid' ? 'success' : ($delivery->order->payment_status === 'failed' ? 'danger' : 'warning text-dark') }}">
                                        @lang('messages.payment_status_' . $delivery->order->payment_status)
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.order_status'):</strong> 
                                    <span class="badge bg-{{ $delivery->order->order_status === 'delivered' ? 'success' : ($delivery->order->order_status === 'cancelled' ? 'danger' : 'info') }}">
                                        @lang('messages.order_status_' . $delivery->order->order_status)
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.delivery_status'):</strong> 
                                    <span class="badge bg-{{ $delivery->status == 'delivered' ? 'success' : ($delivery->status == 'out_for_delivery' ? 'primary' : 'info') }}">
                                        @lang('messages.delivery_status_' . $delivery->status)
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>@lang('messages.assigned_at'):</strong> 
                                    <span>{{ $delivery->created_at->format('d M Y, h:i A') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Address -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>@lang('messages.delivery_address')
                    </h5>
                </div>
                <div class="card-body">
                    <address class="mb-0">
                        <strong>{{ $delivery->order->delivery_address }}</strong>
                        @if($delivery->order->postal_code)
                            <br>@lang('messages.postal_code'): {{ $delivery->order->postal_code }}
                        @endif
                    </address>
                </div>
            </div>

            <!-- Order Items -->
            @if($delivery->order->orderItems && $delivery->order->orderItems->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-utensils me-2"></i>@lang('messages.order_items')
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>@lang('messages.item')</th>
                                        <th class="text-center">@lang('messages.quantity')</th>
                                        <th class="text-end">@lang('messages.price')</th>
                                        <th class="text-end">@lang('messages.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($delivery->order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->menu_item_name ?? $item->menuItem->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ __('messages.currency') }}{{ number_format($item->price, 2) }}</td>
                                            <td class="text-end">{{ __('messages.currency') }}{{ number_format($item->quantity * $item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- OTP Verification Section -->
        <div class="col-md-4">

            <!-- OTP Verification Form -->
            @if($delivery->status !== 'delivered')
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-check-circle me-2"></i>@lang('messages.verify_delivery')
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('delivery.orders.verifyOtp', $delivery->order_id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="otp" class="form-label">@lang('messages.enter_customer_otp')</label>
                                <input type="text" 
                                       name="otp" 
                                       id="otp"
                                       class="form-control form-control-lg text-center @error('otp') is-invalid @enderror" 
                                       maxlength="6" 
                                       placeholder="000000"
                                       required>
                                @error('otp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            @if($delivery->order->payment_method == 'cash' && $delivery->order->payment_status == 'pending')
                                <div class="alert alert-warning alert-sm">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    <small>@lang('messages.collect_cash_before_verification')</small>
                                </div>
                            @endif
                            
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-check me-2"></i>@lang('messages.verify_and_complete')
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-success">@lang('messages.delivery_completed')</h5>
                        <p class="text-muted">@lang('messages.order_successfully_delivered')</p>
                    </div>
                </div>
            @endif

            <!-- Instructions -->
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>@lang('messages.instructions')
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            @lang('messages.verify_customer_identity')
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            @lang('messages.confirm_order_items')
                        </li>
                        @if($delivery->order->payment_method == 'cash')
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-warning me-2"></i>
                                @lang('messages.collect_payment_first')
                            </li>
                        @endif
                        <li class="mb-0">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            @lang('messages.get_otp_from_customer')
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
