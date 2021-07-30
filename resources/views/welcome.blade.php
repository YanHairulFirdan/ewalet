@extends('layouts.app')

@section('title')
    <title>Dashboard - SB Admin</title>
@endsection

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h4>
                        Total Berat Panen
                    </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{ $total_weight }} Kg
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>
                        Total Hasil Panen
                    </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($total_income) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h4>
                        Panen Bulan Ini
                    </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{ $current_month_weight }} Kg
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h4>Pendapatan Bulan Ini</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($current_month_price) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-bar-demo.js"></script>
    <script>
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let summaryReports = @json($summaryReports);

        let summaryWeights = []
        let summaryMonths = []
        let summaryTotalPrice = []

        summaryReports.forEach(report => {
            summaryMonths.push(monthNames[report.month - 1])
            summaryWeights.push(report.weight)
            summaryTotalPrice.push(report.total_price)
        });

        let maxProfit = summaryTotalPrice.reduce((a, b) => {
            return Math.max(a, b)
        });
        let maxWeight = summaryWeights.reduce((a, b) => {
            return Math.max(a, b)
        });

        drawAreaChart(summaryMonths, summaryWeights, maxWeight)
        drawBarChart(summaryMonths, summaryTotalPrice, maxProfit)
    </script>
@endpush
