@extends('layout.app')

@section('title', 'Table Reservation - Imperial Spice')
@section('active', 'booking')

@section('content')
<style>
    .booking-hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
        padding: 5rem 0 3rem;
        position: relative;
        overflow: hidden;
    }
    .booking-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.3;
    }
    .booking-hero h1 {
        color: #fff;
        font-weight: 800;
        letter-spacing: -1px;
    }
    .booking-hero p {
        color: rgba(255,255,255,0.8);
        font-size: 1.1rem;
    }
    .booking-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        background: #fff;
        overflow: hidden;
        margin-top: -30px;
        position: relative;
        z-index: 10;
    }
    .booking-card-header {
        background: #fff;
        padding: 2rem 2rem 1rem;
        border-bottom: 2px dashed #f1f3f5;
        text-align: center;
    }
    .booking-card-header h4 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0;
    }
    .booking-card-body {
        padding: 2rem;
    }
    .form-floating > .form-control,
    .form-floating > .form-select {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        background-color: #f8f9fa;
    }
    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
        background-color: #fff;
    }
    .info-card {
        border: none;
        border-radius: 16px;
        background: #f8f9fa;
        padding: 1.5rem;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
    }
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255, 107, 53, 0.1);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
    .accent-bg {
        background-color: var(--primary-color);
        color: #fff;
    }
    .accent-bg .info-icon {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }
    .accent-bg h6, .accent-bg p, .accent-bg li {
        color: #fff !important;
    }
    .why-book-list li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        color: #495057;
    }
    .why-book-list li i {
        color: var(--primary-color);
        margin-right: 10px;
        font-size: 1.1rem;
    }
</style>

    <!-- Page Header -->
    <section class="booking-hero">
        <div class="container position-relative">
            <div class="text-center">
                <h1 class="display-4">@lang('messages.table_reservation')</h1>
                <p>@lang('messages.book_your_table_3')</p>
            </div>
        </div>
    </section>

    <!-- Booking Content -->
    <section class="pb-5">
        <div class="container">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3 border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> @lang(session('reservation_success'))
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3 border-0 shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (!empty($shopClosed) && $shopClosed)
                <div class="alert alert-warning text-center mt-3 border-0 shadow-sm">
                    <strong><i class="fas fa-door-closed me-2"></i>@lang('messages.shop_closed_title')</strong>
                    <div class="mt-1">@lang('messages.shop_closed_message')</div>
                </div>
            @endif

            <div class="row g-4 position-relative z-index-1">
                
                <!-- Main Form Column -->
                <div class="col-lg-8">
                    <div class="booking-card">
                        <div class="booking-card-header">
                            <h4><i class="fas fa-calendar-check text-muted me-2 fs-5"></i>@lang('messages.make_a_reservation')</h4>
                        </div>
                        <div class="booking-card-body">
                            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    {{-- First Name --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="firstName" placeholder="@lang('messages.first_name')" value="{{ old('first_name') }}" required>
                                            <label for="firstName">@lang('messages.first_name')</label>
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="lastName" placeholder="@lang('messages.last_name')" value="{{ old('last_name') }}" required>
                                            <label for="lastName">@lang('messages.last_name')</label>
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('messages.email')" value="{{ old('email') }}" required>
                                            <label for="email">@lang('messages.email')</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="@lang('messages.phone_number')" value="{{ old('phone') }}" required>
                                            <label for="phone">@lang('messages.phone_number')</label>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" name="reservation_date" class="form-control @error('reservation_date') is-invalid @enderror" id="date" placeholder="@lang('messages.reservation_date')" value="{{ old('reservation_date') }}" required>
                                            <label for="date">@lang('messages.reservation_date')</label>
                                            @error('reservation_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Time --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="reservation_time" class="form-select @error('reservation_time') is-invalid @enderror" id="time" required>
                                                <option value="" disabled selected></option>
                                                @foreach ([
                                                    '17:00' => '5:00 PM',
                                                    '17:30' => '5:30 PM',
                                                    '18:00' => '6:00 PM',
                                                    '18:30' => '6:30 PM',
                                                    '19:00' => '7:00 PM',
                                                    '19:30' => '7:30 PM',
                                                    '20:00' => '8:00 PM',
                                                    '20:30' => '8:30 PM',
                                                    '21:00' => '9:00 PM',
                                                ] as $value => $label)
                                                    <option value="{{ $value }}" {{ old('reservation_time') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="time">@lang('messages.preferred_time')</label>
                                            @error('reservation_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Guests --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="guests" class="form-select @error('guests') is-invalid @enderror" id="guests" required>
                                                <option value="" disabled selected></option>
                                                @for ($i = 1; $i <= 8; $i++)
                                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                                        {{ $i }} Guest{{ $i > 1 ? 's' : '' }}
                                                    </option>
                                                @endfor
                                                <option value="8+" {{ old('guests') == '8+' ? 'selected' : '' }}>8+ Guests</option>
                                            </select>
                                            <label for="guests">@lang('messages.number_of_guests')</label>
                                            @error('guests')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Occasion --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="occasion" class="form-select @error('occasion') is-invalid @enderror" id="occasion">
                                                <option value="" disabled selected></option>
                                                @php
                                                    $occasionOptions = [
                                                        'birthday' => __('messages.birthday'),
                                                        'anniversary' => __('messages.anniversary'),
                                                        'business' => __('messages.business'),
                                                        'other' => __('messages.other'),
                                                    ];
                                                @endphp
                                                @foreach ($occasionOptions as $occasion => $label)
                                                    <option value="{{ $occasion }}" {{ old('occasion') == $occasion ? 'selected' : '' }}>
                                                        {{ ucfirst($label) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="occasion">@lang('messages.special_occasion') (Optional)</label>
                                            @error('occasion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Special Requests --}}
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="special_requests" class="form-control @error('special_requests') is-invalid @enderror" id="specialRequests" style="height: 120px" placeholder="@lang('messages.your_message')">{{ old('special_requests') }}</textarea>
                                            <label for="specialRequests">@lang('messages.special_requests') (Optional)</label>
                                            @error('special_requests')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="mt-4 pt-2">
                                    <button type="submit" class="btn btn-brand w-100 py-3 rounded-3 fs-5" @if(!empty($shopClosed) && $shopClosed) disabled @endif>
                                        @lang('messages.book_table') <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Column -->
                <div class="col-lg-4 d-flex">
                    <div class="booking-card flex-fill d-flex flex-column">
                        
                        <!-- Rich Header -->
                        <div class="accent-bg text-center text-white py-4 px-3" style="border-radius: 16px 16px 0 0;">
                            <i class="fas fa-utensils fs-1 mb-3 opacity-75"></i>
                            <h4 class="fw-bold mb-0">Imperial Spice</h4>
                            <p class="mb-0 text-white-50 small mt-1">Premium Dining Experience</p>
                        </div>
                        
                        <div class="booking-card-body flex-fill d-flex flex-column gap-4">
                            
                            <!-- Dining Hours -->
                            <div class="d-flex align-items-start">
                                <div class="info-icon bg-light text-primary me-3 flex-shrink-0 rounded-circle" style="width: 45px; height: 45px; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; color: var(--primary-color) !important;">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">@lang('messages.dining_hours')</h6>
                                    <p class="mb-1 text-muted small"><strong class="text-dark">@lang('messages.daily_lunch'):</strong> 12:30 PM - 4:30 PM</p>
                                    <p class="mb-0 text-muted small"><strong class="text-dark">@lang('messages.daily_dinner'):</strong> 6:30 PM - 11:00 PM</p>
                                </div>
                            </div>
                            
                            <hr class="text-muted opacity-25 my-0">

                            <!-- Contact Info -->
                            <div class="d-flex align-items-start">
                                <div class="info-icon bg-light text-primary me-3 flex-shrink-0 rounded-circle" style="width: 45px; height: 45px; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; color: var(--primary-color) !important;">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Need Help?</h6>
                                    <p class="mb-2 text-muted small">@lang('messages.advance_booking_description')</p>
                                    <a href="tel:+34602189306" class="text-dark fw-bold text-decoration-none" style="font-size: 1.1rem; color: var(--primary-color) !important;">
                                        +34 602 18 93 06
                                    </a>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25 my-0">

                            <!-- Why Book -->
                            <div>
                                <h6 class="fw-bold mb-3 text-dark">
                                    <i class="fas fa-star text-warning me-2"></i>@lang('messages.why_book_with_us')
                                </h6>
                                <ul class="list-unstyled why-book-list mb-0 small text-muted">
                                    <li class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i> @lang('messages.guaranteed_seating')
                                    </li>
                                    <li class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i> @lang('messages.priority_service')
                                    </li>
                                    <li class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i> @lang('messages.special_occasion_arrangements')
                                    </li>
                                    <li class="mb-0 d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i> @lang('messages.flexible_cancellation_policy')
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
