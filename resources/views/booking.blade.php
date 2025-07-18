@extends('layout.app')

@section('title', 'Table Reservation - Imperial Spice')
@section('active', 'booking')

@section('content')
    <!-- Page Header -->
    <section class="py-5 mt-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold">Table Reservation</h1>
                <p class="lead">Book your table for an unforgettable dining experience</p>
            </div>
        </div>
    </section>

    <!-- Booking Form -->
    <section class="py-5">
        <div class="container">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>Make a Reservation
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    {{-- First Name --}}
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                               id="firstName" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name *</label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                               id="lastName" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Reservation Date *</label>
                                        <input type="date" name="reservation_date"
                                               class="form-control @error('reservation_date') is-invalid @enderror"
                                               id="date" value="{{ old('reservation_date') }}" required>
                                        @error('reservation_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Time --}}
                                    <div class="col-md-6">
                                        <label for="time" class="form-label">Preferred Time *</label>
                                        <select name="reservation_time"
                                                class="form-select @error('reservation_time') is-invalid @enderror"
                                                id="time" required>
                                            <option value="">Select Time</option>
                                            @foreach ([
                                                '17:00' => '5:00 PM', '17:30' => '5:30 PM',
                                                '18:00' => '6:00 PM', '18:30' => '6:30 PM',
                                                '19:00' => '7:00 PM', '19:30' => '7:30 PM',
                                                '20:00' => '8:00 PM', '20:30' => '8:30 PM',
                                                '21:00' => '9:00 PM'
                                            ] as $value => $label)
                                                <option value="{{ $value }}" {{ old('reservation_time') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('reservation_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Guests --}}
                                    <div class="col-md-6">
                                        <label for="guests" class="form-label">Number of Guests *</label>
                                        <select name="guests" class="form-select @error('guests') is-invalid @enderror"
                                                id="guests" required>
                                            <option value="">Select Guests</option>
                                            @for ($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Guest{{ $i > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                            <option value="8+" {{ old('guests') == '8+' ? 'selected' : '' }}>8+ Guests</option>
                                        </select>
                                        @error('guests')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Occasion --}}
                                    <div class="col-md-6">
                                        <label for="occasion" class="form-label">Special Occasion</label>
                                        <select name="occasion" class="form-select @error('occasion') is-invalid @enderror"
                                                id="occasion">
                                            <option value="">Select Occasion</option>
                                            @foreach (['birthday', 'anniversary', 'business', 'date', 'celebration', 'other'] as $occasion)
                                                <option value="{{ $occasion }}" {{ old('occasion') == $occasion ? 'selected' : '' }}>
                                                    {{ ucfirst($occasion) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('occasion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Special Requests --}}
                                    <div class="col-12">
                                        <label for="specialRequests" class="form-label">Special Requests</label>
                                        <textarea name="special_requests"
                                                  class="form-control @error('special_requests') is-invalid @enderror"
                                                  id="specialRequests" rows="3"
                                                  placeholder="Any dietary restrictions, seating preferences, or special requests...">{{ old('special_requests') }}</textarea>
                                        @error('special_requests')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-calendar-check me-2"></i>Book Table
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Reservation Info Sidebar --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>Reservation Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Dining Hours:</strong><br>
                                    <small class="text-muted">
                                        Mon-Thu: 5:00 PM - 10:00 PM<br>
                                        Fri-Sat: 5:00 PM - 11:00 PM<br>
                                        Sun: 5:00 PM - 9:00 PM
                                    </small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Party Size:</strong><br>
                                    <small class="text-muted">For parties of 8+, please call us directly</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Advance Booking:</strong><br>
                                    <small class="text-muted">Reservations can be made up to 30 days in advance</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <strong>Contact:</strong><br>
                                    <small class="text-muted">(555) 123-4567</small>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Why Book --}}
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-star me-2"></i>Why Book With Us?
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Guaranteed seating</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Priority service</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Special occasion arrangements</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Flexible cancellation policy</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
