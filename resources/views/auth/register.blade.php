<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Imperial Spice</title>
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
                        <i class="fas fa-utensils me-2"></i>Imperial Spice
                    </h2>
                </a>
                <p class="text-muted">Create your account to get started!</p>
            </div>

            {{-- Display Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ old('name') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="number" name="phone" id="phone" class="form-control" required
                            value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" required>
                    </div>
                </div>

                <input type="hidden" name="role" id="role" value="user">

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>

                <div class="text-center">
                    <p class="mb-0">Already have an account?
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
