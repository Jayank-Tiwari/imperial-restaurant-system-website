


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
                            <th><?php echo app('translator')->get('messages.total'); ?></th>
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
                                <td>#<?php echo e($order->id); ?></td>
                                <td><?php echo e(__('messages.currency')); ?><?php echo e(number_format($order->total_amount, 2)); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($order->payment_status === 'paid' ? 'success' : 'danger'); ?>">
                                        <?php echo e(ucfirst($order->payment_status)); ?>

                                    </span>
                                </td>
                                <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $order->order_status))); ?></span></td>
                                <td>
                                    <?php echo e($order->delivery->otp ?? __('messages.not_available')); ?>

                                </td>
                                <td>
                                    <?php echo e(ucfirst($order->delivery->status ?? __('messages.not_assigned'))); ?>

                                </td>
                                <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info"><?php echo app('translator')->get('messages.no_orders_placed_yet'); ?></div>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/user/dashboard.blade.php ENDPATH**/ ?>