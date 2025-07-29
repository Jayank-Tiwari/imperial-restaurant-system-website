<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <i class="fas fa-utensils me-2"></i>Imperial Spice
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if(View::getSection('active') === 'home'): ?> active <?php endif; ?>"
                        href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('messages.home'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(View::getSection('active') === 'about'): ?> active <?php endif; ?>"
                        href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('messages.about'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(View::getSection('active') === 'menu'): ?> active <?php endif; ?>"
                        href="<?php echo e(route('menu')); ?>"><?php echo app('translator')->get('messages.menu'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(View::getSection('active') === 'booking'): ?> active <?php endif; ?>"
                        href="<?php echo e(route('booking')); ?>"><?php echo app('translator')->get('messages.reservations'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(View::getSection('active') === 'cart'): ?> active <?php endif; ?>"
                        href="<?php echo e(route('cart.index')); ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-primary rounded-pill ms-1">
                            <?php echo e(session('cart_count', 0)); ?>

                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo e(route('locale.switch', 'en')); ?>">English</a>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo e(route('locale.switch', 'es')); ?>"><?php echo app('translator')->get('messages.spanish'); ?></a>
                        </li>
                    </ul>
                </li>
                

                <?php if(!Auth::check()): ?>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('messages.login'); ?></a>
                    </li>
                <?php else: ?>
                    <?php
                        $role = Auth::user()->role;
                    ?>

                    <li class="nav-item">
                        <?php if($role === 'admin'): ?>
                            <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('messages.dashboard'); ?></a>
                        <?php elseif($role === 'delivery'): ?>
                            <a class="nav-link" href="<?php echo e(route('delivery.dashboard')); ?>"><?php echo app('translator')->get('messages.dashboard'); ?></a>
                        <?php else: ?>
                            <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>"><?php echo app('translator')->get('messages.dashboard'); ?></a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
<?php /**PATH D:\Imperial Spice\website\resources\views/layout/header.blade.php ENDPATH**/ ?>