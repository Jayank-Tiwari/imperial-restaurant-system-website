@extends('admin.sidebar')
@section('title', 'Assign Delivery')
@section('active', 'delivery')

@section('content')
<div class="container-fluid py-3">
    <h4 class="mb-3">Assign Orders to Delivery Staff</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.delivery.assign') }}" method="POST" class="row gy-2 gx-3 align-items-center">
        @csrf
        <div class="col-auto">
            <select name="staff_id" class="form-select" required>
                <option value="">Select Delivery Staff</option>
                @foreach ($staff as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <select name="order_id" class="form-select" required>
                <option value="">Select Order</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">#{{ $order->id }} - ₹{{ $order->total_amount }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Assign</button>
        </div>
    </form>

    <hr class="my-4">

    <h5>Delivery Staff List</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Assigned Deliveries</th>
                <th>Delivered</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staff as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->deliveries()->count() }}</td>
                    <td>{{ $user->deliveries()->where('status', 'delivered')->count() }}</td>
                    <td>
                        <a href="{{ route('admin.delivery.orders', $user->id) }}" class="btn btn-sm btn-outline-primary">View Orders</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
