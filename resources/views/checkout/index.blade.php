@extends('layout.app')

@section('title', __('messages.checkout_title'))

@push('styles')
<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }

    body {
        background-color: #fff;
    }

    /* --- Form Controls & Floating Labels --- */
    .form-floating > .form-control,
    .form-floating > .form-select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }
    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 0 0.25rem rgba(211, 84, 0, 0.1);
    }
    .form-floating > label {
        padding: 1rem 0.75rem;
        color: #6c757d;
        font-weight: 500;
    }

    /* --- Custom Selectors (Order Type & Payment) --- */
    .custom-selector {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        color: #6c757d;
        transition: all 0.2s ease;
        background: #fff;
        cursor: pointer;
    }
    
    .custom-selector:hover {
        border-color: #ced4da;
        background: #f8f9fa;
    }

    .btn-check:checked + .custom-selector {
        border-color: var(--primary-orange);
        color: var(--primary-orange);
        background: rgba(211, 84, 0, 0.05);
        box-shadow: 0 4px 10px rgba(211, 84, 0, 0.08);
    }

    /* --- Submit Button --- */
    .btn-brand {
        background: var(--primary-orange);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 1rem;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(211, 84, 0, 0.2);
    }

    .btn-brand:hover {
        background: #b54600;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(211, 84, 0, 0.3);
    }

    /* --- Order Summary Box --- */
    .summary-box {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 2rem;
        position: sticky;
        top: 100px;
    }

    .item-img-wrapper {
        position: relative;
        width: 64px;
        height: 64px;
    }

    .item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        background: #fff;
    }

    .item-qty-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #6c757d;
        color: #fff;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        border: 2px solid #f8f9fa;
    }

    .totals-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        color: #495057;
        font-weight: 500;
    }

    .totals-row.final {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e9ecef;
        color: #212529;
        font-size: 1.3rem;
        font-weight: 800;
    }
</style>
@endpush

@section('content')
<section class="py-5 mt-5">
    <div class="container py-4">
        
        @if (session('error'))
            <div class="alert alert-danger text-center shadow-sm rounded-3 border-0 mb-4">{{ session('error') }}</div>
        @endif

        @if (!empty($shopClosed) && $shopClosed)
            <div class="alert alert-warning text-center shadow-sm rounded-3 border-0 mb-4">
                <strong class="d-block mb-1"><i class="fas fa-store-alt-slash me-2"></i>@lang('messages.shop_closed_title')</strong>
                <span>@lang('messages.shop_closed_message')</span>
            </div>
        @endif

        <div class="row g-5">
            
            <!-- LEFT COLUMN: Checkout Form -->
            <div class="col-lg-7 pe-lg-5">
                <h3 class="fw-bold mb-4">Checkout</h3>
                
                <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">1. Order Type</h5>
                
                <!-- Custom Radio Tabs -->
                <div class="row g-3 mb-5" role="tablist">
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_dinein" data-bs-toggle="tab" data-bs-target="#dinein" checked>
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_dinein">
                            <i class="fas fa-chair fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">@lang('messages.dine_in')</span>
                        </label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_takeaway" data-bs-toggle="tab" data-bs-target="#takeaway">
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_takeaway">
                            <i class="fas fa-shopping-bag fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">Takeaway</span>
                        </label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="btn-check" name="order_type" id="type_delivery" data-bs-toggle="tab" data-bs-target="#delivery">
                        <label class="custom-selector w-100 p-3 h-100 text-center" for="type_delivery">
                            <i class="fas fa-truck fs-4 mb-2 d-block"></i>
                            <span class="fw-bold d-block" style="font-size: 0.9rem;">@lang('messages.delivery')</span>
                        </label>
                    </div>
                </div>

                <!-- Tab Content Forms -->
                <div class="tab-content" id="checkoutTabsContent">
                    
                    <!-- DINE IN -->
                    <div class="tab-pane fade show active" id="dinein" role="tabpanel">
                        <form method="POST" action="{{ route('checkout.dinein') }}">
                            @csrf
                            
                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">2. Table Details</h5>
                            <div class="form-floating mb-5">
                                <select name="table_no" class="form-select shadow-sm" id="tableSelect" required>
                                    <option value="" disabled selected>@lang('messages.choose_a_table')</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}">@lang('messages.table') {{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="tableSelect">@lang('messages.select_table_number')</label>
                            </div>
                            
                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">3. Payment</h5>
                            <div class="row g-3 mb-5">
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="dinein_card" value="card" checked>
                                    <label class="custom-selector w-100 p-3 text-start" for="dinein_card">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-credit-card fs-4 me-3"></i>
                                            <span class="fw-bold">@lang('messages.card_payment')</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="dinein_cash" value="cash">
                                    <label class="custom-selector w-100 p-3 text-start" for="dinein_cash">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-money-bill-wave fs-4 me-3"></i>
                                            <span class="fw-bold">@lang('messages.cash_payment')</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-brand" id="dinein-submit-btn">
                                <span id="dinein-btn-text">@lang('messages.place_dinein_order')</span>
                            </button>
                        </form>
                    </div>

                    <!-- TAKEAWAY -->
                    <div class="tab-pane fade" id="takeaway" role="tabpanel">
                        <form method="POST" action="{{ route('checkout.takeaway') }}">
                            @csrf
                            
                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">2. Pickup Details</h5>
                            <div class="alert alert-info border-0 shadow-sm mb-5 rounded-3 d-flex align-items-center">
                                <i class="fas fa-info-circle fs-4 me-3 text-info"></i>
                                <div>Your order will be prepared for pickup at our restaurant counter.</div>
                            </div>

                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">3. Payment</h5>
                            <div class="row g-3 mb-5">
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="takeaway_card" value="card" checked>
                                    <label class="custom-selector w-100 p-3 text-start" for="takeaway_card">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-credit-card fs-4 me-3"></i>
                                            <span class="fw-bold">@lang('messages.card_payment')</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="takeaway_cash" value="cash">
                                    <label class="custom-selector w-100 p-3 text-start" for="takeaway_cash">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-money-bill-wave fs-4 me-3"></i>
                                            <span class="fw-bold">Cash on Pickup</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-brand" id="takeaway-submit-btn">
                                <span id="takeaway-btn-text">@lang('messages.proceed_to_payment')</span>
                            </button>
                        </form>
                    </div>

                    <!-- DELIVERY -->
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <form method="POST" action="{{ route('checkout.delivery') }}">
                            @csrf
                            
                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">2. Delivery Address</h5>
                            <div class="form-floating mb-3">
                                <textarea name="address" class="form-control shadow-sm" id="deliveryAddress" style="height: 100px" placeholder="@lang('messages.enter_complete_address')" required></textarea>
                                <label for="deliveryAddress">@lang('messages.delivery_address')</label>
                            </div>
                            <div class="form-floating mb-5">
                                <input type="text" name="postal_code" id="postal_code" class="form-control shadow-sm" placeholder="@lang('messages.postal_code_example')" required>
                                <label for="postal_code">@lang('messages.postal_code')</label>
                                <div class="form-text mt-2"><i class="fas fa-truck me-1"></i>@lang('messages.delivery_area_note')</div>
                            </div>

                            <h5 class="fw-bold mb-3 fs-6 text-muted text-uppercase tracking-wide">3. Payment</h5>
                            <div class="row g-3 mb-5">
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="delivery_card" value="card" checked>
                                    <label class="custom-selector w-100 p-3 text-start" for="delivery_card">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-credit-card fs-4 me-3"></i>
                                            <span class="fw-bold">@lang('messages.card_payment')</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="btn-check" type="radio" name="payment_method" id="delivery_cash" value="cash">
                                    <label class="custom-selector w-100 p-3 text-start" for="delivery_cash">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-money-bill-wave fs-4 me-3"></i>
                                            <span class="fw-bold">@lang('messages.cash_on_delivery')</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn-brand" id="delivery-submit-btn">
                                <span id="delivery-btn-text">@lang('messages.proceed_to_payment')</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary -->
            <div class="col-lg-5">
                <div class="summary-box">
                    <h4 class="fw-bold mb-4">Order Summary</h4>
                    
                    <!-- Items List -->
                    <div class="mb-4">
                        @if(isset($cartItems) && !$cartItems->isEmpty())
                            @foreach($cartItems as $item)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="item-img-wrapper">
                                        <img src="{{ asset($item->menuItem->image) }}" class="item-img" alt="{{ $item->menuItem->name }}"
                                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/f8f9fa/d35400?text={{ urlencode($item->menuItem->name) }}';">
                                        <span class="item-qty-badge">{{ $item->quantity }}</span>
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-0 fw-bold text-dark">{{ $item->menuItem->name }}</h6>
                                    </div>
                                    <div class="fw-bold text-dark">
                                        {{ __('messages.currency') }}{{ number_format($item->menuItem->price * $item->quantity, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <hr style="border-color: #dee2e6;">

                    <div class="totals-row mt-3">
                        <span>@lang('messages.subtotal')</span>
                        <span class="fw-bold text-dark">{{ __('messages.currency') }}{{ number_format($subtotal ?? 0, 2) }}</span>
                    </div>
                    
                    <div class="totals-row d-none" id="delivery-charge-row">
                        <span>@lang('messages.delivery_charge')</span>
                        <span class="fw-bold text-dark" id="delivery-charge">{{ __('messages.currency') }}0.00</span>
                    </div>
                    
                    @if($isEligibleForDiscount ?? false)
                        <div class="totals-row text-success">
                            <span><i class="fas fa-tag me-1"></i>New User ({{ $discountPercentage }}%)</span>
                            <span class="fw-bold">−{{ __('messages.currency') }}{{ number_format($discountAmount, 2) }}</span>
                        </div>
                    @endif
                    
                    <div class="totals-row final">
                        <span>@lang('messages.total')</span>
                        <span id="total" style="color: var(--primary-orange);">{{ __('messages.currency') }}{{ number_format($finalTotal ?? $total ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeDineInRadio = document.getElementById('type_dinein');
        const typeTakeawayRadio = document.getElementById('type_takeaway');
        const typeDeliveryRadio = document.getElementById('type_delivery');
        
        const deliveryChargeRow = document.getElementById('delivery-charge-row');
        const deliveryChargeElement = document.getElementById('delivery-charge');
        const totalElement = document.getElementById('total');
        const postalCodeInput = document.getElementById('postal_code');
        
        const deliverySubmitBtn = document.getElementById('delivery-submit-btn');
        const deliveryBtnText = document.getElementById('delivery-btn-text');
        const dineinSubmitBtn = document.getElementById('dinein-submit-btn');
        const dineinBtnText = document.getElementById('dinein-btn-text');
        const takeawaySubmitBtn = document.getElementById('takeaway-submit-btn');
        const takeawayBtnText = document.getElementById('takeaway-btn-text');
        
        const deliveryCardRadio = document.getElementById('delivery_card');
        const deliveryCashRadio = document.getElementById('delivery_cash');
        const dineinCardRadio = document.getElementById('dinein_card');
        const dineinCashRadio = document.getElementById('dinein_cash');
        const takeawayCardRadio = document.getElementById('takeaway_card');
        const takeawayCashRadio = document.getElementById('takeaway_cash');
        
        const currencySymbol = '{{ __("messages.currency") }}';
        
        const deliveryCharges = {
            '08880': 3.00,
            '08800': 0.00,
            '08812': 2.00,
            '08870': 4.00
        };

        function updateDeliveryButton() {
            if (deliveryCashRadio && deliveryCashRadio.checked) {
                deliveryBtnText.textContent = '@lang("messages.place_order")';
            } else {
                deliveryBtnText.textContent = '@lang("messages.proceed_to_payment")';
            }
        }

        function updateDineinButton() {
            if (dineinCashRadio && dineinCashRadio.checked) {
                dineinBtnText.textContent = '@lang("messages.place_order")';
            } else {
                dineinBtnText.textContent = '@lang("messages.proceed_to_payment")';
            }
        }

        function updateTakeawayButton() {
            if (takeawayCashRadio && takeawayCashRadio.checked) {
                takeawayBtnText.textContent = '@lang("messages.place_order")';
            } else {
                takeawayBtnText.textContent = '@lang("messages.proceed_to_payment")';
            }
        }

        function updateSummaryForTab(tabType) {
            const discountPercentage = {{ $discountPercentage ?? 0 }};
            const isEligibleForDiscount = {{ ($isEligibleForDiscount ?? false) ? 'true' : 'false' }};
            const subtotal = {{ $subtotal ?? 0 }};
            let fee = 0;

            if (tabType === 'delivery') {
                const postal = postalCodeInput?.value.trim();
                if (postal && deliveryCharges[postal] !== undefined) {
                    fee = deliveryCharges[postal];
                    deliveryChargeRow.classList.remove('d-none');
                } else {
                    fee = 0;
                    deliveryChargeRow.classList.add('d-none');
                }
                deliveryChargeElement.textContent = `${currencySymbol}${fee.toFixed(2)}`;
            } else {
                deliveryChargeRow.classList.add('d-none');
                fee = 0;
            }

            let total = subtotal + fee;
            let discountAmount = 0;
            let finalTotal = total;

            if (isEligibleForDiscount && discountPercentage > 0) {
                discountAmount = (total * discountPercentage) / 100;
                finalTotal = total - discountAmount;
                // find discount display span
                const discountRow = document.querySelector('.totals-row.text-success');
                if (discountRow) {
                    discountRow.querySelector('.fw-bold').textContent = `−${currencySymbol}${discountAmount.toFixed(2)}`;
                }
            }

            totalElement.textContent = `${currencySymbol}${finalTotal.toFixed(2)}`;
        }

        // Listen for Payment Method Changes
        if (deliveryCardRadio) deliveryCardRadio.addEventListener('change', updateDeliveryButton);
        if (deliveryCashRadio) deliveryCashRadio.addEventListener('change', updateDeliveryButton);
        
        if (dineinCardRadio) dineinCardRadio.addEventListener('change', updateDineinButton);
        if (dineinCashRadio) dineinCashRadio.addEventListener('change', updateDineinButton);
        
        if (takeawayCardRadio) takeawayCardRadio.addEventListener('change', updateTakeawayButton);
        if (takeawayCashRadio) takeawayCashRadio.addEventListener('change', updateTakeawayButton);

        // Listen for Order Type (Tab) Changes using standard BS5 tab events
        document.querySelectorAll('input[name="order_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.id === 'type_delivery') {
                    updateSummaryForTab('delivery');
                    updateDeliveryButton();
                } else if (this.id === 'type_dinein') {
                    updateSummaryForTab('dinein');
                    updateDineinButton();
                } else if (this.id === 'type_takeaway') {
                    updateSummaryForTab('takeaway');
                    updateTakeawayButton();
                }
            });
        });

        postalCodeInput?.addEventListener('input', function () {
            if (typeDeliveryRadio && typeDeliveryRadio.checked) {
                updateSummaryForTab('delivery');
            }
        });
        
        // Init state
        updateDineinButton();
    });
</script>
@endpush
