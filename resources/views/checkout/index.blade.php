@extends('layout.app')

@section('title', __('messages.checkout_title'))

@section('content')
</head>
<body>
    <div class="container py-5" style="padding-top: 5rem !important;">
        <div class="row">
            <div class="col-lg-8">
                <div class="floating-decoration decoration-1"></div>
                <div class="floating-decoration decoration-2"></div>

                <div class="text-center mb-4">
                    <h2 class="fw-bold">@lang('messages.choose_order_type')</h2>
                    <p class="text-muted">@lang('messages.select_dinein_or_delivery')</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif

                <ul class="nav nav-tabs nav-fill mb-4" id="checkoutTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold" id="dinein-tab" data-bs-toggle="tab" data-bs-target="#dinein"
                            type="button" role="tab">
                            <i class="fas fa-chair me-1"></i> @lang('messages.dine_in')
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery"
                            type="button" role="tab">
                            <i class="fas fa-truck me-1"></i> @lang('messages.delivery')
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="checkoutTabsContent">
                    <div class="tab-pane fade show active" id="dinein" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-success text-white">
                                <i class="fas fa-utensils me-1"></i> @lang('messages.dine_in_details')
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('checkout.dinein') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="table_no" class="form-label fw-semibold">@lang('messages.select_table_number')</label>
                                        <select name="table_no" class="form-select" required>
                                            <option value="" disabled selected>@lang('messages.choose_a_table')</option>
                                            @for ($i = 1; $i <= 20; $i++)
                                                <option value="{{ $i }}">@lang('messages.table') {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-check-circle me-1"></i>@lang('messages.place_dinein_order')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-map-marker-alt me-1"></i> @lang('messages.delivery_details')
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('checkout.delivery') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="address" class="form-label fw-semibold">@lang('messages.delivery_address')</label>
                                        <textarea name="address" rows="3" class="form-control" placeholder="@lang('messages.enter_complete_address')" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="postal_code" class="form-label fw-semibold">@lang('messages.postal_code')</label>
                                        <input type="text" name="postal_code" class="form-control" placeholder="@lang('messages.postal_code_example')"
                                            required>
                                        <small class="text-muted">@lang('messages.delivery_area_note')</small>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-credit-card me-1"></i>@lang('messages.proceed_to_payment')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card position-sticky" style="top: 100px;">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>@lang('messages.bill_summary')</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>@lang('messages.subtotal'):</span>
                            <span id="subtotal">€{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>@lang('messages.tax'):</span>
                            <span id="tax">€{{ number_format($tax ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 d-none" id="delivery-charge-row">
                            <span>@lang('messages.delivery_charge'):</span>
                            <span id="delivery-charge">€{{ number_format($deliveryFee ?? 0, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold h5">
                            <span>@lang('messages.total'):</span>
                            <span id="total">€{{ number_format($total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deliveryTab = document.getElementById('delivery-tab');
            const dineinTab = document.getElementById('dinein-tab');

            const deliveryChargeRow = document.getElementById('delivery-charge-row');
            const totalElement = document.getElementById('total');

            const initialTotal = {{ $total ?? 0 }};
            const deliveryCharge = {{ $deliveryFee ?? 0 }};

            deliveryTab.addEventListener('shown.bs.tab', function () {
                deliveryChargeRow.classList.remove('d-none');
                const newTotal = initialTotal + deliveryCharge;
                totalElement.textContent = `€${newTotal.toFixed(2)}`;
            });

            dineinTab.addEventListener('shown.bs.tab', function () {
                deliveryChargeRow.classList.add('d-none');
                totalElement.textContent = `€${initialTotal.toFixed(2)}`;
            });
        });

        // Add animation to form elements on focus
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('focused');
            });
        });

        // Add tab switch animation
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('checkoutTabsContent').style.opacity = 0;
                setTimeout(() => {
                    document.getElementById('checkoutTabsContent').style.opacity = 1;
                }, 300);
            });
        });
    </script>
@endsection