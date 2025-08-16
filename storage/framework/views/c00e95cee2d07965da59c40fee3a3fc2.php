

<?php $__env->startSection('title', __('messages.user_dashboard') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4"><?php echo app('translator')->get('messages.my_orders'); ?></h2>

        <?php if($orders->count()): ?>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th><?php echo app('translator')->get('messages.order_id'); ?></th>
                            <th><?php echo app('translator')->get('messages.type'); ?></th>
                            <th><?php echo app('translator')->get('messages.total'); ?></th>
                            <th>Discount</th>
                            <th><?php echo app('translator')->get('messages.payment_method'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong>#<?php echo e($order->id); ?></strong></td>
                                <td>
                                </td>
                                <td><strong><?php echo e(__('messages.currency')); ?><?php echo e(number_format($order->total_amount, 2)); ?></strong>
                                </td>
                                <td>
                                    <?php if($order->discount_percentage): ?>
                                        <span class="badge bg-success"><?php echo e($order->discount_percentage); ?>%</span>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- OTP Instructions for Delivery Orders -->
            <?php if($orders->where('delivery_type', 'delivery')->where('delivery.otp', '!=', null)->count() > 0): ?>
                <div class="alert alert-success mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-shield-alt me-2"></i><?php echo app('translator')->get('messages.delivery_otp_instructions'); ?>
                    </h5>
                    <p class="mb-0">
                        <?php echo app('translator')->get('messages.customer_otp_instructions'); ?>
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li><?php echo app('translator')->get('messages.provide_otp_to_delivery_person'); ?></li>
                        <li><?php echo app('translator')->get('messages.verify_order_before_sharing_otp'); ?></li>
                        <li><?php echo app('translator')->get('messages.otp_required_for_delivery_completion'); ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Payment Instructions for Cash Orders -->
            <?php if($orders->where('payment_method', 'cash')->where('payment_status', 'pending')->count() > 0): ?>
                <div class="alert alert-info mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-info-circle me-2"></i><?php echo app('translator')->get('messages.payment_instructions'); ?>
                    </h5>
                    <p class="mb-0">
                        <?php echo app('translator')->get('messages.cash_payment_instructions'); ?>
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li><?php echo app('translator')->get('messages.cod_instruction'); ?></li>
                        <li><?php echo app('translator')->get('messages.dinein_instruction'); ?></li>
                        <li><?php echo app('translator')->get('messages.exact_change_recommended'); ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Order Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($orders->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.total_orders'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($orders->where('order_status', 'delivered')->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.completed_orders'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo e($orders->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count()); ?>

                            </h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.active_orders'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo e(__('messages.currency')); ?><?php echo e(number_format($orders->sum('total_amount'), 2)); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.total_spent'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <h4><?php echo app('translator')->get('messages.no_orders_yet'); ?></h4>
                <p><?php echo app('translator')->get('messages.no_orders_placed_yet'); ?></p>
                <a href="<?php echo e(route('menu')); ?>" class="btn btn-primary">
                    <i class="fas fa-utensils me-2"></i><?php echo app('translator')->get('messages.browse_menu'); ?>
                </a>
            </div>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/user/dashboard.blade.php ENDPATH**/ ?>