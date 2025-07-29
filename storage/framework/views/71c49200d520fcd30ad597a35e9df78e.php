

<?php $__env->startSection('title', __('messages.user_management') . ' - Imperial Spice'); ?>
<?php $__env->startSection('active', 'user'); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo app('translator')->get('messages.user_management'); ?></h1>
        </div>

        <!-- User Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo app('translator')->get('messages.total_users'); ?></h5>
                        <h2 class="text-primary"><?php echo e($users->count()); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success"><?php echo app('translator')->get('messages.active_users'); ?></h5>
                        <h2 class="text-success"><?php echo e($users->where('active', true)->count()); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?php echo app('translator')->get('messages.new_this_month'); ?></h5>
                        <h2 class="text-warning"><?php echo e($users->where('created_at', '>=', now()->startOfMonth())->count()); ?>

                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo app('translator')->get('messages.all_users'); ?></h6>
            </div>
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('messages.id'); ?></th>
                                <th><?php echo app('translator')->get('messages.name'); ?></th>
                                <th><?php echo app('translator')->get('messages.email'); ?></th>
                                <th><?php echo app('translator')->get('messages.phone'); ?></th>
                                <th><?php echo app('translator')->get('messages.join_date'); ?></th>
                                <th><?php echo app('translator')->get('messages.orders'); ?></th>
                                <th><?php echo app('translator')->get('messages.status'); ?></th>
                                <th><?php echo app('translator')->get('messages.role'); ?></th>
                                <th><?php echo app('translator')->get('messages.actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->id); ?></td>
                                    <td>
                                        <strong><?php echo e($user->name); ?></strong>
                                    </td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->phone ?? __('messages.not_available')); ?></td>
                                    <td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                                    <td><?php echo e($user->orders_count); ?></td>
                                    <td>
                                        <?php
                                            $badgeClass = $user->active ? 'bg-success' : 'bg-warning';
                                            $status = $user->active ? __('messages.active') : __('messages.inactive');
                                        ?>
                                        <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($status); ?></span>
                                    </td>
                                    <td><?php echo e(ucfirst($user->role)); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.users.view', $user->id)); ?>"
                                            class="btn btn-sm btn-outline-primary me-1"><?php echo app('translator')->get('messages.view'); ?></a>
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                            class="btn btn-sm btn-outline-warning"><?php echo app('translator')->get('messages.edit'); ?></a>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/user/index.blade.php ENDPATH**/ ?>