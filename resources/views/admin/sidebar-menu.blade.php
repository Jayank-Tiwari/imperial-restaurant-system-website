<div class="sidebar-brand mb-4 ps-3 pt-3">
    <h4 class="text-white fw-bold">🍽️ Delicious Bites</h4>
</div>
<style>
    .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.5em;
}

</style>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'dashboard') active @endif" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house-door me-2"></i> Overview
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'order') active @endif" href="{{ route('admin.order.index') }}">
            <i class="bi bi-receipt me-2"></i> Orders
            @if (isset($activeOrdersCount) && $activeOrdersCount > 0)
                <span class="badge bg-danger ms-2">{{ $activeOrdersCount }}</span>
            @endif
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'category') active @endif"
            href="{{ route('admin.categories.index') }}">
            <i class="bi bi-menu-button-wide me-2"></i> Category Management
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'menu') active @endif" href="{{ route('admin.menu-management') }}">
            <i class="bi bi-menu-button-wide me-2"></i> Menu Management
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'booking') active @endif" href="{{ route('admin.booking') }}">
            <i class="bi bi-calendar-check me-2"></i> Bookings
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'user') active @endif" href="{{ route('admin.users') }}">
            <i class="bi bi-people me-2"></i> Users
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'delivery') active @endif" href="{{ route('admin.delivery.staff') }}">
            <i class="bi bi-truck me-2"></i> Delivery Staff
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="analytics.html">
            <i class="bi bi-graph-up me-2"></i> Analytics
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'profile-setting') active @endif" href="{{ route('admin.profile-setting') }}">
            <i class="bi bi-person-circle me-2"></i>
            Profile Settings
        </a>
    </li>
    <li class="nav-item mt-4">
        <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-arrow-left me-2"></i> Back to Website
        </a>
    </li>
    <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a class="nav-link text-danger" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </li>
</ul>
