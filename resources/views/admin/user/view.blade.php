@extends('admin.sidebar')

@section('title', 'View User - Imperial Spice')
@section('active', 'user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">View User</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="mb-3">{{ $user->name }}</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $user->active ? 'Active' : 'Inactive' }}</li>
                <li class="list-group-item"><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</li>
                <li class="list-group-item"><strong>Orders:</strong> {{ $user->orders_count }}</li>
            </ul>
            <div class="mt-3">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
            </div>
        </div>
    </div>
</main>
@endsection
