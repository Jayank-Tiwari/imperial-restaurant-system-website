

<?php $__env->startSection('title', __('messages.edit_category')); ?>
<?php $__env->startSection('active', 'categories'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo app('translator')->get('messages.edit_category'); ?></h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.categories.update', $category->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label for="name" class="form-label"><?php echo app('translator')->get('messages.category_name'); ?></label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $category->name)); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary"><?php echo app('translator')->get('messages.cancel'); ?></a>
            </form>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>