<div class="sidebar-brand mb-4 ps-3 pt-3">
    <h4 class="text-white fw-bold">🍽️ Imperial Spice</h4>
</div>
<style>
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.5em;
    }
</style>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'dashboard') active @endif" href="{{ route('user.dashboard') }}">
            <i class="bi bi-house-door me-2"></i>Orders
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'reservations') active @endif"
            href="{{ route('user.reservations') }}">
            <i class="bi bi-box-arrow-in-down"></i>Reservation
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'profile-setting') active @endif" href="{{ route('user.profile-setting') }}">
            <i class="bi bi-person-circle me-2"></i>
            Profile Settings
        </a>
    </li>
    <li class="nav-item mt-4">
        <a class="nav-link" href="home.html">
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
