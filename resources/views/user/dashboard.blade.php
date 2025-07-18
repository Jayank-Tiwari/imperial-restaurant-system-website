@extends('user.sidebar')

@section('title', 'User Dashboard - Imperial Spice')
@section('active', 'dashboard')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <h2 class="mb-4">My Orders</h2>

        @if ($orders->count())
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Delivery OTP</th>
                            <th>Delivery Status</th>
                            <th>Placed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'danger' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td><span
                                        class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</span>
                                </td>
                                <td>
                                    {{ $order->delivery->otp ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ ucfirst($order->delivery->status ?? 'Not Assigned') }}
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">You haven’t placed any orders yet.</div>
        @endif
    </main>
    @endsection
