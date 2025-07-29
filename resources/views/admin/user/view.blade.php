@extends('admin.sidebar')

@section('title', __('messages.view_user') . ' - Imperial Spice')
@section('active', 'user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">@lang('messages.view_user')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="mb-3">{{ $user->name }}</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>@lang('messages.email'):</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>@lang('messages.phone'):</strong> {{ $user->phone ?? __('messages.not_available') }}</li>
                <li class="list-group-item"><strong>@lang('messages.role'):</strong> {{ ucfirst($user->role) }}</li>
                <li class="list-group-item"><strong>@lang('messages.status'):</strong> {{ $user->active ? __('messages.active') : __('messages.inactive') }}</li>
                <li class="list-group-item"><strong>@lang('messages.joined'):</strong> {{ $user->created_at->format('Y-m-d') }}</li>
                <li class="list-group-item"><strong>@lang('messages.orders'):</strong> {{ $user->orders_count }}</li>
            </ul>
            <div class="mt-3">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">@lang('messages.back_to_list')</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">@lang('messages.edit_user')</a>
            </div>
        </div>
    </div>
</main>
@endsection
