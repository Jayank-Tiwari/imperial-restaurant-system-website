<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <i class="fas fa-utensils me-2"></i>Imperial Spice
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'about') active @endif"
                        href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'menu') active @endif"
                        href="{{ route('menu') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'booking') active @endif"
                        href="{{ route('booking') }}">Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (View::getSection('active') === 'cart') active @endif"
                        href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-primary rounded-pill ms-1">
                            {{ session('cart_count', 0) }}
                        </span>
                    </a>
                </li>

                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    @php
                        $role = Auth::user()->role;
                    @endphp

                    <li class="nav-item">
                        @if ($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @elseif ($role === 'delivery')
                            <a class="nav-link" href="{{ route('delivery.dashboard') }}">Dashboard</a>
                        @else
                            <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                        @endif
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
