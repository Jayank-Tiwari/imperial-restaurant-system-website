
@extends('user.sidebar')

@section('title', __('messages.my_reservations') . ' - ' . __('messages.imperial_spice'))
@section('active', 'reservations')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4">@lang('messages.my_reservations')</h2>

        @if ($bookings->count())
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>@lang('messages.reservation_date')</th>
                            <th>@lang('messages.time')</th>
                            <th>@lang('messages.guests')</th>
                            <th>@lang('messages.occasion')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.special_requests')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->reservation_date->format('d M Y') }}</td>
                                <td>{{ $booking->reservation_time }}</td>
                                <td>{{ $booking->guests }}</td>
                                <td>{{ $booking->occasion ?? '-' }}</td>
                                <td>
                                    @php
                                        $statusLabels = [
                                            0 => __('messages.pending'),
                                            1 => __('messages.confirmed'),
                                            2 => __('messages.cancelled')
                                        ];
                                    @endphp
                                    <span class="badge bg-info">
                                        {{ $statusLabels[$booking->status] ?? __('messages.unknown') }}
                                    </span>
                                </td>
                                <td>{{ $booking->special_requests ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">@lang('messages.no_reservations_made_yet')</div>
        @endif
    </main>

@endsection
