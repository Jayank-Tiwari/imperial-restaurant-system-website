<style>
    .premium-navbar {
        background-color: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05) !important;
        padding: 0.8rem 0;
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: -0.5px;
        color: #2d3436 !important;
    }

    .navbar-brand i {
        color: #d35400;
        font-size: 1.6rem;
    }

    .nav-link {
        font-weight: 600;
        color: #636e72 !important;
        font-size: 0.95rem;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-link:hover, .nav-link.active {
        color: #d35400 !important;
        background-color: #fff3ec;
    }

    .cart-link {
        position: relative;
    }

    .cart-badge {
        position: absolute;
        top: 0px;
        right: 0px;
        background-color: #d35400 !important;
        color: white;
        font-size: 0.65rem;
        font-weight: 800;
        padding: 4px 6px;
        border: 2px solid white;
        transform: translate(30%, -30%);
    }

    .btn-login-nav {
        background-color: #d35400;
        color: white !important;
        font-weight: 700;
        border-radius: 50px;
        padding: 0.5rem 1.5rem !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(211, 84, 0, 0.2);
    }

    .btn-login-nav:hover {
        background-color: #c0392b !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(211, 84, 0, 0.3);
    }

    .btn-dashboard-nav {
        background-color: transparent;
        color: #d35400 !important;
        border: 2px solid #d35400;
        font-weight: 700;
        border-radius: 50px;
        padding: 0.4rem 1.25rem !important;
        transition: all 0.3s ease;
    }

    .btn-dashboard-nav:hover {
        background-color: #d35400 !important;
        color: white !important;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 0.5rem;
    }

    .dropdown-item {
        font-weight: 600;
        color: #495057;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #fff3ec;
        color: #d35400;
    }
</style>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top premium-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="fas fa-utensils me-2"></i><span>Imperial Spice</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
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
                <li class="nav-item mx-lg-1">
                    <a class="nav-link cart-link @if (View::getSection('active') === 'cart') active @endif"
                        href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-basket fs-5"></i>
                        <span id="cart-count" class="badge rounded-pill cart-badge" data-cart-count>
                            @auth
                                {{ \App\Models\CartItem::where('user_id', auth()->id())->count() ?: 0 }}
                            @else
                                0
                            @endauth
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown mx-lg-1">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe fs-5"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('locale.switch', 'en') }}">
                                <span class="me-2">🇬🇧</span> English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('locale.switch', 'es') }}">
                                <span class="me-2">🇪🇸</span> @lang('messages.spanish')
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    @if (!Auth::check())
                        <a class="nav-link btn-login-nav text-center" href="{{ route('login') }}">
                            <i class="fas fa-user-circle me-1"></i> @lang('messages.login')
                        </a>
                    @else
                        @php
                            $role = Auth::user()->role;
                        @endphp
                        @if ($role === 'admin')
                            <a class="nav-link btn-dashboard-nav text-center" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-columns me-1"></i> @lang('messages.dashboard')
                            </a>
                        @elseif ($role === 'delivery')
                            <a class="nav-link btn-dashboard-nav text-center" href="{{ route('delivery.dashboard') }}">
                                <i class="fas fa-motorcycle me-1"></i> @lang('messages.dashboard')
                            </a>
                        @else
                            <a class="nav-link btn-dashboard-nav text-center" href="{{ route('user.dashboard') }}">
                                <i class="fas fa-user me-1"></i> @lang('messages.dashboard')
                            </a>
                        @endif
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
