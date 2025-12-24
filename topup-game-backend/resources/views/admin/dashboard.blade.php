@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard Statistik</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalGames }}</h3>
                <p>Total Game</p>
            </div>
            <div class="icon">
                <i class="fas fa-gamepad"></i>
            </div>
            <a href="{{ route('admin.games.index') }}" class="small-box-footer">Lihat Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalProducts }}</h3>
                <p>Total Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('admin.products.index') }}" class="small-box-footer">Lihat Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalTransactions }}</h3>
                <p>Transaksi</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>99%</h3>
                <p>Uptime System</p>
            </div>
            <div class="icon">
                <i class="fas fa-server"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top 5 Game Terpopuler</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Game</th>
                            <th>Platform</th>
                            <th>Popularitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($popularGames as $index => $game)
                            <tr>
                                <td>{{ $index + 1 }}.</td>
                                <td>{{ $game->name }}</td>
                                <td>{{ $game->platform ?? '-' }}</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger"
                                            style="width: {{ $game->popularity_rank }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Distribusi Penjualan (Berdasarkan Item)</h3>
            </div>
            <div class="card-body">
                @if(count($salesChart['data']) > 0)
                    <canvas id="salesChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-chart-pie fa-3x text-gray mb-3"></i>
                        <p class="text-muted">Belum ada data penjualan tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function () {
        // Sales Pie Chart
        @if(count($salesChart['data']) > 0)
            var salesCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($salesChart['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($salesChart['data']) !!},
                        backgroundColor: {!! json_encode($salesChart['colors']) !!},
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontColor: '#cbd5e1',
                            fontSize: 12,
                            padding: 15
                        }
                    }
                }
            });
        @endif
    });
</script>
@stop