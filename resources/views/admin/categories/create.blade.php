@extends('admin.sidebar')

@section('title', __('messages.add_category') . ' - ' . __('messages.imperial_spice'))
@section('active', 'category')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('messages.add_category')</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">@lang('messages.category_name')</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">@lang('messages.add_category')</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
            </form>
        </div>
    </div>
</main>
@endsection