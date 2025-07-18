@extends('delivery.sidebar')

@section('title', 'Delivery Dashboard - Imperial Spice')
@section('active', 'dashboard')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-4 mb-4">Assigned Orders</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Delivery Address</th>
                    <th>Assigned At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->order_id }}</td>
                        <td>{{ $delivery->order->delivery_address }}</td>
                        <td>{{ $delivery->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('delivery.orders.show', $delivery->order_id) }}"
                                class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
