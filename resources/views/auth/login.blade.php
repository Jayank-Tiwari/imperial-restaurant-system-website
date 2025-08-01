<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.login') - @lang('messages.imperial_spice')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="auth-card p-4 bg-white rounded shadow" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="fas fa-utensils me-2"></i>@lang('messages.imperial_spice')
                    </h2>
                </a>
                <p class="text-muted">@lang('messages.welcome_back')</p>
            </div>

            {{-- Error message --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ __($error) }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">@lang('messages.password')</label>
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
                    <label class="form-check-label" for="rememberMe">@lang('messages.remember_me')</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>@lang('messages.login')
                </button>

                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">@lang('messages.forgot_password')</a>
                </div>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0">@lang('messages.dont_have_account')
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">@lang('messages.sign_up')</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}
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
