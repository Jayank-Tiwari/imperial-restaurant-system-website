@extends('admin.sidebar')

@section('title', __('messages.edit_booking'))
@section('active', 'booking')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('messages.edit_booking')</h1>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="first_name" class="form-label">@lang('messages.first_name')</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $booking->first_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">@lang('messages.last_name')</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $booking->last_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">@lang('messages.email_address')</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $booking->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">@lang('messages.phone')</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $booking->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_date" class="form-label">@lang('messages.reservation_date')</label>
                    <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="{{ old('reservation_date', $booking->reservation_date) }}" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label">@lang('messages.reservation_time')</label>
                    <input type="time" class="form-control" id="reservation_time" name="reservation_time" value="{{ old('reservation_time', $booking->reservation_time) }}" required>
                </div>

                <div class="mb-3">
                    <label for="guests" class="form-label">@lang('messages.guests')</label>
                    <input type="number" class="form-control" id="guests" name="guests" value="{{ old('guests', $booking->guests) }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">@lang('messages.status')</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1" {{ $booking->status == 1 ? 'selected' : '' }}>@lang('messages.confirmed')</option>
                        <option value="0" {{ $booking->status == 0 ? 'selected' : '' }}>@lang('messages.pending')</option>
                        <option value="2" {{ $booking->status == 2 ? 'selected' : '' }}>@lang('messages.cancelled')</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="occasion" class="form-label">@lang('messages.occasion')</label>
                    <input type="text" class="form-control" id="occasion" name="occasion" value="{{ old('occasion', $booking->occasion) }}">
                </div>

                <div class="mb-3">
                    <label for="special_requests" class="form-label">@lang('messages.special_requests')</label>
                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3">{{ old('special_requests', $booking->special_requests) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">@lang('messages.update_booking')</button>
                <a href="{{ route('admin.booking') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
            </form>
        </div>
    </div>
</main>
@endsection
