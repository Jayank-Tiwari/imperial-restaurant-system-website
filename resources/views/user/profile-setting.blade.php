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

<style>
    :root {
        --primary-orange: #d35400;
        --soft-orange: #fff3ec;
    }
    
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-orange), #e67e22);
        border-radius: 16px;
        color: white;
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(211, 84, 0, 0.2);
    }
    
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        background: #fff;
        border: 1px solid #f8f9fa;
        overflow: hidden;
    }
    
    .custom-card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        color: #495057;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #fff;
        color: var(--primary-orange);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: 4px solid rgba(255, 255, 255, 0.3);
    }
    
    .nav-tabs.custom-tabs {
        border-bottom: 2px solid #e9ecef;
    }
    
    .nav-tabs.custom-tabs .nav-link {
        color: #6c757d;
        font-weight: 600;
        border: none;
        padding: 1rem 1.5rem;
        background: transparent;
        transition: all 0.2s ease;
    }
    
    .nav-tabs.custom-tabs .nav-link:hover {
        color: var(--primary-orange);
        border: none;
    }
    
    .nav-tabs.custom-tabs .nav-link.active {
        color: var(--primary-orange);
        border: none;
        border-bottom: 3px solid var(--primary-orange);
        background: transparent;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        border-color: #e67e22;
        box-shadow: 0 0 0 0.25rem rgba(211, 84, 0, 0.15);
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .btn-primary {
        background-color: var(--primary-orange);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(211, 84, 0, 0.3);
    }
    
    .main-wrapper {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding-bottom: 3rem;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 main-wrapper">
    
    <!-- Header -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-auto d-flex justify-content-center mb-3 mb-md-0">
                <div class="profile-avatar">
                    {{ strtoupper(substr($firstName, 0, 1)) }}{{ strtoupper(substr($lastName, 0, 1)) }}
                </div>
            </div>
            <div class="col-md text-center text-md-start">
                <h2 class="fw-bold mb-1">{{ $firstName }} {{ $lastName }}</h2>
                <p class="mb-0 text-white-50 fs-5"><i class="fas fa-envelope me-2"></i>{{ $user->email }}</p>
                <div class="d-flex align-items-center justify-content-center justify-content-md-start mt-2">
                    <span class="badge bg-white text-dark rounded-pill px-3 py-1 fw-bold me-2 shadow-sm">
                        <i class="fas fa-user-circle me-1 text-primary"></i> Member
                    </span>
                    <span class="text-white-50 small"><i class="fas fa-calendar-alt me-1"></i> Joined {{ $user->created_at->format('M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-card mb-4">
        <div class="card-header bg-white border-0 pt-3 pb-0">
            <ul class="nav nav-tabs custom-tabs" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">
                        <i class="fas fa-user-edit me-2"></i>@lang('messages.personal_info')
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                        <i class="fas fa-shield-alt me-2"></i>@lang('messages.security')
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body p-4">
            <div class="tab-content" id="settingsTabContent">
                
                <!-- Personal Info Tab -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                    @if (session('profile_success'))
                        <div class="alert alert-success rounded-3 shadow-sm border-0"><i class="fas fa-check-circle me-2"></i>{{ session('profile_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 shadow-sm border-0">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    @if (Str::contains($error, ['first name', 'last name', 'email', 'phone']))
                                        <li>{{ $error }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="personal">
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">@lang('messages.first_name')</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="firstName" name="first_name" value="{{ old('first_name', $firstName) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">@lang('messages.last_name')</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="lastName" name="last_name" value="{{ old('last_name', $lastName) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">@lang('messages.email_address')</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-2 border-top">
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    @if (session('password_success'))
                        <div class="alert alert-success rounded-3 shadow-sm border-0"><i class="fas fa-check-circle me-2"></i>{{ session('password_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 shadow-sm border-0">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    @if (Str::contains(strtolower($error), ['password']))
                                        <li>{{ $error }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-key me-2 text-warning"></i> @lang('messages.change_password')</h5>
                            <form method="POST" action="{{ route('admin.profile.update') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="form_type" value="password">
                                
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">@lang('messages.current_password')</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                        <input type="password" class="form-control border-start-0 ps-0" id="currentPassword" name="current_password" placeholder="@lang('messages.enter_current_password')">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">@lang('messages.new_password')</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                                        <input type="password" class="form-control border-start-0 ps-0" id="newPassword" name="new_password" placeholder="@lang('messages.enter_new_password')">
                                    </div>
                                    <div class="form-text text-muted mt-2"><i class="fas fa-info-circle me-1"></i> @lang('messages.password_requirements')</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="confirmPassword" class="form-label">@lang('messages.confirm_new_password')</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-check text-muted"></i></span>
                                        <input type="password" class="form-control border-start-0 ps-0" id="confirmPassword" name="new_password_confirmation" placeholder="@lang('messages.confirm_new_password')">
                                    </div>
                                </div>
                                
                                <div class="pt-2 border-top">
                                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-shield-alt me-2"></i> @lang('messages.update_password')</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="bg-light p-4 rounded-3 border">
                                <h6 class="fw-bold mb-3"><i class="fas fa-shield-check me-2 text-success"></i> @lang('messages.security_status')</h6>
                                
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted small fw-bold">@lang('messages.password_strength')</span>
                                        <span id="passwordStrengthLabel" class="badge bg-secondary">@lang('messages.type_password')</span>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div id="passwordStrengthBar" class="progress-bar bg-secondary" style="width: 0%; border-radius: 4px;"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-muted small mb-1"><i class="fas fa-sign-in-alt me-1"></i> @lang('messages.last_login'):</p>
                                    <span class="fw-bold text-dark">{{ $user->last_login_at ?? __('messages.not_available') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>

<script>
    const newPasswordInput = document.getElementById('newPassword');
    const strengthLabel = document.getElementById('passwordStrengthLabel');
    const strengthBar = document.getElementById('passwordStrengthBar');

    if (newPasswordInput) {
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
                barColor = 'bg-warning text-dark';
                width = '50%';
            } else if (strength === 3) {
                label = '@lang('messages.good')';
                barColor = 'bg-info text-dark';
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
    }
</script>
@endsection
