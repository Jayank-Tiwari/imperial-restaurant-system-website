

<?php $__env->startSection('title', __('messages.profile_settings') . ' - ' . __('messages.imperial_spice')); ?>
<?php $__env->startSection('active', 'profile-setting'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        use Illuminate\Support\Str;

        $nameParts = explode(' ', $user->name);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
    ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo app('translator')->get('messages.profile_settings'); ?></h1>
                </div>

                <!-- Profile Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-9">
                                        <h3 class="mb-1"><?php echo e($firstName); ?> <?php echo e($lastName); ?></h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="mb-1"><i
                                                        class="bi bi-envelope me-2 text-primary"></i><?php echo e($user->email); ?></p>
                                                <p class="mb-1"><i
                                                        class="bi bi-telephone me-2 text-primary"></i><?php echo e($user->phone ?? __('messages.not_available')); ?>

                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-1"><i class="bi bi-calendar me-2 text-primary"></i><?php echo app('translator')->get('messages.joined'); ?>:
                                                    <?php echo e($user->created_at->format('M d, Y')); ?></p>
                                                <p class="mb-1"><i class="bi bi-shield-check me-2 text-success"></i><?php echo app('translator')->get('messages.admin_access'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                            data-bs-target="#personal" type="button" role="tab">
                                            <i class="bi bi-person me-2"></i><?php echo app('translator')->get('messages.personal_info'); ?>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                            data-bs-target="#security" type="button" role="tab">
                                            <i class="bi bi-shield-lock me-2"></i><?php echo app('translator')->get('messages.security'); ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="settingsTabContent">

                                    <!-- Personal Info Tab -->
                                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                        <?php if(session('profile_success')): ?>
                                            <div class="alert alert-success"><?php echo e(session('profile_success')); ?></div>
                                        <?php endif; ?>

                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(Str::contains($error, ['first name', 'last name', 'email', 'phone'])): ?>
                                                            <li><?php echo e($error); ?></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="form_type" value="personal">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstName" class="form-label"><?php echo app('translator')->get('messages.first_name'); ?></label>
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="first_name" value="<?php echo e(old('first_name', $firstName)); ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastName" class="form-label"><?php echo app('translator')->get('messages.last_name'); ?></label>
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="last_name" value="<?php echo e(old('last_name', $lastName)); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label"><?php echo app('translator')->get('messages.email_address'); ?></label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="<?php echo e(old('email', $user->email)); ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label"><?php echo app('translator')->get('messages.phone_number'); ?></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        value="<?php echo e(old('phone', $user->phone)); ?>">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check-circle me-2"></i><?php echo app('translator')->get('messages.save_changes'); ?></button>
                                        </form>
                                    </div>

                                    <!-- Security Tab -->
                                    <div class="tab-pane fade" id="security" role="tabpanel">
                                        <?php if(session('password_success')): ?>
                                            <div class="alert alert-success"><?php echo e(session('password_success')); ?></div>
                                        <?php endif; ?>

                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(Str::contains($error, 'password')): ?>
                                                            <li><?php echo e($error); ?></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="bi bi-key me-2"></i><?php echo app('translator')->get('messages.change_password'); ?>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="POST"
                                                            action="<?php echo e(route('admin.profile.update')); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="form_type" value="password">
                                                            <div class="mb-3">
                                                                <label for="currentPassword" class="form-label"><?php echo app('translator')->get('messages.current_password'); ?></label>
                                                                <input type="password" class="form-control"
                                                                    id="currentPassword" name="current_password"
                                                                    placeholder="<?php echo app('translator')->get('messages.enter_current_password'); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="newPassword" class="form-label"><?php echo app('translator')->get('messages.new_password'); ?></label>
                                                                <input type="password" class="form-control"
                                                                    id="newPassword" name="new_password"
                                                                    placeholder="<?php echo app('translator')->get('messages.enter_new_password'); ?>">
                                                                <div class="form-text"><?php echo app('translator')->get('messages.password_requirements'); ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="confirmPassword" class="form-label"><?php echo app('translator')->get('messages.confirm_new_password'); ?></label>
                                                                <input type="password" class="form-control"
                                                                    id="confirmPassword" name="new_password_confirmation"
                                                                    placeholder="<?php echo app('translator')->get('messages.confirm_new_password'); ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update_password'); ?></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="bi bi-shield me-2"></i><?php echo app('translator')->get('messages.security_status'); ?>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span><?php echo app('translator')->get('messages.password_strength'); ?></span>
                                                                <span id="passwordStrengthLabel"
                                                                    class="badge bg-secondary"><?php echo app('translator')->get('messages.type_password'); ?></span>
                                                            </div>
                                                            <div class="progress" style="height: 6px;">
                                                                <div id="passwordStrengthBar"
                                                                    class="progress-bar bg-secondary" style="width: 0%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <small class="text-muted"><?php echo app('translator')->get('messages.last_login'); ?>:</small><br>
                                                            <strong><?php echo e($user->last_login_at ?? __('messages.not_available')); ?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div> <!-- end security -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        const newPasswordInput = document.getElementById('newPassword');
        const strengthLabel = document.getElementById('passwordStrengthLabel');
        const strengthBar = document.getElementById('passwordStrengthBar');

        newPasswordInput.addEventListener('input', function() {
            const value = newPasswordInput.value;
            if (!value) {
                strengthLabel.textContent = '<?php echo app('translator')->get('messages.type_password'); ?>';
                strengthLabel.className = 'badge bg-secondary';
                strengthBar.style.width = '0%';
                strengthBar.className = 'progress-bar bg-secondary';
                return;
            }

            let strength = 0;
            if (value.length >= 6) strength++;
            if (/[a-zA-Z]/.test(value)) strength++;
            if (/\d/.test(value)) strength++;
            if (/[^A-Za-z0-9]/.test(value)) strength++;

            let label = '<?php echo app('translator')->get('messages.weak'); ?>';
            let barColor = 'bg-danger';
            let width = '25%';

            if (strength === 2) {
                label = '<?php echo app('translator')->get('messages.medium'); ?>';
                barColor = 'bg-warning';
                width = '50%';
            } else if (strength === 3) {
                label = '<?php echo app('translator')->get('messages.good'); ?>';
                barColor = 'bg-info';
                width = '75%';
            } else if (strength === 4) {
                label = '<?php echo app('translator')->get('messages.strong'); ?>';
                barColor = 'bg-success';
                width = '100%';
            }

            strengthLabel.textContent = label;
            strengthLabel.className = `badge ${barColor}`;
            strengthBar.style.width = width;
            strengthBar.className = `progress-bar ${barColor}`;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Imperial Spice\website\resources\views/admin/profile-setting.blade.php ENDPATH**/ ?>