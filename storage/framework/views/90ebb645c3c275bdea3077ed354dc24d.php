

<?php $__env->startSection('title', __('messages.order_details') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'dashboard'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2><?php echo app('translator')->get('messages.order_details'); ?> #<?php echo e($delivery->order_id); ?></h2>
        <a href="<?php echo e(route('delivery.dashboard')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i><?php echo app('translator')->get('messages.back_to_dashboard'); ?>
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Order Information -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i><?php echo app('translator')->get('messages.order_information'); ?>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.customer_name'); ?>:</strong> 
                                    <span><?php echo e($delivery->order->user->name); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.customer_phone'); ?>:</strong> 
                                    <span><?php echo e($delivery->order->user->phone ?? __('messages.not_available')); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.total_amount'); ?>:</strong> 
                                    <span class="fw-bold text-success"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($delivery->order->total_amount, 2)); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.payment_method'); ?>:</strong> 
                                    <span class="badge bg-<?php echo e($delivery->order->payment_method == 'card' ? 'primary' : 'warning text-dark'); ?>">
                                        <i class="fas <?php echo e($delivery->order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave'); ?> me-1"></i>
                                        <?php echo app('translator')->get('messages.payment_method_' . $delivery->order->payment_method); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.payment_status'); ?>:</strong> 
                                    <span class="badge bg-<?php echo e($delivery->order->payment_status === 'paid' ? 'success' : ($delivery->order->payment_status === 'failed' ? 'danger' : 'warning text-dark')); ?>">
                                        <?php echo app('translator')->get('messages.payment_status_' . $delivery->order->payment_status); ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.order_status'); ?>:</strong> 
                                    <span class="badge bg-<?php echo e($delivery->order->order_status === 'delivered' ? 'success' : ($delivery->order->order_status === 'cancelled' ? 'danger' : 'info')); ?>">
                                        <?php echo app('translator')->get('messages.order_status_' . $delivery->order->order_status); ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.delivery_status'); ?>:</strong> 
                                    <span class="badge bg-<?php echo e($delivery->status == 'delivered' ? 'success' : ($delivery->status == 'out_for_delivery' ? 'primary' : 'info')); ?>">
                                        <?php echo app('translator')->get('messages.delivery_status_' . $delivery->status); ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><?php echo app('translator')->get('messages.assigned_at'); ?>:</strong> 
                                    <span><?php echo e($delivery->created_at->format('d M Y, h:i A')); ?></span>
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
                        <i class="fas fa-map-marker-alt me-2"></i><?php echo app('translator')->get('messages.delivery_address'); ?>
                    </h5>
                </div>
                <div class="card-body">
                    <address class="mb-0">
                        <strong><?php echo e($delivery->order->delivery_address); ?></strong>
                        <?php if($delivery->order->postal_code): ?>
                            <br><?php echo app('translator')->get('messages.postal_code'); ?>: <?php echo e($delivery->order->postal_code); ?>

                        <?php endif; ?>
                    </address>
                </div>
            </div>

            <!-- Order Items -->
            <?php if($delivery->order->orderItems && $delivery->order->orderItems->count() > 0): ?>
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-utensils me-2"></i><?php echo app('translator')->get('messages.order_items'); ?>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.item'); ?></th>
                                        <th class="text-center"><?php echo app('translator')->get('messages.quantity'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('messages.price'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('messages.total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $delivery->order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->menu_item_name ?? $item->menuItem->name); ?></td>
                                            <td class="text-center"><?php echo e($item->quantity); ?></td>
                                            <td class="text-end"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($item->price, 2)); ?></td>
                                            <td class="text-end"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($item->quantity * $item->price, 2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- OTP Verification Section -->
        <div class="col-md-4">

            <!-- OTP Verification Form -->
            <?php if($delivery->status !== 'delivered'): ?>
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-check-circle me-2"></i><?php echo app('translator')->get('messages.verify_delivery'); ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('delivery.orders.verifyOtp', $delivery->order_id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="otp" class="form-label"><?php echo app('translator')->get('messages.enter_customer_otp'); ?></label>
                                <input type="text" 
                                       name="otp" 
                                       id="otp"
                                       class="form-control form-control-lg text-center <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       maxlength="6" 
                                       placeholder="000000"
                                       required>
                                <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <?php if($delivery->order->payment_method == 'cash' && $delivery->order->payment_status == 'pending'): ?>
                                <div class="alert alert-warning alert-sm">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    <small><?php echo app('translator')->get('messages.collect_cash_before_verification'); ?></small>
                                </div>
                            <?php endif; ?>
                            
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-check me-2"></i><?php echo app('translator')->get('messages.verify_and_complete'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-success"><?php echo app('translator')->get('messages.delivery_completed'); ?></h5>
                        <p class="text-muted"><?php echo app('translator')->get('messages.order_successfully_delivered'); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Instructions -->
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i><?php echo app('translator')->get('messages.instructions'); ?>
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <?php echo app('translator')->get('messages.verify_customer_identity'); ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <?php echo app('translator')->get('messages.confirm_order_items'); ?>
                        </li>
                        <?php if($delivery->order->payment_method == 'cash'): ?>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-warning me-2"></i>
                                <?php echo app('translator')->get('messages.collect_payment_first'); ?>
                            </li>
                        <?php endif; ?>
                        <li class="mb-0">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            <?php echo app('translator')->get('messages.get_otp_from_customer'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('delivery.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/delivery/show.blade.php ENDPATH**/ ?>