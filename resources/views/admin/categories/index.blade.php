@extends('admin.sidebar')

@section('title', __('messages.categories') . ' - ' . __('messages.imperial_spice'))
@section('active', 'category')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 m-0">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('messages.categories')</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ @lang('messages.add_category')</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('messages.id')</th>
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-1">@lang('messages.edit')</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('@lang('messages.are_you_sure')')">@lang('messages.delete')</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">@lang('messages.no_categories_found')</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection