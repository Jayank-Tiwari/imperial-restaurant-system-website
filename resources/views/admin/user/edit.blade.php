@extends('admin.sidebar')

@section('title', __('messages.edit_user') . ' - Imperial Spice')
@section('active', 'user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">@lang('messages.edit_user')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">@lang('messages.name')</label>
                    <input name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('messages.email')</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('messages.phone')</label>
                    <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('messages.role')</label>
                    <select name="role" class="form-select">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>@lang('messages.user')
                        </option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>@lang('messages.admin')
                        </option>
                        <option value="delivery" {{ $user->role === 'delivery' ? 'selected' : '' }}>@lang('messages.delivery')
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('messages.status')</label>
                    <select name="active" class="form-select">
                        <option value="1" {{ $user->active ? 'selected' : '' }}>@lang('messages.active')</option>
                        <option value="0" {{ !$user->active ? 'selected' : '' }}>@lang('messages.inactive')</option>
                    </select>
                </div>

                <button class="btn btn-success" type="submit">@lang('messages.update')</button>
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
            </form>
        </div>
    </div>
</main>
@endsection
