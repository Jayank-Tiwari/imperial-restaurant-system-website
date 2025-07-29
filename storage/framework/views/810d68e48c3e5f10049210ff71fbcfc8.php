

<?php $__env->startSection('title', __('messages.categories') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'category'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo app('translator')->get('messages.categories'); ?></h1>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">+ <?php echo app('translator')->get('messages.add_category'); ?></a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.id'); ?></th>
                        <th><?php echo app('translator')->get('messages.name'); ?></th>
                        <th><?php echo app('translator')->get('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($category->id); ?></td>
                            <td><?php echo e($category->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="btn btn-sm btn-warning me-1"><?php echo app('translator')->get('messages.edit'); ?></a>
                                <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo app('translator')->get('messages.are_you_sure'); ?>')"><?php echo app('translator')->get('messages.delete'); ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3"><?php echo app('translator')->get('messages.no_categories_found'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>