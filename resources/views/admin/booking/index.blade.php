@extends('admin.sidebar')

@section('title', 'Bookings - Imperial Spice')
@section('active', 'booking')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Table Bookings</h1>
        </div>

        <!-- Search, Date Filter -->
        <!-- Search and Single Date Filter with Clear Button -->
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
            <form method="GET" action="{{ route('admin.booking') }}" class="d-flex flex-wrap gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search bookings..."
                    value="{{ request('search') }}">

                <input type="date" name="reservation_date" class="form-control"
                    value="{{ request('reservation_date') }}">

                <button type="submit" class="btn btn-outline-secondary">Apply</button>

                @if (request()->has('search') ||
                        request()->has('reservation_date') ||
                        request()->has('status') ||
                        request()->has('sort'))
                    <a href="{{ route('admin.booking') }}" class="btn btn-outline-danger">Clear</a>
                @endif
            </form>
        </div>


        <!-- Filter Buttons -->
        <div class="mb-4">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.booking') }}"
                    class="btn btn-outline-primary {{ !request()->has('status') ? 'active' : '' }}">All</a>

                <a href="{{ route('admin.booking', ['status' => 1] + request()->except('page')) }}"
                    class="btn btn-outline-success {{ request('status') == 1 ? 'active' : '' }}">Confirmed</a>

                <a href="{{ route('admin.booking', ['status' => 0] + request()->except('page')) }}"
                    class="btn btn-outline-warning {{ request('status') === '0' ? 'active' : '' }}">Pending</a>

                <a href="{{ route('admin.booking', ['status' => 2] + request()->except('page')) }}"
                    class="btn btn-outline-danger {{ request('status') == 2 ? 'active' : '' }}">Cancelled</a>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'id'])) }}">ID</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'first_name'])) }}">Customer</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'phone'])) }}">Phone</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'reservation_date'])) }}">Date
                                        & Time</a></th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'guests'])) }}">Guests</a>
                                </th>
                                <th>Status</th>
                                <th>Occasion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->first_name }}
                                        {{ $booking->last_name }}<br><small>{{ $booking->email }}</small></td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>{{ $booking->reservation_date }} {{ $booking->reservation_time }}</td>
                                    <td>{{ $booking->guests }}</td>
                                    <td>
                                        @if ($booking->status == 1)
                                            <span class="badge bg-success">Confirmed</span>
                                        @elseif ($booking->status == 2)
                                            <span class="badge bg-danger">Cancelled</span>
                                        @elseif ($booking->status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->occasion ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                            class="btn btn-sm btn-outline-warning">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $bookings->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
