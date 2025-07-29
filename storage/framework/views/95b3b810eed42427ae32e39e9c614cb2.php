

<?php $__env->startSection('title', __('messages.view_user') . ' - Imperial Spice'); ?>
<?php $__env->startSection('active', 'user'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2"><?php echo app('translator')->get('messages.view_user'); ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="mb-3"><?php echo e($user->name); ?></h4>
            <ul class="list-group">
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.email'); ?>:</strong> <?php echo e($user->email); ?></li>
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.phone'); ?>:</strong> <?php echo e($user->phone ?? __('messages.not_available')); ?></li>
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.role'); ?>:</strong> <?php echo e(ucfirst($user->role)); ?></li>
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.status'); ?>:</strong> <?php echo e($user->active ? __('messages.active') : __('messages.inactive')); ?></li>
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.joined'); ?>:</strong> <?php echo e($user->created_at->format('Y-m-d')); ?></li>
                <li class="list-group-item"><strong><?php echo app('translator')->get('messages.orders'); ?>:</strong> <?php echo e($user->orders_count); ?></li>
            </ul>
            <div class="mt-3">
                <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-secondary"><?php echo app('translator')->get('messages.back_to_list'); ?></a>
                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-primary"><?php echo app('translator')->get('messages.edit_user'); ?></a>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/user/view.blade.php ENDPATH**/ ?>