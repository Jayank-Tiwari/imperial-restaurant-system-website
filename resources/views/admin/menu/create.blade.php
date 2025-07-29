@extends('admin.sidebar')

@section('title', 'Add Menu Item')
@section('active', 'menu')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">Add New Menu Item</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Dish Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹)</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price') }}" required>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <select name="availability" class="form-select" required>
                        <option value="1" {{ old('availability') == 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ old('availability') === '0' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">JPEG, PNG, JPG, or WEBP. Max size: 2MB.</small>
                </div>

                <div id="preview" class="mb-3"></div>
                <script>
                document.querySelector('input[name="image"]').addEventListener('change', function(e) {
                    const preview = document.getElementById('preview');
                    preview.innerHTML = '';
                    if (this.files && this.files[0]) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(this.files[0]);
                        img.style.maxWidth = '200px';
                        img.className = 'img-thumbnail mt-2';
                        preview.appendChild(img);
                    }
                });
                </script>

                <button type="submit" class="btn btn-success">Add Item</button>
                <a href="{{ route('admin.menu-management') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>
@endsection
