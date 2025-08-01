@extends('admin.sidebar')

@section('title', 'Edit Menu Item')
@section('active', 'menu')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Edit Menu Item</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Dish Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $menuItem->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" name="description" rows="3">{{ old('description', $menuItem->description) }}</textarea>
                </div>

                {{-- ✅ Updated Category Dropdown --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹)</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $menuItem->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <select name="availability" class="form-select" required>
                        <option value="1" {{ $menuItem->availability == 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ $menuItem->availability == 0 ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                @if ($menuItem->image)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="{{ asset($menuItem->image) }}" alt="Menu Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">JPEG, PNG, JPG, or WEBP. Max 2MB.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Item</button>
                <a href="{{ route('admin.menu-management') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>
@endsection
