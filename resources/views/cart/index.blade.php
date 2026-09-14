@extends('layout.app')

@section('title', 'Cart - Imperial Spice')
@section('active', 'cart')

@push('styles')
<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }

    /* --- Page Header --- */
    .cart-header {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        padding: 80px 0 40px;
        position: relative;
    }

    .cart-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background-color: var(--primary-orange);
        border-radius: 2px;
    }

    /* --- Premium Cards --- */
    .premium-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: none;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .premium-card-header {
        background-color: #fff;
        border-bottom: 1px solid #f0f2f5;
        padding: 1.5rem;
    }

    .premium-card-body {
        padding: 1.5rem;
    }

    /* --- Cart Items --- */
    .cart-item-row {
        transition: all 0.2s ease;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.5rem;
    }
    
    .cart-item-row:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .cart-item-img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* --- Quantity Controls --- */
    .qty-control {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border-radius: 50px;
        padding: 0.25rem;
        width: fit-content;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: #fff;
        color: var(--primary-orange);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background: var(--primary-orange);
        color: #fff;
    }

    .qty-input {
        width: 40px;
        text-align: center;
        border: none;
        background: transparent;
        font-weight: 600;
        color: #2d3436;
    }

    .qty-input:focus {
        outline: none;
    }

    /* --- Action Buttons --- */
    .btn-remove {
        color: #dc3545;
        background: rgba(220, 53, 69, 0.1);
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        background: #dc3545;
        color: #fff;
        transform: scale(1.1);
    }

    .btn-brand {
        background: var(--primary-orange);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(211, 84, 0, 0.2);
        transition: all 0.3s ease;
    }

    .btn-brand:hover {
        background: #b54600;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(211, 84, 0, 0.3);
    }
    
    .btn-brand:disabled {
        background: #e0e0e0;
        box-shadow: none;
        transform: none;
        cursor: not-allowed;
    }

    .btn-outline-brand {
        background: transparent;
        color: var(--primary-orange);
        border: 2px solid var(--primary-orange);
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-brand:hover {
        background: var(--primary-orange);
        color: #fff;
    }

    /* --- Order Summary --- */
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: #636e72;
        font-weight: 500;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px dashed #f0f2f5;
        color: #2d3436;
        font-size: 1.25rem;
        font-weight: 800;
    }

    .discount-box {
        background: rgba(40, 167, 69, 0.1);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 4px solid #28a745;
    }

</style>
@endpush

@section('content')

    <!-- Cart Header -->
    <section class="cart-header mt-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold" style="color: #2d3436;">@lang('messages.shopping_cart')</h1>
            <p class="lead text-muted">@lang('messages.review_items')</p>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <!-- Cart Items Column -->
                <div class="col-lg-8">
                    <div class="premium-card">
                        <div class="premium-card-header d-flex align-items-center">
                            <i class="fas fa-shopping-bag fs-4 me-3" style="color: var(--primary-orange);"></i>
                            <h5 class="mb-0 fw-bold" style="color: #2d3436;">@lang('messages.cart_items')</h5>
                        </div>
                        <div class="premium-card-body p-4">
                            @if ($cartItems->isEmpty())
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="fas fa-shopping-basket fa-4x" style="color: #e9ecef;"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark">@lang('messages.cart_empty')</h4>
                                    <p class="text-muted mb-4">@lang('messages.cart_empty_message')</p>
                                    <a href="{{ route('menu') }}" class="btn btn-brand">
                                        <i class="fas fa-utensils me-2"></i>@lang('messages.browse_menu')
                                    </a>
                                </div>
                            @else
                                @foreach ($cartItems as $item)
                                    <div class="row align-items-center cart-item-row" id="cart-item-{{ $item->id }}">
                                        <div class="col-3 col-md-2 mb-3 mb-md-0">
                                            <img src="{{ asset($item->menuItem->image) }}" class="cart-item-img" alt="{{ $item->menuItem->name }}">
                                        </div>
                                        <div class="col-9 col-md-4 mb-3 mb-md-0">
                                            <h6 class="fw-bold text-dark mb-1">{{ $item->menuItem->name }}</h6>
                                            <span class="badge" style="background-color: var(--soft-orange); color: var(--primary-orange);">€{{ number_format($item->menuItem->price, 2) }}</span>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="qty-control mx-md-auto">
                                                <button class="qty-btn quantity-btn" data-cart-id="{{ $item->id }}" data-action="decrease" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="qty-input quantity-display" value="{{ $item->quantity }}" readonly>
                                                <button class="qty-btn quantity-btn" data-cart-id="{{ $item->id }}" data-action="increase" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-2 text-end text-md-center">
                                            <span class="fw-bold fs-5 item-total" style="color: var(--primary-orange);" data-price="{{ $item->menuItem->price }}" data-quantity="{{ $item->quantity }}">
                                                €{{ number_format($item->menuItem->price * $item->quantity, 2) }}
                                            </span>
                                        </div>
                                        <div class="col-2 col-md-1 text-end">
                                            <button class="btn-remove remove-item ms-auto" data-cart-id="{{ $item->id }}" type="button" title="Remove Item">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr class="my-2" style="border-color: #f0f2f5;">
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary Column -->
                <div class="col-lg-4">
                    <div class="premium-card sticky-top" style="top: 100px;">
                        <div class="premium-card-header d-flex align-items-center">
                            <i class="fas fa-receipt fs-4 me-3" style="color: var(--primary-orange);"></i>
                            <h5 class="mb-0 fw-bold" style="color: #2d3436;">@lang('messages.order_summary')</h5>
                        </div>
                        <div class="premium-card-body p-4">
                            @php
                                // Use values from controller only!
                            @endphp

                            <div class="summary-row">
                                <span>@lang('messages.subtotal')</span>
                                <span class="fw-bold text-dark" id="subtotal-amount">€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            @if ($isEligibleForDiscount)
                                <div class="discount-box">
                                    <div class="d-flex justify-content-between text-success fw-bold mb-1">
                                        <span><i class="fas fa-tag me-2"></i>New User ({{ $discountPercentage }}%)</span>
                                        <span>−€{{ number_format($discountAmount, 2) }}</span>
                                    </div>
                                    <small class="text-success opacity-75">Welcome! Enjoy your first order on us.</small>
                                </div>
                            @endif
                            
                            <div class="summary-total">
                                <span>@lang('messages.total')</span>
                                <span style="color: var(--primary-orange);" id="total-amount">€{{ number_format($finalTotal, 2) }}</span>
                            </div>

                            <div class="d-grid gap-3 mt-4">
                                @if (!$cartItems->isEmpty())
                                    <a href="{{ route('checkout') }}" class="btn btn-brand btn-lg d-flex justify-content-between align-items-center">
                                        <span>@lang('messages.proceed_to_checkout')</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @else
                                    <button class="btn btn-brand btn-lg d-flex justify-content-between align-items-center" disabled>
                                        <span>@lang('messages.proceed_to_checkout')</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                @endif
                                <a href="{{ route('menu') }}" class="btn btn-outline-brand btn-lg d-flex justify-content-center align-items-center">
                                    <i class="fas fa-undo-alt me-2"></i>@lang('messages.browse_menu')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function updateCartCount(count) {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = count;
                cartCountElement.style.transform = 'scale(1.3)';
                cartCountElement.style.transition = 'transform 0.2s ease';
                setTimeout(() => {
                    cartCountElement.style.transform = 'scale(1)';
                }, 200);
            }
        }

        // We only use server-side totals on initial load, but if JS updates it:
        function updateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.item-total').forEach(element => {
                const price = parseFloat(element.dataset.price);
                const quantity = parseInt(element.dataset.quantity);
                subtotal += price * quantity;
            });

            // Note: Since discounts apply on checkout, we simply update subtotal here.
            // If the user adds/removes items, they might need to reload to see updated discounts.
            // A simple approach is just redirecting on change, but fetch is currently doing DOM updates.
            
            // Reload page to get accurate server-side totals including dynamic discounts
            window.location.reload(); 
        }

        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItemId = this.dataset.cartId;
                const action = this.dataset.action;
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
                        // Instead of manually calculating dynamic discount JS, just reload
                        // to keep it perfectly aligned with backend rules.
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Failed to update item');
                    }
                })
                .catch(error => {
                    console.error('Cart error:', error);
                    window.location.reload();
                });
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                if (!confirm('Are you sure you want to remove this item?')) return;
                
                const cartItemId = this.dataset.cartId;
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
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Failed to remove item');
                    }
                })
                .catch(error => {
                    console.error('Remove error:', error);
                    window.location.reload();
                });
            });
        });
    </script>
@endpush
