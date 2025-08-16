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
                                    <a href="{{ route('menu') }}" class="btn btn-primary">@lang('messages.browse_menu')
                                    </a>
                                </div>
                            @else
                                @foreach ($cartItems as $item)
                                    <div class="row align-items-center border-bottom py-3" id="cart-item-{{ $item->id }}">
                                        <div class="col-md-2">
                                            <img src="{{ asset('storage/' . $item->menuItem->image) }}"
                                                class="img-fluid rounded" alt="{{ $item->menuItem->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">{{ $item->menuItem->name }}</h6>
                                            <p class="text-muted mb-0">€{{ number_format($item->menuItem->price, 2) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-sm">
                                                <button class="btn btn-outline-secondary quantity-btn" 
                                                        data-cart-id="{{ $item->id }}" 
                                                        data-action="decrease" 
                                                        type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center quantity-display"
                                                        value="{{ $item->quantity }}" readonly>
                                                <button class="btn btn-outline-secondary quantity-btn" 
                                                        data-cart-id="{{ $item->id }}" 
                                                        data-action="increase" 
                                                        type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="fw-bold item-total" data-price="{{ $item->menuItem->price }}" data-quantity="{{ $item->quantity }}">
                                                €{{ number_format($item->menuItem->price * $item->quantity, 2) }}
                                            </span>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-sm btn-outline-danger remove-item" 
                                                    data-cart-id="{{ $item->id }}" 
                                                    type="button">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
                                $total = $subtotal;
                                $discountAmount = 0;
                                $discountPercentage = 0;
                                $finalTotal = $total;
                                if ($isEligibleForDiscount ?? false) {
                                    $discountPercentage = $discountPercentage ?? rand(15, 20);
                                    $discountAmount = ($total * $discountPercentage) / 100;
                                    $finalTotal = $total - $discountAmount;
                                }
                            @endphp

                            <div class="d-flex justify-content-between mb-2">
                                <span>@lang('messages.subtotal'):</span>
                                <span id="subtotal-amount">€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            @if($isEligibleForDiscount ?? false)
                                <div class="d-flex justify-content-between mb-2 bg-light text-success">
                                    <div>
                                        <strong>New User Discount ({{ $discountPercentage }}%)</strong>
                                        <br>
                                        <small>Welcome! Enjoy your first order on us.</small>
                                    </div>
                                    <span>−€{{ number_format($discountAmount, 2) }}</span>
                                </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between fw-bold h5">
                                <span>@lang('messages.total'):</span>
                                <span id="total-amount">€{{ number_format($finalTotal, 2) }}</span>
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

    <script>
        function updateCartCount(count) {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = count;

                // Add animation effect
                cartCountElement.style.transform = 'scale(1.3)';
                cartCountElement.style.transition = 'transform 0.2s ease';

                setTimeout(() => {
                    cartCountElement.style.transform = 'scale(1)';
                }, 200);
            }
        }

        function updateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.item-total').forEach(element => {
                const price = parseFloat(element.dataset.price);
                const quantity = parseInt(element.dataset.quantity);
                subtotal += price * quantity;
            });
            
            const tax = subtotal * 0.1;
            const total = subtotal + tax;
            
            document.getElementById('subtotal-amount').textContent = '€' + subtotal.toFixed(2);
            document.getElementById('tax-amount').textContent = '€' + tax.toFixed(2);
            document.getElementById('total-amount').textContent = '€' + total.toFixed(2);
        }

        // Quantity update buttons
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItemId = this.dataset.cartId;
                const action = this.dataset.action;
                const quantityDisplay = this.parentElement.querySelector('.quantity-display');
                const itemTotalElement = this.closest('.row').querySelector('.item-total');
                
                // Disable button during request
                this.disabled = true;
                
                fetch(`/cart/update/${cartItemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: `_method=PUT&action=${action}`
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        if (data.cart_count !== undefined) {
                            updateCartCount(data.cart_count);
                        }
                        location.reload(); // Reload to update everything
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    location.reload(); // Reload on error
                })
                .finally(() => {
                    this.disabled = false;
                });
            });
        });

        // Remove item
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const cartItemId = this.dataset.cartId;

                if (confirm('Are you sure you want to remove this item?')) {
                    this.disabled = true;
                    
                    fetch(`/cart/remove/${cartItemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: '_method=DELETE'
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            if (data.cart_count !== undefined) {
                                updateCartCount(data.cart_count);
                            }
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        location.reload();
                    })
                    .finally(() => {
                        this.disabled = false;
                    });
                }
            });
        });
    </script>
@endsection
