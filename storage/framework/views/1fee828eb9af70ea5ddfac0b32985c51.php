

<?php $__env->startSection('title', __('messages.delivery_dashboard') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <h2><?php echo app('translator')->get('messages.assigned_orders'); ?></h2>
            <div class="badge bg-primary fs-6">
                <?php echo e($deliveries->count()); ?> <?php echo app('translator')->get('messages.active_deliveries'); ?>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(__(session('success'))); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(__(session('error'))); ?></div>
        <?php endif; ?>

        <?php if($deliveries->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th><?php echo app('translator')->get('messages.order_id'); ?></th>
                            <th><?php echo app('translator')->get('messages.customer_name'); ?></th>
                            <th><?php echo app('translator')->get('messages.delivery_address'); ?></th>
                            <th><?php echo app('translator')->get('messages.total_amount'); ?></th>
                            <th><?php echo app('translator')->get('messages.payment_method'); ?></th>
                            <th><?php echo app('translator')->get('messages.payment_status'); ?></th>
                            <th><?php echo app('translator')->get('messages.assigned_at'); ?></th>
                            <th><?php echo app('translator')->get('messages.status'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong>#<?php echo e($delivery->order_id); ?></strong></td>
                                <td><?php echo e($delivery->order->user->name); ?></td>
                                <td>
                                    <div>
                                        <strong><?php echo e($delivery->order->delivery_address); ?></strong>
                                        <?php if($delivery->order->postal_code): ?>
                                            <br><small class="text-muted"><?php echo app('translator')->get('messages.postal_code'); ?>:
                                                <?php echo e($delivery->order->postal_code); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td><strong><?php echo e(__('messages.currency')); ?><?php echo e(number_format($delivery->order->total_amount, 2)); ?></strong>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-<?php echo e($delivery->order->payment_method == 'card' ? 'primary' : 'warning text-dark'); ?>">
                                        <i
                                            class="fas <?php echo e($delivery->order->payment_method == 'card' ? 'fa-credit-card' : 'fa-money-bill-wave'); ?> me-1"></i>
                                        <?php echo app('translator')->get('messages.payment_method_' . ($delivery->order->payment_method ?? 'unknown')); ?>
                                    </span>
                                    <?php if($delivery->order->payment_method == 'cash'): ?>
                                        <br><small class="text-muted">(<?php echo app('translator')->get('messages.collect_payment'); ?>)</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-<?php echo e($delivery->order->payment_status === 'paid' ? 'success' : ($delivery->order->payment_status === 'failed' ? 'danger' : 'warning text-dark')); ?>">
                                        <?php echo app('translator')->get('messages.payment_status_' . $delivery->order->payment_status); ?>
                                    </span>
                                    <?php if($delivery->order->payment_method == 'cash' && $delivery->order->payment_status == 'pending'): ?>
                                        <br><small class="text-success"><?php echo app('translator')->get('messages.collect_on_delivery'); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($delivery->created_at->format('d M Y, h:i A')); ?></td>
                                <td>
                                    <span
                                        class="badge bg-<?php echo e($delivery->status == 'delivered' ? 'success' : ($delivery->status == 'out_for_delivery' ? 'primary' : 'info')); ?>">
                                        <?php echo app('translator')->get('messages.delivery_status_' . $delivery->status); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('delivery.orders.show', $delivery->order_id)); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i><?php echo app('translator')->get('messages.view_details'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Payment Collection Instructions -->
            <?php if($deliveries->where('order.payment_method', 'cash')->where('order.payment_status', 'pending')->count() > 0): ?>
                <div class="alert alert-warning mt-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-exclamation-triangle me-2"></i><?php echo app('translator')->get('messages.cash_collection_reminder'); ?>
                    </h5>
                    <p class="mb-0">
                        <?php echo app('translator')->get('messages.cash_collection_instructions'); ?>
                    </p>
                    <hr>
                    <ul class="mb-0">
                        <li><?php echo app('translator')->get('messages.verify_otp_before_delivery'); ?></li>
                        <li><?php echo app('translator')->get('messages.collect_exact_amount'); ?></li>
                        <li><?php echo app('translator')->get('messages.mark_payment_received'); ?></li>
                        <li><?php echo app('translator')->get('messages.provide_receipt_if_requested'); ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($deliveries->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.total_assigned'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($deliveries->where('status', 'delivered')->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.delivered_today'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($deliveries->where('status', 'out_for_delivery')->count()); ?></h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.out_for_delivery'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo e(__('messages.currency')); ?><?php echo e(number_format($deliveries->where('order.payment_method', 'cash')->where('order.payment_status', 'pending')->sum('order.total_amount'), 2)); ?>

                            </h5>
                            <p class="card-text"><?php echo app('translator')->get('messages.cash_to_collect'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <h4><?php echo app('translator')->get('messages.no_deliveries_assigned'); ?></h4>
                <p><?php echo app('translator')->get('messages.no_deliveries_assigned_message'); ?></p>
                <i class="fas fa-truck fa-3x text-muted mt-3"></i>
            </div>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('delivery.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/delivery/dashboard.blade.php ENDPATH**/ ?>