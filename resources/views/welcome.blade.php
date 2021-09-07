@extends('layouts.app')

@section('title')
    <title>Dashboard - SB Admin</title>
@endsection

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ringkasan pendapatan</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h6>
                        Total Berat Panen
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{-- {{dd($totalReport->totalWeight)}} --}}
                        {{ $totalReport->totalWeight }} Kg
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h6>
                        Total Hasil Panen
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($totalReport->totalIncome) }}
                    </p>
                </div>
            </div>
        </div>
        @if ($monthlyReport->monthlyWeight)
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h6>
                        Panen Bulan Ini
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{ $monthlyReport->monthlyWeight }} Kg
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if ($monthlyReport->monthlyIncome)
            <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h6>Pendapatan Bulan Ini</h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($monthlyReport->monthlyIncome) }}
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    <strong>Grafik Panen</strong>
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    <strong>Grafik Pemasukan</strong>
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
        let summaryReports = @json($graphReport);
        let summary = {
            weights : [],
            months  : [],
            prices  : [],
        };


        summaryReports.forEach((report, index) => {
            {
                summary.weights[index] = report.weight;
                summary.months[index]  = report.month;
                summary.prices[index]  = parseInt(report.total_price.replace(',', ''));
            }
        });

        drawAreaChart(summary.months, summary.weights, Math.max(...summary.weights))
        drawBarChart(summary.months, summary.prices, Math.max(...summary.prices))
    </script>
@endpush
