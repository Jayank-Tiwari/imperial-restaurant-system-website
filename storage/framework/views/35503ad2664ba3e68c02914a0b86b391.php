

<?php $__env->startSection('title', __('messages.edit_booking')); ?>
<?php $__env->startSection('active', 'booking'); ?>

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo app('translator')->get('messages.edit_booking'); ?></h1>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?php echo e(route('admin.booking.update', $booking->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="first_name" class="form-label"><?php echo app('translator')->get('messages.first_name'); ?></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo e(old('first_name', $booking->first_name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label"><?php echo app('translator')->get('messages.last_name'); ?></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo e(old('last_name', $booking->last_name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('messages.email_address'); ?></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $booking->email)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><?php echo app('translator')->get('messages.phone'); ?></label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone', $booking->phone)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_date" class="form-label"><?php echo app('translator')->get('messages.reservation_date'); ?></label>
                    <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="<?php echo e(old('reservation_date', $booking->reservation_date)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label"><?php echo app('translator')->get('messages.reservation_time'); ?></label>
                    <input type="time" class="form-control" id="reservation_time" name="reservation_time" value="<?php echo e(old('reservation_time', $booking->reservation_time)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="guests" class="form-label"><?php echo app('translator')->get('messages.guests'); ?></label>
                    <input type="number" class="form-control" id="guests" name="guests" value="<?php echo e(old('guests', $booking->guests)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label"><?php echo app('translator')->get('messages.status'); ?></label>
                    <select class="form-select" id="status" name="status">
                        <option value="1" <?php echo e($booking->status == 1 ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.confirmed'); ?></option>
                        <option value="0" <?php echo e($booking->status == 0 ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.pending'); ?></option>
                        <option value="2" <?php echo e($booking->status == 2 ? 'selected' : ''); ?>><?php echo app('translator')->get('messages.cancelled'); ?></option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="occasion" class="form-label"><?php echo app('translator')->get('messages.occasion'); ?></label>
                    <input type="text" class="form-control" id="occasion" name="occasion" value="<?php echo e(old('occasion', $booking->occasion)); ?>">
                </div>

                <div class="mb-3">
                    <label for="special_requests" class="form-label"><?php echo app('translator')->get('messages.special_requests'); ?></label>
                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3"><?php echo e(old('special_requests', $booking->special_requests)); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update_booking'); ?></button>
                <a href="<?php echo e(route('admin.booking')); ?>" class="btn btn-secondary"><?php echo app('translator')->get('messages.cancel'); ?></a>
            </form>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/booking/edit.blade.php ENDPATH**/ ?>