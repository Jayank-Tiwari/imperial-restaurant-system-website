

<?php $__env->startSection('title', 'Delivered Orders - Imperial Spice'); ?>
<?php $__env->startSection('active', 'delivered'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
    <h2 class="mb-4">Delivered Orders</h2>

    <?php if($deliveries->count()): ?>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Delivery Address</th>
                        <th>Delivered At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($delivery->order->id); ?></td>
                            <td><?php echo e($delivery->order->user->name ?? 'N/A'); ?></td>
                            <td>₹<?php echo e(number_format($delivery->order->total_amount, 2)); ?></td>
                            <td><?php echo e($delivery->order->delivery_address); ?></td>
                            <td><?php echo e($delivery->updated_at->format('d M Y, h:i A')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No delivered orders found.</div>
    <?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('delivery.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/delivery/delivered_orders.blade.php ENDPATH**/ ?>