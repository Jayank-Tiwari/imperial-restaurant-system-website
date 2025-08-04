<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-utensils me-2"></i>Imperial Spice
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'home') active @endif"
                        href="{{ route('home') }}">@lang('messages.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'about') active @endif"
                        href="{{ route('about') }}">@lang('messages.about')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'menu') active @endif"
                        href="{{ route('menu') }}">@lang('messages.menu')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'booking') active @endif"
                        href="{{ route('booking') }}">@lang('messages.reservations')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'cart') active @endif"
                        href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count" class="badge bg-primary rounded-pill ms-1" data-cart-count>
                            @auth
                                {{ \App\Models\CartItem::where('user_id', auth()->id())->count() ?: 0 }}
                            @else
                                0
                            @endauth
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('locale.switch', 'es') }}">@lang('messages.spanish')</a>
                        </li>
                    </ul>
                </li>
                

                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('login') }}">@lang('messages.login')</a>
                    </li>
                @else
                    @php
                        $role = Auth::user()->role;
                    @endphp

                    <li class="nav-item">
                        @if ($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a>
                        @elseif ($role === 'delivery')
                            <a class="nav-link" href="{{ route('delivery.dashboard') }}">@lang('messages.dashboard')</a>
                        @else
                            <a class="nav-link" href="{{ route('user.dashboard') }}">@lang('messages.dashboard')</a>
                        @endif
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
