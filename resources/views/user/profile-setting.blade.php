@extends('user.sidebar')

@section('title', __('messages.profile_settings') . ' - ' . __('messages.imperial_spice'))
@section('active', 'profile-setting')

@section('content')
    @php
        use Illuminate\Support\Str;

        $nameParts = explode(' ', $user->name);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
    @endphp

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@lang('messages.profile_settings')</h1>
                </div>

                <!-- Profile Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-9">
                                        <h3 class="mb-1">{{ $firstName }} {{ $lastName }}</h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="mb-1"><i
                                                        class="bi bi-envelope me-2 text-primary"></i>{{ $user->email }}</p>
                                                <p class="mb-1"><i
                                                        class="bi bi-telephone me-2 text-primary"></i>{{ $user->phone ?? __('messages.not_available') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-1"><i class="bi bi-calendar me-2 text-primary"></i>@lang('messages.joined'):
                                                    {{ $user->created_at->format('M d, Y') }}</p>
                                                <p class="mb-1"><i class="bi bi-shield-check me-2 text-success"></i>@lang('messages.admin_access')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                            data-bs-target="#personal" type="button" role="tab">
                                            <i class="bi bi-person me-2"></i>@lang('messages.personal_info')
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                            data-bs-target="#security" type="button" role="tab">
                                            <i class="bi bi-shield-lock me-2"></i>@lang('messages.security')
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="settingsTabContent">

                                    <!-- Personal Info Tab -->
                                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                        @if (session('profile_success'))
                                            <div class="alert alert-success">{{ session('profile_success') }}</div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        @if (Str::contains($error, ['first name', 'last name', 'email', 'phone']))
                                                            <li>{{ $error }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('user.profile.update') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="form_type" value="personal">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstName" class="form-label">@lang('messages.first_name')</label>
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="first_name" value="{{ old('first_name', $firstName) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastName" class="form-label">@lang('messages.last_name')</label>
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="last_name" value="{{ old('last_name', $lastName) }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">@lang('messages.email_address')</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email', $user->email) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">@lang('messages.phone_number')</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        value="{{ old('phone', $user->phone) }}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check-circle me-2"></i>@lang('messages.save_changes')</button>
                                        </form>
                                    </div>

                                    <!-- Security Tab -->
                                    <div class="tab-pane fade" id="security" role="tabpanel">
                                        @if (session('password_success'))
                                            <div class="alert alert-success">{{ session('password_success') }}</div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        @if (Str::contains($error, 'password'))
                                                            <li>{{ $error }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="bi bi-key me-2"></i>@lang('messages.change_password')
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="POST"
                                                            action="{{ route('user.profile.update') }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="form_type" value="password">
                                                            <div class="mb-3">
                                                                <label for="currentPassword" class="form-label">@lang('messages.current_password')</label>
                                                                <input type="password" class="form-control"
                                                                    id="currentPassword" name="current_password"
                                                                    placeholder="@lang('messages.enter_current_password')">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="newPassword" class="form-label">@lang('messages.new_password')</label>
                                                                <input type="password" class="form-control"
                                                                    id="newPassword" name="new_password"
                                                                    placeholder="@lang('messages.enter_new_password')">
                                                                <div class="form-text">@lang('messages.password_requirements')</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="confirmPassword" class="form-label">@lang('messages.confirm_new_password')</label>
                                                                <input type="password" class="form-control"
                                                                    id="confirmPassword" name="new_password_confirmation"
                                                                    placeholder="@lang('messages.confirm_new_password')">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">@lang('messages.update_password')</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="bi bi-shield me-2"></i>@lang('messages.security_status')
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span>@lang('messages.password_strength')</span>
                                                                <span id="passwordStrengthLabel"
                                                                    class="badge bg-secondary">@lang('messages.type_password')</span>
                                                            </div>
                                                            <div class="progress" style="height: 6px;">
                                                                <div id="passwordStrengthBar"
                                                                    class="progress-bar bg-secondary" style="width: 0%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <small class="text-muted">@lang('messages.last_login'):</small><br>
                                                            <strong>{{ $user->last_login_at ?? __('messages.not_available') }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div> <!-- end security -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        const newPasswordInput = document.getElementById('newPassword');
        const strengthLabel = document.getElementById('passwordStrengthLabel');
        const strengthBar = document.getElementById('passwordStrengthBar');

        newPasswordInput.addEventListener('input', function() {
            const value = newPasswordInput.value;
            if (!value) {
                strengthLabel.textContent = '@lang('messages.type_password')';
                strengthLabel.className = 'badge bg-secondary';
                strengthBar.style.width = '0%';
                strengthBar.className = 'progress-bar bg-secondary';
                return;
            }

            let strength = 0;
            if (value.length >= 6) strength++;
            if (/[a-zA-Z]/.test(value)) strength++;
            if (/\d/.test(value)) strength++;
            if (/[^A-Za-z0-9]/.test(value)) strength++;

            let label = '@lang('messages.weak')';
            let barColor = 'bg-danger';
            let width = '25%';

            if (strength === 2) {
                label = '@lang('messages.medium')';
                barColor = 'bg-warning';
                width = '50%';
            } else if (strength === 3) {
                label = '@lang('messages.good')';
                barColor = 'bg-info';
                width = '75%';
            } else if (strength === 4) {
                label = '@lang('messages.strong')';
                barColor = 'bg-success';
                width = '100%';
            }

            strengthLabel.textContent = label;
            strengthLabel.className = `badge ${barColor}`;
            strengthBar.style.width = width;
            strengthBar.className = `progress-bar ${barColor}`;
        });
    </script>
@endsection
