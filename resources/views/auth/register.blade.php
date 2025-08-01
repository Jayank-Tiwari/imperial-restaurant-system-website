<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.register') - @lang('messages.imperial_spice')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="auth-card p-4 bg-white rounded shadow" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-4">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="fas fa-utensils me-2"></i>@lang('messages.imperial_spice')
                    </h2>
                </a>
                <p class="text-muted">@lang('messages.create_account_intro')</p>
            </div>

            {{-- Display Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">@lang('messages.full_name')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ old('name') }}" placeholder="@lang('messages.enter_full_name')">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ old('email') }}" placeholder="@lang('messages.enter_email_address')">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">@lang('messages.phone_number')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="number" name="phone" id="phone" class="form-control" required
                            value="{{ old('phone') }}" placeholder="@lang('messages.enter_phone_number')">
                    </div>
                    <small class="form-text text-muted">@lang('messages.phone_format_info')</small>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">@lang('messages.password')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required
                            placeholder="@lang('messages.enter_password')">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small class="form-text text-muted">@lang('messages.password_requirements')</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">@lang('messages.confirm_password')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" required placeholder="@lang('messages.confirm_your_password')">
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="role" id="role" value="user">

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-user-plus me-2"></i>@lang('messages.create_account')
                </button>

                <div class="text-center">
                    <p class="mb-0">@lang('messages.already_have_account')
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">@lang('messages.login')</a>
                    </p>
                </div>
            </form>
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

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
            const passwordConfirm = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            if (passwordConfirm.type === 'password') {
                passwordConfirm.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordConfirm.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>

</html>
