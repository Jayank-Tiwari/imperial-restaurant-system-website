@extends('user.sidebar')

@section('title', 'Reservations - Imperial Spice')
@section('active', 'reservations')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4">My Reservations</h2>

        @if ($bookings->count())
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Reservation Date</th>
                            <th>Time</th>
                            <th>Guests</th>
                            <th>Occasion</th>
                            <th>Status</th>
                            <th>Special Requests</th>
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
                                        $statusLabels = ['Pending', 'Confirmed', 'Cancelled'];
                                    @endphp
                                    <span class="badge bg-info">
                                        {{ $statusLabels[$booking->status] ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td>{{ $booking->special_requests ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">You have not made any reservations yet.</div>
        @endif
    </main>


@endsection
