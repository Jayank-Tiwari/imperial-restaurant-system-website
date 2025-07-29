

<?php $__env->startSection('title', 'Table Reservation - Imperial Spice'); ?>
<?php $__env->startSection('active', 'booking'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="py-5 mt-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold"><?php echo app('translator')->get('messages.table_reservation'); ?></h1>
                <p class="lead"><?php echo app('translator')->get('messages.book_your_table_3'); ?></p>
            </div>
        </div>
    </section>

    <!-- Booking Form -->
    <section class="py-5">
        <div class="container">
            
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo app('translator')->get(session('reservation_success')); ?></div>
            <?php endif; ?>

            
            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo app('translator')->get(session('reservation_error')); ?></div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i><?php echo app('translator')->get('messages.make_a_reservation'); ?>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form id="bookingForm" action="<?php echo e(route('booking.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row g-3">
                                    
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label"><?php echo app('translator')->get('messages.first_name'); ?></label>
                                        <input type="text" name="first_name"
                                            class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="firstName"
                                            value="<?php echo e(old('first_name')); ?>" required>
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label"><?php echo app('translator')->get('messages.last_name'); ?></label>
                                        <input type="text" name="last_name"
                                            class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="lastName"
                                            value="<?php echo e(old('last_name')); ?>" required>
                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label"><?php echo app('translator')->get('messages.email'); ?></label>
                                        <input type="email" name="email"
                                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email"
                                            value="<?php echo e(old('email')); ?>" required>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label"><?php echo app('translator')->get('messages.phone_number'); ?></label>
                                        <input type="tel" name="phone"
                                            class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone"
                                            value="<?php echo e(old('phone')); ?>" required>
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="date" class="form-label"><?php echo app('translator')->get('messages.reservation_date'); ?></label>
                                        <input type="date" name="reservation_date"
                                            class="form-control <?php $__errorArgs = ['reservation_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="date" value="<?php echo e(old('reservation_date')); ?>" required>
                                        <?php $__errorArgs = ['reservation_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="time" class="form-label"><?php echo app('translator')->get('messages.preferred_time'); ?></label>
                                        <select name="reservation_time"
                                            class="form-select <?php $__errorArgs = ['reservation_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="time" required>
                                            <option value=""><?php echo app('translator')->get('messages.select_time'); ?></option>
                                            <?php $__currentLoopData = [
            '17:00' => '5:00 PM',
            '17:30' => '5:30 PM',
            '18:00' => '6:00 PM',
            '18:30' => '6:30 PM',
            '19:00' => '7:00 PM',
            '19:30' => '7:30 PM',
            '20:00' => '8:00 PM',
            '20:30' => '8:30 PM',
            '21:00' => '9:00 PM',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>"
                                                    <?php echo e(old('reservation_time') == $value ? 'selected' : ''); ?>>
                                                    <?php echo e($label); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['reservation_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="guests" class="form-label"><?php echo app('translator')->get('messages.number_of_guests'); ?></label>
                                        <select name="guests" class="form-select <?php $__errorArgs = ['guests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="guests" required>
                                            <option value=""><?php echo app('translator')->get('messages.select_guests'); ?></option>
                                            <?php for($i = 1; $i <= 8; $i++): ?>
                                                <option value="<?php echo e($i); ?>"
                                                    <?php echo e(old('guests') == $i ? 'selected' : ''); ?>>
                                                    <?php echo e($i); ?> Guest<?php echo e($i > 1 ? 's' : ''); ?>

                                                </option>
                                            <?php endfor; ?>
                                            <option value="8+" <?php echo e(old('guests') == '8+' ? 'selected' : ''); ?>>8+ Guests
                                            </option>
                                        </select>
                                        <?php $__errorArgs = ['guests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="occasion" class="form-label"><?php echo app('translator')->get('messages.special_occasion'); ?></label>
                                        <select name="occasion" class="form-select <?php $__errorArgs = ['occasion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="occasion">
                                            <option value=""><?php echo app('translator')->get('messages.select_occasion'); ?></option>
                                            <?php
                                                $occasionOptions = [
                                                    'birthday' => __('messages.birthday'),
                                                    'anniversary' => __('messages.anniversary'),
                                                    'business' => __('messages.business'),
                                                    'other' => __('messages.other'),
                                                ];
                                            ?>
                                            <?php $__currentLoopData = $occasionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($occasion); ?>"
                                                    <?php echo e(old('occasion') == $occasion ? 'selected' : ''); ?>>
                                                    <?php echo e(ucfirst($label)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['occasion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12">
                                        <label for="specialRequests" class="form-label"><?php echo app('translator')->get('messages.special_requests'); ?></label>
                                        <textarea name="special_requests" class="form-control <?php $__errorArgs = ['special_requests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="specialRequests" rows="3" placeholder="<?php echo app('translator')->get('messages.your_message'); ?>"><?php echo e(old('special_requests')); ?></textarea>
                                        <?php $__errorArgs = ['special_requests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-calendar-check me-2"></i><?php echo app('translator')->get('messages.book_table'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i><?php echo app('translator')->get('messages.reservation_information'); ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong><?php echo app('translator')->get('messages.dining_hours'); ?></strong><br>
                                    <small class="text-muted">
                                        <?php echo app('translator')->get('messages.daily_lunch'); ?>: 12:30 PM - 4:30 PM<br>
                                        <?php echo app('translator')->get('messages.daily_dinner'); ?>: 6:30 PM - 11:00 PM
                                    </small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong><?php echo app('translator')->get('messages.party_size'); ?></strong><br>
                                    <small class="text-muted"><?php echo app('translator')->get('messages.party_size_description'); ?></small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong><?php echo app('translator')->get('messages.advance_booking'); ?></strong><br>
                                    <small class="text-muted"><?php echo app('translator')->get('messages.advance_booking_description'); ?></small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <strong><?php echo app('translator')->get('messages.contact'); ?></strong><br>
                                    <small class="text-muted">+34 602 18 93 06</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-star me-2"></i><?php echo app('translator')->get('messages.why_book_with_us'); ?>
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo app('translator')->get('messages.guaranteed_seating'); ?></li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo app('translator')->get('messages.priority_service'); ?></li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo app('translator')->get('messages.special_occasion_arrangements'); ?></li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo app('translator')->get('messages.flexible_cancellation_policy'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/booking.blade.php ENDPATH**/ ?>