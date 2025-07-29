<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Delicious Bites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="auth-card p-4 bg-white rounded shadow" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="fas fa-utensils me-2"></i>Imperial Spice
                    </h2>
                </a>
                <p class="text-muted"><?php echo app('translator')->get('messages.welcome_back'); ?></p>
            </div>

            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('messages.email'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo app('translator')->get('messages.password'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe"><?php echo app('translator')->get('messages.remember_me'); ?></label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i><?php echo app('translator')->get('messages.login'); ?>
                </button>

                <div class="text-center">
                    <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none"><?php echo app('translator')->get('messages.forgot_password'); ?></a>
                </div>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0"><?php echo app('translator')->get('messages.dont_have_account'); ?>
                        <a href="<?php echo e(route('register')); ?>" class="text-primary text-decoration-none fw-bold"><?php echo app('translator')->get('messages.sign_up'); ?></a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>
<?php /**PATH D:\Imperial Spice\website\resources\views/auth/login.blade.php ENDPATH**/ ?>