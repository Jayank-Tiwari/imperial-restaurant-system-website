@extends('admin.sidebar')

@section('title', __('messages.user_management') . ' - Imperial Spice')
@section('active', 'user')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('messages.user_management')</h1>
        </div>

        <!-- User Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary">@lang('messages.total_users')</h5>
                        <h2 class="text-primary">{{ $users->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">@lang('messages.active_users')</h5>
                        <h2 class="text-success">{{ $users->where('active', true)->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-warning">@lang('messages.new_this_month')</h5>
                        <h2 class="text-warning">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('messages.all_users')</h6>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>@lang('messages.id')</th>
                                <th>@lang('messages.name')</th>
                                <th>@lang('messages.email')</th>
                                <th>@lang('messages.phone')</th>
                                <th>@lang('messages.join_date')</th>
                                <th>@lang('messages.orders')</th>
                                <th>@lang('messages.status')</th>
                                <th>@lang('messages.role')</th>
                                <th>@lang('messages.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? __('messages.not_available') }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $user->orders_count }}</td>
                                    <td>
                                        @php
                                            $badgeClass = $user->active ? 'bg-success' : 'bg-warning';
                                            $status = $user->active ? __('messages.active') : __('messages.inactive');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                    </td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.view', $user->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1">@lang('messages.view')</a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning">@lang('messages.edit')</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
