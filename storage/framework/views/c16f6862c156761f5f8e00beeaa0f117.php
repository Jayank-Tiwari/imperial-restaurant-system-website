<div class="sidebar-brand mb-4 ps-3 pt-3">
    <h4 class="text-white fw-bold">🍽️ <?php echo app('translator')->get('messages.imperial_spice'); ?></h4>
</div>
<style>
    .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.5em;
}

</style>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'dashboard'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="bi bi-house-door me-2"></i> <?php echo app('translator')->get('messages.overview'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'order'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.order.index')); ?>">
            <i class="bi bi-receipt me-2"></i> <?php echo app('translator')->get('messages.orders'); ?>
            <?php if(isset($activeOrdersCount) && $activeOrdersCount > 0): ?>
                <span class="badge bg-danger ms-2"><?php echo e($activeOrdersCount); ?></span>
            <?php endif; ?>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'category'): ?> active <?php endif; ?>"
            href="<?php echo e(route('admin.categories.index')); ?>">
            <i class="bi bi-menu-button-wide me-2"></i> <?php echo app('translator')->get('messages.category_management'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'menu'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.menu-management')); ?>">
            <i class="bi bi-menu-button-wide me-2"></i> <?php echo app('translator')->get('messages.menu_management'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'booking'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.booking')); ?>">
            <i class="bi bi-calendar-check me-2"></i> <?php echo app('translator')->get('messages.bookings'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'user'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.users')); ?>">
            <i class="bi bi-people me-2"></i> <?php echo app('translator')->get('messages.users'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection('active') === 'delivery'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.delivery.staff')); ?>">
            <i class="bi bi-truck me-2"></i> <?php echo app('translator')->get('messages.delivery_staff'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if(View::getSection(name: 'active') === 'profile-setting'): ?> active <?php endif; ?>" href="<?php echo e(route('admin.profile-setting')); ?>">
            <i class="bi bi-person-circle me-2"></i>
            <?php echo app('translator')->get('messages.profile_settings'); ?>
        </a>
    </li>
    <li class="nav-item mt-4">
        <a class="nav-link" href="<?php echo e(route('home')); ?>" target="_blank">
            <i class="bi bi-arrow-left me-2"></i> <?php echo app('translator')->get('messages.back_to_website'); ?>
        </a>
    </li>
    <li class="nav-item">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        <a class="nav-link text-danger" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> <?php echo app('translator')->get('messages.logout'); ?>
        </a>
    </li>
</ul>
<?php /**PATH D:\Imperial Spice\website\resources\views/admin/sidebar-menu.blade.php ENDPATH**/ ?>