@extends('admin.sidebar')

@section('title', 'Menu Items - Imperial Spice')
@section('active', 'menu')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menu Items</h1>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">+ Add New Item</a>
    </div>

    <!-- Search -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('admin.menu-management') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search dishes..."
                       value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-outline-primary me-2">Search</button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.menu-management') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Menu Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price (₹)</th>
                            <th>Availability</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menuItems as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Menu Image"
                                             style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>{{ $item->category?->name ?? '-' }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>
                                    @if ($item->availability)
                                        <span class="badge bg-success">Available</span>
                                    @else
                                        <span class="badge bg-secondary">Unavailable</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.menu.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-warning mb-1">Edit</a>
                                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No menu items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $menuItems->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
