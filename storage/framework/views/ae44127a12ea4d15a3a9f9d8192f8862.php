


<?php $__env->startSection('title', __('messages.my_reservations') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'reservations'); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4"><?php echo app('translator')->get('messages.my_reservations'); ?></h2>

        <?php if($bookings->count()): ?>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th><?php echo app('translator')->get('messages.reservation_date'); ?></th>
                            <th><?php echo app('translator')->get('messages.time'); ?></th>
                            <th><?php echo app('translator')->get('messages.guests'); ?></th>
                            <th><?php echo app('translator')->get('messages.occasion'); ?></th>
                            <th><?php echo app('translator')->get('messages.status'); ?></th>
                            <th><?php echo app('translator')->get('messages.special_requests'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($booking->reservation_date->format('d M Y')); ?></td>
                                <td><?php echo e($booking->reservation_time); ?></td>
                                <td><?php echo e($booking->guests); ?></td>
                                <td><?php echo e($booking->occasion ?? '-'); ?></td>
                                <td>
                                    <?php
                                        $statusLabels = [
                                            0 => __('messages.pending'),
                                            1 => __('messages.confirmed'),
                                            2 => __('messages.cancelled')
                                        ];
                                    ?>
                                    <span class="badge bg-info">
                                        <?php echo e($statusLabels[$booking->status] ?? __('messages.unknown')); ?>

                                    </span>
                                </td>
                                <td><?php echo e($booking->special_requests ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info"><?php echo app('translator')->get('messages.no_reservations_made_yet'); ?></div>
        <?php endif; ?>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/user/reservations.blade.php ENDPATH**/ ?>