@extends('admin.sidebar')

@section('title', 'Edit User - Imperial Spice')
@section('active', 'user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Edit User</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="delivery" {{ $user->role === 'delivery' ? 'selected' : '' }}>Delivery</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="active" class="form-select">
                        <option value="1" {{ $user->active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$user->active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success" type="submit">Update</button>
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>
@endsection
