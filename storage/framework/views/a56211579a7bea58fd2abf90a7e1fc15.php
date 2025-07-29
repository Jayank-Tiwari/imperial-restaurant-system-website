

<?php $__env->startSection('title', __('messages.edit_user') . ' - Imperial Spice'); ?>
<?php $__env->startSection('active', 'user'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2"><?php echo app('translator')->get('messages.edit_user'); ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.users.update', $user->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label class="form-label"><?php echo app('translator')->get('messages.name'); ?></label>
                    <input name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo app('translator')->get('messages.email'); ?></label>
                    <input name="email" type="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo app('translator')->get('messages.phone'); ?></label>
                    <input name="phone" type="text" class="form-control" value="<?php echo e(old('phone', $user->phone)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo app('translator')->get('messages.role'); ?></label>
                    <select name="role" class="form-select">
                        <option value="user" <?php echo e($user->role === 'user' ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.user'); ?>
                        </option>
                        <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.admin'); ?>
                        </option>
                        <option value="delivery" <?php echo e($user->role === 'delivery' ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.delivery'); ?>
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo app('translator')->get('messages.status'); ?></label>
                    <select name="active" class="form-select">
                        <option value="1" <?php echo e($user->active ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.active'); ?></option>
                        <option value="0" <?php echo e(!$user->active ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.inactive'); ?></option>
                    </select>
                </div>

                <button class="btn btn-success" type="submit"><?php echo app('translator')->get('messages.update'); ?></button>
                <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-secondary"><?php echo app('translator')->get('messages.cancel'); ?></a>
            </form>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>