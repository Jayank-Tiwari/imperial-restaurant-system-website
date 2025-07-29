

<?php $__env->startSection('title', __('messages.bookings') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'booking'); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo app('translator')->get('messages.bookings'); ?></h1>
        </div>

        <!-- Search, Date Filter -->
        <!-- Search and Single Date Filter with Clear Button -->
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
            <form method="GET" action="<?php echo e(route('admin.booking')); ?>" class="d-flex flex-wrap gap-2">
                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('messages.search_bookings'); ?>"
                    value="<?php echo e(request('search')); ?>">

                <input type="date" name="reservation_date" class="form-control"
                    value="<?php echo e(request('reservation_date')); ?>">

                <button type="submit" class="btn btn-outline-secondary"><?php echo app('translator')->get('messages.apply'); ?></button>

                <?php if(request()->has('search') ||
                        request()->has('reservation_date') ||
                        request()->has('status') ||
                        request()->has('sort')): ?>
                    <a href="<?php echo e(route('admin.booking')); ?>" class="btn btn-outline-danger"><?php echo app('translator')->get('messages.clear'); ?></a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Filter Buttons -->
        <div class="mb-4">
            <div class="btn-group" role="group">
                <a href="<?php echo e(route('admin.booking')); ?>"
                    class="btn btn-outline-primary <?php echo e(!request()->has('status') ? 'active' : ''); ?>"><?php echo app('translator')->get('messages.all'); ?></a>

                <a href="<?php echo e(route('admin.booking', ['status' => 1] + request()->except('page'))); ?>"
                    class="btn btn-outline-success <?php echo e(request('status') == 1 ? 'active' : ''); ?>"><?php echo app('translator')->get('messages.confirmed'); ?></a>

                <a href="<?php echo e(route('admin.booking', ['status' => 0] + request()->except('page'))); ?>"
                    class="btn btn-outline-warning <?php echo e(request('status') === '0' ? 'active' : ''); ?>"><?php echo app('translator')->get('messages.pending'); ?></a>

                <a href="<?php echo e(route('admin.booking', ['status' => 2] + request()->except('page'))); ?>"
                    class="btn btn-outline-danger <?php echo e(request('status') == 2 ? 'active' : ''); ?>"><?php echo app('translator')->get('messages.cancelled'); ?></a>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo app('translator')->get('messages.recent_bookings'); ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><a
                                        href="<?php echo e(route('admin.booking', array_merge(request()->all(), ['sort' => 'id']))); ?>"><?php echo app('translator')->get('messages.id'); ?></a>
                                </th>
                                <th><a
                                        href="<?php echo e(route('admin.booking', array_merge(request()->all(), ['sort' => 'first_name']))); ?>"><?php echo app('translator')->get('messages.customer'); ?></a>
                                </th>
                                <th><a
                                        href="<?php echo e(route('admin.booking', array_merge(request()->all(), ['sort' => 'phone']))); ?>"><?php echo app('translator')->get('messages.phone'); ?></a>
                                </th>
                                <th><a
                                        href="<?php echo e(route('admin.booking', array_merge(request()->all(), ['sort' => 'reservation_date']))); ?>"><?php echo app('translator')->get('messages.date_time'); ?></a></th>
                                <th><a
                                        href="<?php echo e(route('admin.booking', array_merge(request()->all(), ['sort' => 'guests']))); ?>"><?php echo app('translator')->get('messages.guests'); ?></a>
                                </th>
                                <th><?php echo app('translator')->get('messages.status'); ?></th>
                                <th><?php echo app('translator')->get('messages.occasion'); ?></th>
                                <th><?php echo app('translator')->get('messages.actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>#<?php echo e($booking->id); ?></td>
                                    <td><?php echo e($booking->first_name); ?>

                                        <?php echo e($booking->last_name); ?><br><small><?php echo e($booking->email); ?></small></td>
                                    <td><?php echo e($booking->phone); ?></td>
                                    <td><?php echo e($booking->reservation_date); ?> <?php echo e($booking->reservation_time); ?></td>
                                    <td><?php echo e($booking->guests); ?></td>
                                    <td>
                                        <?php if($booking->status == 1): ?>
                                            <span class="badge bg-success"><?php echo app('translator')->get('messages.confirmed'); ?></span>
                                        <?php elseif($booking->status == 2): ?>
                                            <span class="badge bg-danger"><?php echo app('translator')->get('messages.cancelled'); ?></span>
                                        <?php elseif($booking->status == 0): ?>
                                            <span class="badge bg-warning"><?php echo app('translator')->get('messages.pending'); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo app('translator')->get('messages.unknown'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($booking->occasion ?? '-'); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.booking.edit', $booking->id)); ?>"
                                            class="btn btn-sm btn-outline-warning"><?php echo app('translator')->get('messages.edit'); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center"><?php echo app('translator')->get('messages.no_bookings_found'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        <?php echo e($bookings->withQueryString()->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/booking/index.blade.php ENDPATH**/ ?>