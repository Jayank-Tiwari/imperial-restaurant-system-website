<ul class="nav flex-column mt-2">
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'dashboard') active @endif" href="{{ route('user.dashboard') }}">
            <i class="fas fa-shopping-bag"></i>@lang('messages.orders')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'reservations') active @endif"
            href="{{ route('user.reservations') }}">
            <i class="fas fa-calendar-alt"></i>@lang('messages.reservations')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (View::getSection('active') === 'profile-setting') active @endif" href="{{ route('user.profile-setting') }}">
            <i class="fas fa-user-cog"></i>@lang('messages.profile_settings')
        </a>
    </li>
    
    <li><hr class="dropdown-divider my-3 mx-3 opacity-25"></li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-arrow-left"></i>@lang('messages.back_to_website')
        </a>
    </li>
    <li class="nav-item mt-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a class="nav-link text-danger" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>@lang('messages.logout')
        </a>
    </li>
</ul>
