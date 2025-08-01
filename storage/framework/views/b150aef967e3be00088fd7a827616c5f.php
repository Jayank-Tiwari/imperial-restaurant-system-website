

<?php $__env->startSection('title', __('messages.checkout_title')); ?>

<?php $__env->startSection('content'); ?>
</head>
<body>
    <div class="container py-5" style="padding-top: 5rem !important;">
        <div class="row">
            <div class="col-lg-8">
                <div class="floating-decoration decoration-1"></div>
                <div class="floating-decoration decoration-2"></div>

                <div class="text-center mb-4">
                    <h2 class="fw-bold"><?php echo app('translator')->get('messages.choose_order_type'); ?></h2>
                    <p class="text-muted"><?php echo app('translator')->get('messages.select_dinein_or_delivery'); ?></p>
                </div>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger text-center"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <ul class="nav nav-tabs nav-fill mb-4" id="checkoutTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold" id="dinein-tab" data-bs-toggle="tab" data-bs-target="#dinein"
                            type="button" role="tab">
                            <i class="fas fa-chair me-1"></i> <?php echo app('translator')->get('messages.dine_in'); ?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery"
                            type="button" role="tab">
                            <i class="fas fa-truck me-1"></i> <?php echo app('translator')->get('messages.delivery'); ?>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="checkoutTabsContent">
                    <div class="tab-pane fade show active" id="dinein" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-success text-white">
                                <i class="fas fa-utensils me-1"></i> <?php echo app('translator')->get('messages.dine_in_details'); ?>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(route('checkout.dinein')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-4">
                                        <label for="table_no" class="form-label fw-semibold"><?php echo app('translator')->get('messages.select_table_number'); ?></label>
                                        <select name="table_no" class="form-select" required>
                                            <option value="" disabled selected><?php echo app('translator')->get('messages.choose_a_table'); ?></option>
                                            <?php for($i = 1; $i <= 20; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo app('translator')->get('messages.table'); ?> <?php echo e($i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Payment Method Selection for Dine-in -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold"><?php echo app('translator')->get('messages.payment_method'); ?></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="dinein_card" value="card" checked>
                                                    <label class="form-check-label" for="dinein_card">
                                                        <i class="fas fa-credit-card me-2"></i><?php echo app('translator')->get('messages.card_payment'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="dinein_cash" value="cash">
                                                    <label class="form-check-label" for="dinein_cash">
                                                        <i class="fas fa-money-bill-wave me-2"></i><?php echo app('translator')->get('messages.cash_payment'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4" id="dinein-submit-btn">
                                            <i class="fas fa-check-circle me-1"></i><span id="dinein-btn-text"><?php echo app('translator')->get('messages.place_dinein_order'); ?></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-map-marker-alt me-1"></i> <?php echo app('translator')->get('messages.delivery_details'); ?>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(route('checkout.delivery')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-4">
                                        <label for="address" class="form-label fw-semibold"><?php echo app('translator')->get('messages.delivery_address'); ?></label>
                                        <textarea name="address" rows="3" class="form-control" placeholder="<?php echo app('translator')->get('messages.enter_complete_address'); ?>" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="postal_code" class="form-label fw-semibold"><?php echo app('translator')->get('messages.postal_code'); ?></label>
                                        <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="<?php echo app('translator')->get('messages.postal_code_example'); ?>"
                                            required>
                                        <small class="text-muted"><?php echo app('translator')->get('messages.delivery_area_note'); ?></small>
                                    </div>

                                    <!-- Payment Method Selection for Delivery -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold"><?php echo app('translator')->get('messages.payment_method'); ?></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="delivery_card" value="card" checked>
                                                    <label class="form-check-label" for="delivery_card">
                                                        <i class="fas fa-credit-card me-2"></i><?php echo app('translator')->get('messages.card_payment'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="delivery_cash" value="cash">
                                                    <label class="form-check-label" for="delivery_cash">
                                                        <i class="fas fa-money-bill-wave me-2"></i><?php echo app('translator')->get('messages.cash_on_delivery'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4" id="delivery-submit-btn">
                                            <i class="fas fa-credit-card me-1"></i><span id="delivery-btn-text"><?php echo app('translator')->get('messages.proceed_to_payment'); ?></span>
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
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i><?php echo app('translator')->get('messages.bill_summary'); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span><?php echo app('translator')->get('messages.subtotal'); ?>:</span>
                            <span id="subtotal"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($subtotal ?? 0, 2)); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?php echo app('translator')->get('messages.tax'); ?>:</span>
                            <span id="tax"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($tax ?? 0, 2)); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 d-none" id="delivery-charge-row">
                            <span><?php echo app('translator')->get('messages.delivery_charge'); ?>:</span>
                            <span id="delivery-charge"><?php echo e(__('messages.currency')); ?>0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold h5">
                            <span><?php echo app('translator')->get('messages.total'); ?>:</span>
                            <span id="total"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($total ?? 0, 2)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deliveryTab = document.getElementById('delivery-tab');
            const dineinTab = document.getElementById('dinein-tab');
            const deliveryChargeRow = document.getElementById('delivery-charge-row');
            const deliveryChargeElement = document.getElementById('delivery-charge');
            const totalElement = document.getElementById('total');
            const postalCodeInput = document.getElementById('postal_code');
            
            // Button elements
            const deliverySubmitBtn = document.getElementById('delivery-submit-btn');
            const deliveryBtnText = document.getElementById('delivery-btn-text');
            const dineinSubmitBtn = document.getElementById('dinein-submit-btn');
            const dineinBtnText = document.getElementById('dinein-btn-text');
            
            // Payment method radio buttons
            const deliveryCardRadio = document.getElementById('delivery_card');
            const deliveryCashRadio = document.getElementById('delivery_cash');
            const dineinCardRadio = document.getElementById('dinein_card');
            const dineinCashRadio = document.getElementById('dinein_cash');
            
            const initialTotal = <?php echo e($total ?? 0); ?>;
            const currencySymbol = '<?php echo e(__("messages.currency")); ?>';
            
            // Delivery charges mapping
            const deliveryCharges = {
                '08880': 0.00,
                '08800': 0.00,
                '08812': 2.00,
                '08870': 4.00
            };

            // Update delivery button text based on payment method
            function updateDeliveryButton() {
                if (deliveryCashRadio && deliveryCashRadio.checked) {
                    deliveryBtnText.textContent = '<?php echo app('translator')->get("messages.place_order"); ?>';
                    deliverySubmitBtn.querySelector('i').className = 'fas fa-check-circle me-1';
                } else {
                    deliveryBtnText.textContent = '<?php echo app('translator')->get("messages.proceed_to_payment"); ?>';
                    deliverySubmitBtn.querySelector('i').className = 'fas fa-credit-card me-1';
                }
            }

            // Update dine-in button text based on payment method
            function updateDineinButton() {
                if (dineinCashRadio && dineinCashRadio.checked) {
                    dineinBtnText.textContent = '<?php echo app('translator')->get("messages.place_order"); ?>';
                    dineinSubmitBtn.querySelector('i').className = 'fas fa-check-circle me-1';
                } else {
                    dineinBtnText.textContent = '<?php echo app('translator')->get("messages.proceed_to_payment"); ?>';
                    dineinSubmitBtn.querySelector('i').className = 'fas fa-credit-card me-1';
                }
            }

            // Event listeners for payment method changes
            if (deliveryCardRadio && deliveryCashRadio) {
                deliveryCardRadio.addEventListener('change', updateDeliveryButton);
                deliveryCashRadio.addEventListener('change', updateDeliveryButton);
            }

            if (dineinCardRadio && dineinCashRadio) {
                dineinCardRadio.addEventListener('change', updateDineinButton);
                dineinCashRadio.addEventListener('change', updateDineinButton);
            }

            deliveryTab.addEventListener('shown.bs.tab', function () {
                deliveryChargeRow.classList.remove('d-none');
                totalElement.textContent = `${currencySymbol}${initialTotal.toFixed(2)}`;
                updateDeliveryButton();
            });

            dineinTab.addEventListener('shown.bs.tab', function () {
                deliveryChargeRow.classList.add('d-none');
                totalElement.textContent = `${currencySymbol}${initialTotal.toFixed(2)}`;
                updateDineinButton();
            });

            // Update delivery fee dynamically based on postal code
            postalCodeInput?.addEventListener('input', function () {
                const postal = this.value.trim();
                let fee = 0;

                if (deliveryCharges[postal] !== undefined) {
                    fee = deliveryCharges[postal];
                    deliveryChargeRow.classList.remove('d-none');
                } else {
                    fee = 0;
                    deliveryChargeRow.classList.add('d-none');
                }

                deliveryChargeElement.textContent = `${currencySymbol}${fee.toFixed(2)}`;
                const newTotal = initialTotal + fee;
                totalElement.textContent = `${currencySymbol}${newTotal.toFixed(2)}`;
            });
            
            // Initialize button states
            updateDeliveryButton();
            updateDineinButton();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/checkout/index.blade.php ENDPATH**/ ?>