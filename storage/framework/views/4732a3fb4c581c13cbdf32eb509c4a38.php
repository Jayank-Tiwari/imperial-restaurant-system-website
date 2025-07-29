
<?php $__env->startSection('title', __('messages.assign_delivery')); ?>
<?php $__env->startSection('active', 'delivery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-3">
    <h4 class="mb-3"><?php echo app('translator')->get('messages.assign_orders_to_delivery_staff'); ?></h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.delivery.assign')); ?>" method="POST" class="row gy-2 gx-3 align-items-center">
        <?php echo csrf_field(); ?>
        <div class="col-auto">
            <select name="staff_id" class="form-select" required>
                <option value=""><?php echo app('translator')->get('messages.select_delivery_staff'); ?></option>
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-auto">
            <select name="order_id" class="form-select" required>
                <option value=""><?php echo app('translator')->get('messages.select_order'); ?></option>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($order->id); ?>">#<?php echo e($order->id); ?> - <?php echo app('translator')->get('messages.currency'); ?><?php echo e($order->total_amount); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.assign'); ?></button>
        </div>
    </form>

    <hr class="my-4">

    <h5><?php echo app('translator')->get('messages.delivery_staff_list'); ?></h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.name'); ?></th>
                <th><?php echo app('translator')->get('messages.email'); ?></th>
                <th><?php echo app('translator')->get('messages.assigned_deliveries'); ?></th>
                <th><?php echo app('translator')->get('messages.delivered'); ?></th>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->deliveries()->count()); ?></td>
                    <td><?php echo e($user->deliveries()->where('status', 'delivered')->count()); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.delivery.orders', $user->id)); ?>" class="btn btn-sm btn-outline-primary"><?php echo app('translator')->get('messages.view_orders'); ?></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/delivery/index.blade.php ENDPATH**/ ?>