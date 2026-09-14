import os

filepath = 'resources/views/checkout/index.blade.php'

content = """@extends('layout.app')

@section('title', __('messages.checkout_title'))

@push('styles')
<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }

    /* --- Page Header --- */
    .checkout-header {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        padding: 80px 0 40px;
        position: relative;
    }

    .checkout-header::after {
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
        padding: 2rem;
    }

    /* --- Modern Tabs --- */
    .modern-tabs {
        display: flex;
        background: #f8f9fa;
        border-radius: 50px;
        padding: 6px;
        margin-bottom: 2rem;
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    }

    .modern-tabs .nav-link {
        flex: 1;
        text-align: center;
        border-radius: 50px;
        padding: 12px 20px;
        color: #6c757d;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        background: transparent;
    }

    .modern-tabs .nav-link:hover {
        color: var(--primary-orange);
    }

    .modern-tabs .nav-link.active {
        background: #fff;
        color: var(--primary-orange);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* --- Custom Form Controls --- */
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 0 0.25rem rgba(211, 84, 0, 0.1);
    }

    /* --- Payment Radio Cards --- */
    .payment-card {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #495057;
    }

    .payment-card:hover {
        border-color: #ced4da;
        background: #f8f9fa;
    }

    .btn-check:checked + .payment-card {
        border-color: var(--primary-orange);
        background: var(--soft-orange);
        color: var(--primary-orange);
        box-shadow: 0 4px 15px rgba(211, 84, 0, 0.1);
    }

    /* --- Buttons --- */
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

    /* --- Summary --- */
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
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px dashed #f0f2f5;
        color: #2d3436;
        font-size: 1.25rem;
        font-weight: 800;
    }
</style>
@endpush

@section('content')

    <!-- Checkout Header -->
    <section class="checkout-header mt-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold" style="color: #2d3436;">@lang('messages.checkout_title')</h1>
            <p class="lead text-muted">@lang('messages.select_dinein_or_delivery')</p>
        </div>
    </section>

    <!-- Checkout Content -->
    <section class="py-5 bg-white">
        <div class="container">
            
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
                <div class="col-lg-8">
                    <!-- Custom Tabs -->
                    <ul class="nav modern-tabs" id="checkoutTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dinein-tab" data-bs-toggle="tab" data-bs-target="#dinein" type="button" role="tab">
                                <i class="fas fa-chair me-2"></i>@lang('messages.dine_in')
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="takeaway-tab" data-bs-toggle="tab" data-bs-target="#takeaway" type="button" role="tab">
                                <i class="fas fa-shopping-bag me-2"></i>Takeaway
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">
                                <i class="fas fa-truck me-2"></i>@lang('messages.delivery')
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="checkoutTabsContent">
                        
                        <!-- DINE IN -->
                        <div class="tab-pane fade show active" id="dinein" role="tabpanel">
                            <div class="premium-card">
                                <div class="premium-card-header d-flex align-items-center">
                                    <i class="fas fa-utensils fs-4 me-3" style="color: var(--primary-orange);"></i>
                                    <h5 class="mb-0 fw-bold">@lang('messages.dine_in_details')</h5>
                                </div>
                                <div class="premium-card-body">
                                    <form method="POST" action="{{ route('checkout.dinein') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="table_no" class="form-label fw-bold text-dark">@lang('messages.select_table_number')</label>
                                            <select name="table_no" class="form-select" required>
                                                <option value="" disabled selected>@lang('messages.choose_a_table')</option>
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}">@lang('messages.table') {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                        <div class="mb-5">
                                            <label class="form-label fw-bold text-dark mb-3">@lang('messages.payment_method')</label>
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="dinein_card" value="card" checked>
                                                    <label class="payment-card w-100 p-3 text-center" for="dinein_card">
                                                        <i class="fas fa-credit-card fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">@lang('messages.card_payment')</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="dinein_cash" value="cash">
                                                    <label class="payment-card w-100 p-3 text-center" for="dinein_cash">
                                                        <i class="fas fa-money-bill-wave fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">@lang('messages.cash_payment')</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-brand btn-lg" id="dinein-submit-btn">
                                                <i class="fas fa-credit-card me-2"></i><span id="dinein-btn-text">@lang('messages.place_dinein_order')</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- TAKEAWAY -->
                        <div class="tab-pane fade" id="takeaway" role="tabpanel">
                            <div class="premium-card">
                                <div class="premium-card-header d-flex align-items-center">
                                    <i class="fas fa-shopping-bag fs-4 me-3" style="color: var(--primary-orange);"></i>
                                    <h5 class="mb-0 fw-bold">Takeaway Details</h5>
                                </div>
                                <div class="premium-card-body">
                                    <form method="POST" action="{{ route('checkout.takeaway') }}">
                                        @csrf
                                        <div class="mb-5">
                                            <label class="form-label fw-bold text-dark mb-3">@lang('messages.payment_method')</label>
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="takeaway_card" value="card" checked>
                                                    <label class="payment-card w-100 p-3 text-center" for="takeaway_card">
                                                        <i class="fas fa-credit-card fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">@lang('messages.card_payment')</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="takeaway_cash" value="cash">
                                                    <label class="payment-card w-100 p-3 text-center" for="takeaway_cash">
                                                        <i class="fas fa-money-bill-wave fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">Cash on Pickup</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-brand btn-lg" id="takeaway-submit-btn">
                                                <i class="fas fa-credit-card me-2"></i><span id="takeaway-btn-text">@lang('messages.proceed_to_payment')</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- DELIVERY -->
                        <div class="tab-pane fade" id="delivery" role="tabpanel">
                            <div class="premium-card">
                                <div class="premium-card-header d-flex align-items-center">
                                    <i class="fas fa-truck fs-4 me-3" style="color: var(--primary-orange);"></i>
                                    <h5 class="mb-0 fw-bold">@lang('messages.delivery_details')</h5>
                                </div>
                                <div class="premium-card-body">
                                    <form method="POST" action="{{ route('checkout.delivery') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="address" class="form-label fw-bold text-dark">@lang('messages.delivery_address')</label>
                                            <textarea name="address" rows="3" class="form-control" placeholder="@lang('messages.enter_complete_address')" required></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="postal_code" class="form-label fw-bold text-dark">@lang('messages.postal_code')</label>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="@lang('messages.postal_code_example')" required>
                                            <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i>@lang('messages.delivery_area_note')</small>
                                        </div>

                                        <div class="mb-5">
                                            <label class="form-label fw-bold text-dark mb-3">@lang('messages.payment_method')</label>
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="delivery_card" value="card" checked>
                                                    <label class="payment-card w-100 p-3 text-center" for="delivery_card">
                                                        <i class="fas fa-credit-card fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">@lang('messages.card_payment')</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="btn-check" type="radio" name="payment_method" id="delivery_cash" value="cash">
                                                    <label class="payment-card w-100 p-3 text-center" for="delivery_cash">
                                                        <i class="fas fa-money-bill-wave fs-3 mb-2 d-block"></i>
                                                        <span class="fw-bold">@lang('messages.cash_on_delivery')</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-brand btn-lg" id="delivery-submit-btn">
                                                <i class="fas fa-credit-card me-2"></i><span id="delivery-btn-text">@lang('messages.proceed_to_payment')</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="premium-card position-sticky" style="top: 100px;">
                        <div class="premium-card-header d-flex align-items-center">
                            <i class="fas fa-receipt fs-4 me-3" style="color: var(--primary-orange);"></i>
                            <h5 class="mb-0 fw-bold">@lang('messages.bill_summary')</h5>
                        </div>
                        <div class="premium-card-body">
                            @if (!empty($shopClosed) && $shopClosed)
                                <div class="mb-4 text-center">
                                    <span class="badge bg-warning text-dark py-2 px-3 fs-6 rounded-pill">
                                        <i class="fas fa-clock me-2"></i>@lang('messages.shop_closed_badge')
                                    </span>
                                </div>
                            @endif
                            
                            <div class="summary-row">
                                <span>@lang('messages.subtotal')</span>
                                <span class="fw-bold text-dark" id="subtotal">{{ __('messages.currency') }}{{ number_format($subtotal ?? 0, 2) }}</span>
                            </div>
                            
                            <div class="summary-row d-none" id="delivery-charge-row">
                                <span><i class="fas fa-motorcycle me-2 opacity-50"></i>@lang('messages.delivery_charge')</span>
                                <span class="fw-bold text-dark" id="delivery-charge">{{ __('messages.currency') }}0.00</span>
                            </div>
                            
                            @if($isEligibleForDiscount ?? false)
                                <div class="summary-row" style="color: #28a745;">
                                    <span><i class="fas fa-tag me-2"></i>New User ({{ $discountPercentage }}%)</span>
                                    <span class="fw-bold">−{{ __('messages.currency') }}{{ number_format($discountAmount, 2) }}</span>
                                </div>
                            @endif
                            
                            <div class="summary-total">
                                <span>@lang('messages.total')</span>
                                <span style="color: var(--primary-orange);" id="total">{{ __('messages.currency') }}{{ number_format($finalTotal ?? $total ?? 0, 2) }}</span>
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
    document.addEventListener('DOMContentLoaded', function () {
        const deliveryTab = document.getElementById('delivery-tab');
        const dineinTab = document.getElementById('dinein-tab');
        const takeawayTab = document.getElementById('takeaway-tab');
        
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
        
        const initialTotal = {{ $total ?? 0 }};
        const currencySymbol = '{{ __("messages.currency") }}';
        
        // Delivery charges mapping
        const deliveryCharges = {
            '08880': 3.00,
            '08800': 0.00,
            '08812': 2.00,
            '08870': 4.00
        };

        function updateDeliveryButton() {
            if (deliveryCashRadio && deliveryCashRadio.checked) {
                deliveryBtnText.textContent = '@lang("messages.place_order")';
                deliverySubmitBtn.querySelector('i').className = 'fas fa-check-circle me-2';
            } else {
                deliveryBtnText.textContent = '@lang("messages.proceed_to_payment")';
                deliverySubmitBtn.querySelector('i').className = 'fas fa-credit-card me-2';
            }
        }

        function updateDineinButton() {
            if (dineinCashRadio && dineinCashRadio.checked) {
                dineinBtnText.textContent = '@lang("messages.place_order")';
                dineinSubmitBtn.querySelector('i').className = 'fas fa-check-circle me-2';
            } else {
                dineinBtnText.textContent = '@lang("messages.proceed_to_payment")';
                dineinSubmitBtn.querySelector('i').className = 'fas fa-credit-card me-2';
            }
        }

        function updateTakeawayButton() {
            if (takeawayCashRadio && takeawayCashRadio.checked) {
                takeawayBtnText.textContent = '@lang("messages.place_order")';
                takeawaySubmitBtn.querySelector('i').className = 'fas fa-check-circle me-2';
            } else {
                takeawayBtnText.textContent = '@lang("messages.proceed_to_payment")';
                takeawaySubmitBtn.querySelector('i').className = 'fas fa-credit-card me-2';
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
                const discountSpan = document.querySelector('.text-success span:last-child');
                if (discountSpan) {
                    discountSpan.textContent = `−${currencySymbol}${discountAmount.toFixed(2)}`;
                }
            }

            totalElement.textContent = `${currencySymbol}${finalTotal.toFixed(2)}`;
        }

        if (deliveryCardRadio && deliveryCashRadio) {
            deliveryCardRadio.addEventListener('change', updateDeliveryButton);
            deliveryCashRadio.addEventListener('change', updateDeliveryButton);
        }
        if (dineinCardRadio && dineinCashRadio) {
            dineinCardRadio.addEventListener('change', updateDineinButton);
            dineinCashRadio.addEventListener('change', updateDineinButton);
        }
        if (takeawayCardRadio && takeawayCashRadio) {
            takeawayCardRadio.addEventListener('change', updateTakeawayButton);
            takeawayCashRadio.addEventListener('change', updateTakeawayButton);
        }

        if (deliveryTab) {
            deliveryTab.addEventListener('shown.bs.tab', function () {
                updateSummaryForTab('delivery');
                updateDeliveryButton();
            });
        }
        if (dineinTab) {
            dineinTab.addEventListener('shown.bs.tab', function () {
                updateSummaryForTab('dinein');
                updateDineinButton();
            });
        }
        if (takeawayTab) {
            takeawayTab.addEventListener('shown.bs.tab', function () {
                updateSummaryForTab('takeaway');
                updateTakeawayButton();
            });
        }

        postalCodeInput?.addEventListener('input', function () {
            if (document.querySelector('#delivery-tab').classList.contains('active')) {
                updateSummaryForTab('delivery');
            }
        });
        
        // Init state
        updateDineinButton();
    });
</script>
@endpush
"""

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Checkout page entirely rewritten.")
