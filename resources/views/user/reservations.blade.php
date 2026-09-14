@extends('user.sidebar')

@section('title', __('messages.my_reservations') . ' - ' . __('messages.imperial_spice'))
@section('active', 'reservations')

@section('content')
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
    
    .stat-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        height: 100%;
        border: 1px solid #f8f9fa;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 1.25rem;
    }
    
    .icon-orange { background: var(--soft-orange); color: var(--primary-orange); }
    .icon-green { background: #e8f5e9; color: #2e7d32; }
    .icon-blue { background: #e3f2fd; color: #1565c0; }
    .icon-purple { background: #f3e5f5; color: #7b1fa2; }
    .icon-red { background: #ffebee; color: #c62828; }
    
    .table-container {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #f8f9fa;
    }
    
    .custom-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #e9ecef;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .custom-table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #495057;
    }
    
    .badge-soft-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
    .badge-soft-warning { background: #fff8e1; color: #f57f17; border: 1px solid #ffecb3; }
    .badge-soft-danger { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
    
    .main-wrapper {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding-bottom: 3rem;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 main-wrapper">
    <!-- Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="fw-bold mb-2"><i class="fas fa-calendar-check me-2"></i> @lang('messages.my_reservations')</h2>
            <p class="mb-0 text-white-50 fs-5">Manage and track your dining reservations.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('booking') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-dark shadow-sm transition">
                <i class="fas fa-plus-circle me-2" style="color: var(--primary-orange);"></i> Book a Table
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-orange">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $bookings->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">Total Reservations</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $bookings->where('status', 1)->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">Confirmed</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $bookings->where('status', 0)->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">Pending Approval</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-4">
                <div class="stat-icon icon-red">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $bookings->where('status', 2)->count() }}</h2>
                <p class="text-muted mb-0 fw-semibold">Cancelled</p>
            </div>
        </div>
    </div>

    <!-- Reservations Table -->
    <div class="table-container">
        <h4 class="fw-bold mb-4 px-2">Recent Bookings</h4>
        
        @if ($bookings->count())
            <div class="table-responsive">
                <table class="table custom-table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>@lang('messages.reservation_date')</th>
                            <th>@lang('messages.time')</th>
                            <th>@lang('messages.guests')</th>
                            <th>@lang('messages.occasion')</th>
                            <th>@lang('messages.special_requests')</th>
                            <th>@lang('messages.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded p-2 text-center me-3 border" style="min-width: 55px;">
                                            <div class="text-danger fw-bold" style="font-size: 0.75rem; text-transform: uppercase;">{{ $booking->reservation_date->format('M') }}</div>
                                            <div class="fs-5 fw-bold text-dark lh-1">{{ $booking->reservation_date->format('d') }}</div>
                                        </div>
                                        <div>
                                            <span class="text-muted small">{{ $booking->reservation_date->format('l') }}</span><br>
                                            <span class="fw-bold text-dark">{{ $booking->reservation_date->format('Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><i class="far fa-clock me-1 text-muted"></i> {{ date('h:i A', strtotime($booking->reservation_time)) }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold"><i class="fas fa-users text-muted me-1"></i> {{ $booking->guests }}</span>
                                </td>
                                <td>
                                    @if($booking->occasion)
                                        <span class="badge bg-light text-dark border px-2 py-1"><i class="fas fa-glass-cheers me-1 text-warning"></i> {{ $booking->occasion }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->special_requests)
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $booking->special_requests }}">
                                            <i class="far fa-comment-alt text-muted me-1"></i> {{ $booking->special_requests }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status == 1)
                                        <span class="badge badge-soft-success px-3 py-2 rounded-pill fw-semibold shadow-sm">
                                            <i class="fas fa-check-circle me-1"></i> @lang('messages.confirmed')
                                        </span>
                                    @elseif($booking->status == 2)
                                        <span class="badge badge-soft-danger px-3 py-2 rounded-pill fw-semibold shadow-sm">
                                            <i class="fas fa-times-circle me-1"></i> @lang('messages.cancelled')
                                        </span>
                                    @else
                                        <span class="badge badge-soft-warning px-3 py-2 rounded-pill fw-semibold shadow-sm">
                                            <i class="fas fa-hourglass-half me-1"></i> @lang('messages.pending')
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 my-4">
                <div class="mb-3">
                    <i class="fas fa-calendar-times fa-4x text-muted opacity-25"></i>
                </div>
                <h4 class="text-dark fw-bold mb-2">@lang('messages.no_reservations_made_yet')</h4>
                <p class="text-muted mb-4 fs-5">You haven't booked any tables with us yet.</p>
                <a href="{{ route('booking') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm" style="background: var(--primary-orange); border: none;">
                    <i class="fas fa-calendar-plus me-2"></i> Book a Table
                </a>
            </div>
        @endif
    </div>
</main>
@endsection
