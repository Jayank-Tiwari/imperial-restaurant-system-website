@extends('layout.app')

@section('title', 'Checkout - Imperial Spice')

@section('content')
</head>
<body>
    <div class="container py-5" style="padding-top: 5rem !important;">
        <div class="row">
            <div class="col-lg-8">
                <div class="floating-decoration decoration-1"></div>
                <div class="floating-decoration decoration-2"></div>

                <div class="text-center mb-4">
                    <h2 class="fw-bold">Choose Your Order Type</h2>
                    <p class="text-muted">Select Dine-In or Delivery and complete your order easily.</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif

                <!-- Enhanced Nav Tabs -->
                <ul class="nav nav-tabs nav-fill mb-4" id="checkoutTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold" id="dinein-tab" data-bs-toggle="tab" data-bs-target="#dinein"
                            type="button" role="tab">
                            <i class="fas fa-chair me-1"></i> Dine-In
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery"
                            type="button" role="tab">
                            <i class="fas fa-truck me-1"></i> Delivery
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="checkoutTabsContent">
                    <!-- Dine-In Form -->
                    <div class="tab-pane fade show active" id="dinein" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-success text-white">
                                <i class="fas fa-utensils me-1"></i> Dine-In Details
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('checkout.dinein') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="table_no" class="form-label fw-semibold">Select Table Number</label>
                                        <select name="table_no" class="form-select" required>
                                            <option value="" disabled selected>Choose a table</option>
                                            @for ($i = 1; $i <= 20; $i++)
                                                <option value="{{ $i }}">Table {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-check-circle me-1"></i>Place Dine-In Order
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Form -->
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-map-marker-alt me-1"></i> Delivery Details
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('checkout.delivery') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="address" class="form-label fw-semibold">Delivery Address</label>
                                        <textarea name="address" rows="3" class="form-control" placeholder="Enter your complete address" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" placeholder="e.g., 08800"
                                            required>
                                        <small class="text-muted">Delivery only available within 4km (08800, 08801, 08802)</small>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-credit-card me-1"></i>Proceed to Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bill Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card position-sticky" style="top: 100px;">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Bill Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (Excl. IVA):</span>
                            <span>€{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>IVA (10%):</span>
                            <span>€{{ number_format($tax ?? 0, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold h5">
                            <span>Total:</span>
                            <span>€{{ number_format($total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation to form elements on focus
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Add tab switch animation
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('checkoutTabsContent').style.opacity = 0;
                setTimeout(() => {
                    document.getElementById('checkoutTabsContent').style.opacity = 1;
                }, 300);
            });
        });
    </script>
@endsection
