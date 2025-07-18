@extends('delivery.sidebar')

@section('title', 'Dashboard - Imperial Spice')
@section('active', 'dashboard')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2 class="mt-4">Order #{{ $delivery->order_id }} Details</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Delivery Address:</strong> {{ $delivery->order->delivery_address }}</li>
        <li class="list-group-item"><strong>Total Amount:</strong> ₹{{ $delivery->order->total_amount }}</li>
        <li class="list-group-item"><strong>Order Status:</strong> {{ $delivery->order->order_status }}</li>
    </ul>

    <form action="{{ route('delivery.orders.verifyOtp', $delivery->order_id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="otp">Enter OTP from Customer</label>
            <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror" maxlength="6" required>
            @error('otp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Verify & Complete Delivery</button>
    </form>
</main>
@endsection
