@extends('admin.sidebar')
@section('title', 'Delivery Orders')
@section('active', 'delivery')

@section('content')
<div class="container py-3">
    <h4 class="mb-3">Orders for {{ $staff->name }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Total</th>
                <th>Status</th>
                <th>OTP</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $delivery)
                <tr>
                    <td>#{{ $delivery->order->id }}</td>
                    <td>₹{{ $delivery->order->total_amount }}</td>
                    <td>{{ ucfirst($delivery->status) }}</td>
                    <td>{{ $delivery->otp }}</td>
                    <td>{{ $delivery->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
