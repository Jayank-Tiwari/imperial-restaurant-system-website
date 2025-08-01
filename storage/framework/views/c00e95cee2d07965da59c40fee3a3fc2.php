

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
                            <th><?php echo app('translator')->get('messages.payment_method'); ?></th>
                            <th><?php echo app('translator')->get('messages.payment_status'); ?></th>
                            <th><?php echo app('translator')->get('messages.order_status'); ?></th>
                            <th><?php echo app('translator')->get('messages.delivery_otp'); ?></th>
                            <th><?php echo app('translator')->get('messages.delivery_status'); ?></th>
                            <th><?php echo app('translator')->get('messages.placed_at'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong>#<?php echo e($order->id); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($order->delivery_type == 'dinein' ? 'success' : ($order->delivery_type == 'delivery' ? 'warning text-dark' : 'info')); ?>">
                                        <?php echo app('translator')->get('messages.delivery_type_' . $order->delivery_type); ?>
                                    </span>
                                </td>
                                <td><strong><?php echo e(__('messages.currency')); ?><?php echo e(number_format($order->total_amount, 2)); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($order->payment_method == 'card' ? 'primary' : 'warning text-dark'); ?>">
                                        <i class="fas <?php echo e($order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave'); ?> me-1"></i>
                                        <?php echo app('translator')->get('messages.payment_method_' . ($order->payment_method ?? 'unknown')); ?>
                                    </span>
                                    <?php if($order->payment_method == 'cash'): ?>
                                        <br>
                                        <small class="text-muted">
                                            <?php if($order->delivery_type == 'delivery'): ?>
                                                (<?php echo app('translator')->get('messages.cod_short'); ?>)
                                            <?php else: ?>
                                                (<?php echo app('translator')->get('messages.pay_at_restaurant_short'); ?>)
                                            <?php endif; ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($order->payment_status === 'paid' ? 'success' : ($order->payment_status === 'failed' ? 'danger' : 'warning text-dark')); ?>">
                                        <?php echo app('translator')->get('messages.payment_status_' . $order->payment_status); ?>
                                    </span>
                                    <?php if($order->payment_method == 'cash' && $order->payment_status == 'pending'): ?>
                                        <br>
                                        <small class="text-muted">
                                            <?php if($order->delivery_type == 'delivery'): ?>
                                                <?php echo app('translator')->get('messages.pay_on_delivery_note'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('messages.pay_at_restaurant_note'); ?>
                                            <?php endif; ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($order->order_status === 'delivered' ? 'success' : ($order->order_status === 'cancelled' ? 'danger' : 'info')); ?>">
                                        <?php echo app('translator')->get('messages.order_status_' . $order->order_status); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($order->delivery_type == 'delivery'): ?>
                                        <?php if($order->delivery_otp): ?>
                                            <span class="badge bg-secondary"><?php echo e($order->delivery_otp); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted"><?php echo e(__('messages.not_available')); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted"><?php echo app('translator')->get('messages.not_applicable'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($order->delivery_type == 'delivery'): ?>
                                        <?php echo e(ucfirst($order->delivery->status ?? __('messages.not_assigned'))); ?>

                                    <?php else: ?>
                                        <span class="text-muted"><?php echo app('translator')->get('messages.not_applicable'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

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
                            <h5 class="card-title"><?php echo e($orders->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.active_orders'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e(__('messages.currency')); ?><?php echo e(number_format($orders->sum('total_amount'), 2)); ?></h5>
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