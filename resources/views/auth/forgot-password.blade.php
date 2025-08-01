<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.forgot_password') - @lang('messages.imperial_spice')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card p-4 p-md-5">
            
            <div class="text-center mb-4">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="fas fa-utensils me-2"></i>@lang('messages.imperial_spice')
                    </h2>
                </a>
                <p class="text-muted mt-2">@lang('messages.forgot_password_intro')</p>
            </div>

            {{-- Session messages for success or error --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ __(session('status')) }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ __($error) }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.verify') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="@lang('messages.enter_your_registered_email')" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">@lang('messages.phone_number')</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="@lang('messages.enter_your_registered_phone')" required>
                    </div>
                    <small class="form-text text-muted">@lang('messages.phone_verification_info')</small>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3 fw-bold">
                    <i class="fas fa-paper-plane me-2"></i>@lang('messages.send_reset_link')
                </button>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0">@lang('messages.remembered_your_password')
                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: var(--secondary-color);">@lang('messages.login')</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>