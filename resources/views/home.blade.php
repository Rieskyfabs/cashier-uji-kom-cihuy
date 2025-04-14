@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="main-content-table">
        <section class="section">
            <div class="margin-content">
                <div class="container-sm">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <!-- Stat Card 1 -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        Total Pengguna
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $totalUsers }}</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Stat Card 2 -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        Total Pendapatan
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ number_format($totalSales, 2) }}</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Stat Card 3 -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        Total Produk
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $totalProducts }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Penjualan 
                                    </div>
                                    <div class="card-body">
                                        <canvas id="salesChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Sales Over Time Chart
            var salesCtx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: @json($sales_labels),
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: @json($sales_data),
                        borderColor: '#66bb6a',
                        fill: false,
                        tension: 0.1
                    }]
                }
            });
        </script>
    @endpush
@endsection
