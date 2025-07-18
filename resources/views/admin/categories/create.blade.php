@extends('admin.sidebar')

@section('title', 'Add Category - Imperial Spice')
@section('active', 'category')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Category</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>
@endsection