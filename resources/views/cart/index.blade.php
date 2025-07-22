@extends('layout.app')

@section('title', 'Cart - Imperial Spice')
@section('active', 'cart')

@section('content')

    <!-- Cart Header -->
    <section class="py-5 mt-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold">@lang('messages.shopping_cart')</h1>
                <p class="lead">@lang('messages.review_items')</p>
            </div>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-shopping-cart me-2"></i>@lang('messages.cart_items')
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($cartItems->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5>@lang('messages.cart_empty')</h5>
                                    <p class="text-muted">@lang('messages.cart_empty_message')</p>
                                    <a href="{{ route('menu') }}" class="btn btn-primary">@lang('messages.browse_menu')</a>
                                </div>
                            @else
                                @foreach ($cartItems as $item)
                                    <div class="row align-items-center border-bottom py-3">
                                        <div class="col-md-2">
                                            <img src="{{ asset('storage/' . $item->menuItem->image) }}"
                                                class="img-fluid rounded" alt="{{ $item->menuItem->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">{{ $item->menuItem->name }}</h6>
                                            <p class="text-muted mb-0">€{{ number_format($item->menuItem->price, 2) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm">
                                                    <button class="btn btn-outline-secondary" name="action"
                                                        value="decrease" type="submit">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="text" class="form-control text-center"
                                                        value="{{ $item->quantity }}" readonly>
                                                    <button class="btn btn-outline-secondary" name="action"
                                                        value="increase" type="submit">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <span
                                                class="fw-bold">€{{ number_format($item->menuItem->price * $item->quantity, 2) }}</span>
                                        </div>
                                        <div class="col-md-1">
                                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>@lang('messages.order_summary')
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $subtotal = $cartItems->sum(fn($item) => $item->menuItem->price * $item->quantity);
                                $taxRate = 0.1; // 10% IVA
                                $tax = $subtotal * $taxRate;
                                $total = $subtotal + $tax;
                            @endphp

                            <div class="d-flex justify-content-between mb-2">
                                <span>@lang('messages.subtotal'):</span>
                                <span>€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>@lang('messages.tax'):</span>
                                <span>€{{ number_format($tax, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold h5">
                                <span>@lang('messages.total'):</span>
                                <span>€{{ number_format($total, 2) }}</span>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                @if (!$cartItems->isEmpty())
                                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-credit-card me-2"></i>@lang('messages.proceed_to_checkout')
                                    </a>
                                @else
                                    <button class="btn btn-primary btn-lg" disabled>
                                        <i class="fas fa-credit-card me-2"></i>@lang('messages.proceed_to_checkout')
                                    </button>
                                @endif
                                <a href="{{ route('menu') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>@lang('messages.browse_menu')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
