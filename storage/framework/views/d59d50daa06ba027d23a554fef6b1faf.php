<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo app('translator')->get('messages.forgot_password'); ?> - <?php echo app('translator')->get('messages.imperial_spice'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card p-4 p-md-5">
            
            <div class="text-center mb-4">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="fas fa-utensils me-2"></i><?php echo app('translator')->get('messages.imperial_spice'); ?>
                    </h2>
                </a>
                <p class="text-muted mt-2"><?php echo app('translator')->get('messages.forgot_password_intro'); ?></p>
            </div>

            
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(__(session('status'))); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e(__($error)); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.verify')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('messages.email'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('messages.enter_your_registered_email'); ?>" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label"><?php echo app('translator')->get('messages.phone_number'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="<?php echo app('translator')->get('messages.enter_your_registered_phone'); ?>" required>
                    </div>
                    <small class="form-text text-muted"><?php echo app('translator')->get('messages.phone_verification_info'); ?></small>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3 fw-bold">
                    <i class="fas fa-paper-plane me-2"></i><?php echo app('translator')->get('messages.send_reset_link'); ?>
                </button>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0"><?php echo app('translator')->get('messages.remembered_your_password'); ?>
                        <a href="<?php echo e(route('login')); ?>" class="fw-bold text-decoration-none" style="color: var(--secondary-color);"><?php echo app('translator')->get('messages.login'); ?></a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\Imperial Spice\website\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>