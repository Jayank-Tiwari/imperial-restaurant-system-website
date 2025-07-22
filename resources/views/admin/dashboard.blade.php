@extends('admin.sidebar')

@section('title', __('messages.dashboard') . ' - ' . __('messages.imperial_spice'))
@section('active', 'dashboard')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('messages.dashboard_overview')</h1>
    </div>

    <!-- Dashboard Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">@lang('messages.total_revenue')</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">&#8377;{{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <i class="bi bi-currency-rupee fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">@lang('messages.total_orders')</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <i class="bi bi-bag-check fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">@lang('messages.average_order_value')</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">&#8377;{{ number_format($averageOrderValue, 2) }}</div>
                        </div>
                        <i class="bi bi-graph-up fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">@lang('messages.monthly_orders')</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlyOrders }}</div>
                        </div>
                        <i class="bi bi-calendar-event fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">@lang('messages.revenue_last_7_days')</div>
        <div class="card-body">
            <canvas id="revenueChart" height="100"></canvas>
        </div>
    </div>

    <!-- Order Status Summary -->
    <div class="row mb-4">
        @foreach($statusCounts as $label => $count)
            <div class="col-md-2 col-sm-4 mb-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body p-3">
                        <h6 class="text-uppercase small">@lang('messages.order_status_' . $label)</h6>
                        <h4 class="fw-bold mb-0">{{ $count }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@lang('messages.recent_orders_excl_cancelled')</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>@lang('messages.order_number')</th>
                            <th>@lang('messages.customer')</th>
                            <th>@lang('messages.total')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>&#8377;{{ number_format($order->total_amount, 2) }}</td>
                                <td><span class="badge bg-info">@lang('messages.order_status_' . $order->order_status)</span></td>
                                <td>{{ $order->created_at->format('d M Y - h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($graphLabels),
            datasets: [{
                label: '@lang('messages.revenue')',
                data: @json($graphData),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
