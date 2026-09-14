<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.sign_up') - @lang('messages.imperial_spice')</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .auth-split {
            display: flex;
            min-height: 100vh;
        }
        .auth-image {
            flex: 1;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url("{{ asset('assets/img/chef.jpg') }}") center/cover no-repeat;
            display: none;
            position: relative;
        }
        @media (min-width: 992px) {
            .auth-image {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                color: white;
                text-align: center;
                padding: 4rem;
            }
        }
        .auth-image h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .auth-image p {
            font-size: 1.2rem;
            font-weight: 300;
            opacity: 0.9;
            max-width: 500px;
        }
        .auth-form-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            max-width: 100%;
        }
        @media (min-width: 992px) {
            .auth-form-wrapper {
                max-width: 600px;
                background: white;
            }
        }
        .auth-form-container {
            width: 100%;
            max-width: 480px;
        }
        
        .brand-logo {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            font-weight: 800;
            font-size: 2rem;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        
        .form-floating > .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            height: calc(3.5rem + 2px);
            padding-left: 3rem; /* Space for icon */
        }
        .form-floating > .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
        }
        .form-floating > label {
            padding-left: 3rem;
            color: #8795a1;
        }
        .input-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #a0aec0;
            z-index: 10;
        }
        .form-control:focus + .input-icon,
        .form-control:not(:placeholder-shown) + .input-icon {
            color: var(--primary-color);
        }
        
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #a0aec0;
            z-index: 10;
            cursor: pointer;
            padding: 0;
        }
        .toggle-password:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="auth-split">
        
        <!-- Left Image Section -->
        <div class="auth-image shadow-lg">
            <h1 class="mb-3">Imperial Spice</h1>
            <p>Join us today and discover our carefully crafted dishes made with the finest ingredients.</p>
        </div>

        <!-- Right Form Section -->
        <div class="auth-form-wrapper">
            <div class="auth-form-container">
                
                <div class="text-center text-lg-start mb-4">
                    <a href="{{ route('home') }}" class="brand-logo d-lg-none">
                        <i class="fas fa-utensils me-2"></i>Imperial Spice
                    </a>
                    <h2 class="fw-bold mb-2">Create Account</h2>
                    <p class="text-muted">Fill in your details below to get started</p>
                </div>

                {{-- Error message --}}
                @if($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ __($error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6 position-relative">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control shadow-sm" id="name" placeholder="John" value="{{ old('name') }}" required autofocus>
                                <label for="name">@lang('messages.first_name')</label>
                            </div>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        <div class="col-sm-6 position-relative">
                            <div class="form-floating">
                                <input type="text" name="last_name" class="form-control shadow-sm" id="lastName" placeholder="Doe" value="{{ old('last_name') }}" required>
                                <label for="lastName">@lang('messages.last_name')</label>
                            </div>
                            <i class="far fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control shadow-sm" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                            <label for="email">@lang('messages.email')</label>
                        </div>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>

                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <input type="tel" name="phone" class="form-control shadow-sm" id="phone" placeholder="+123456789" value="{{ old('phone') }}">
                            <label for="phone">@lang('messages.phone_number')</label>
                        </div>
                        <i class="fas fa-phone-alt input-icon"></i>
                    </div>

                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control shadow-sm" id="password" placeholder="Password" required>
                            <label for="password">@lang('messages.password')</label>
                        </div>
                        <i class="fas fa-lock input-icon"></i>
                        <button class="toggle-password" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="position-relative mb-4">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control shadow-sm" id="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password_confirmation">Confirm Password</label>
                        </div>
                        <i class="fas fa-lock input-icon"></i>
                    </div>

                    <button type="submit" class="btn btn-brand py-3 rounded-3 fs-5 shadow">
                        @lang('messages.sign_up') <i class="fas fa-user-plus ms-2"></i>
                    </button>
                </form>

                <div class="text-center mt-4 pt-3 border-top">
                    <p class="mb-0 text-muted">@lang('messages.already_have_account') 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold ms-1" style="color: var(--primary-color);">@lang('messages.login')</a>
                    </p>
                </div>
                
            </div>
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
