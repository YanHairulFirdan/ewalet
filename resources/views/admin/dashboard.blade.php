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
        <div class="col-xl-6 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h6>
                        Total Pengguna
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{ $users }} Orang
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h6>
                        Total Pemasuka
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($payments) }}
                    </p>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h6>
                        Panen Bulan Ini
                    </h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        {{ $current_month_weight }} Kg
                    </p>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h6>Pendapatan Bulan Ini</h6>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p>
                        Rp.{{ number_format($current_month_price) }}
                    </p>
                </div>
            </div>
        </div> --}}
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
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/chart-bar-demo.js') }}"></script>
    <script>
        let months = @json($months);
        let users = @json($userAmounts);
        let max = Math.max(...users);
        console.log(months);
        console.log(users);
        console.log(max);
        drawAreaChart(months, users, max)
        // drawBarChart(summaryMonths, summaryTotalPrice, maxProfit)
    </script>
@endpush
