@extends('delivery.sidebar')

@section('title', 'Delivered Orders - Imperial Spice')
@section('active', 'delivered')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
    <h2 class="mb-4">Delivered Orders</h2>

    @if ($deliveries->count())
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Delivery Address</th>
                        <th>Delivered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td>#{{ $delivery->order->id }}</td>
                            <td>{{ $delivery->order->user->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($delivery->order->total_amount, 2) }}</td>
                            <td>{{ $delivery->order->delivery_address }}</td>
                            <td>{{ $delivery->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No delivered orders found.</div>
    @endif
</main>
@endsection
