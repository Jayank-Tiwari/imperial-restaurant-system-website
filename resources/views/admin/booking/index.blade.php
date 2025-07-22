@extends('admin.sidebar')

@section('title', __('messages.bookings') . ' - ' . __('messages.imperial_spice'))
@section('active', 'booking')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('messages.bookings')</h1>
        </div>

        <!-- Search, Date Filter -->
        <!-- Search and Single Date Filter with Clear Button -->
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
            <form method="GET" action="{{ route('admin.booking') }}" class="d-flex flex-wrap gap-2">
                <input type="text" name="search" class="form-control" placeholder="@lang('messages.search_bookings')"
                    value="{{ request('search') }}">

                <input type="date" name="reservation_date" class="form-control"
                    value="{{ request('reservation_date') }}">

                <button type="submit" class="btn btn-outline-secondary">@lang('messages.apply')</button>

                @if (request()->has('search') ||
                        request()->has('reservation_date') ||
                        request()->has('status') ||
                        request()->has('sort'))
                    <a href="{{ route('admin.booking') }}" class="btn btn-outline-danger">@lang('messages.clear')</a>
                @endif
            </form>
        </div>

        <!-- Filter Buttons -->
        <div class="mb-4">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.booking') }}"
                    class="btn btn-outline-primary {{ !request()->has('status') ? 'active' : '' }}">@lang('messages.all')</a>

                <a href="{{ route('admin.booking', ['status' => 1] + request()->except('page')) }}"
                    class="btn btn-outline-success {{ request('status') == 1 ? 'active' : '' }}">@lang('messages.confirmed')</a>

                <a href="{{ route('admin.booking', ['status' => 0] + request()->except('page')) }}"
                    class="btn btn-outline-warning {{ request('status') === '0' ? 'active' : '' }}">@lang('messages.pending')</a>

                <a href="{{ route('admin.booking', ['status' => 2] + request()->except('page')) }}"
                    class="btn btn-outline-danger {{ request('status') == 2 ? 'active' : '' }}">@lang('messages.cancelled')</a>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('messages.recent_bookings')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'id'])) }}">@lang('messages.id')</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'first_name'])) }}">@lang('messages.customer')</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'phone'])) }}">@lang('messages.phone')</a>
                                </th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'reservation_date'])) }}">@lang('messages.date_time')</a></th>
                                <th><a
                                        href="{{ route('admin.booking', array_merge(request()->all(), ['sort' => 'guests'])) }}">@lang('messages.guests')</a>
                                </th>
                                <th>@lang('messages.status')</th>
                                <th>@lang('messages.occasion')</th>
                                <th>@lang('messages.actions')</th>
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
                                            <span class="badge bg-success">@lang('messages.confirmed')</span>
                                        @elseif ($booking->status == 2)
                                            <span class="badge bg-danger">@lang('messages.cancelled')</span>
                                        @elseif ($booking->status == 0)
                                            <span class="badge bg-warning">@lang('messages.pending')</span>
                                        @else
                                            <span class="badge bg-secondary">@lang('messages.unknown')</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->occasion ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                            class="btn btn-sm btn-outline-warning">@lang('messages.edit')</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">@lang('messages.no_bookings_found')</td>
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
