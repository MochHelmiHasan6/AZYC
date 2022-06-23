@extends('admin.layouts.app')
@section('header')
<style>
    .ik {
        cursor: pointer;
    }

    #trHover:hover {
        background-color: #e6e6e6;
    }

</style>
@endsection
@section('iconHeader')
<i class="mdi mdi-sitemap bg-inverse"></i>
@endsection
@section('titleHeader')
Dashboard
@endsection
@section('subtitleHeader')
Dashboard Admin
@endsection
@section('breadcrumb')
Dashboard
@endsection
@section('content-wrapper')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>User</h6>
                                    <h2>{{number_format($user)}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Jasa</h6>
                                    <h2>{{number_format($jasa)}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="mdi mdi-archive"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Pesanan</h6>
                                    <h2>{{number_format($pesanan)}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="mdi mdi-message-text-outline"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Grafik Pesanan/Bulan</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('lineChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'PESANAN/BULAN',
                data: [
                    {{$januari}},
                    {{$februari}},
                    {{$maret}},
                    {{$april}},
                    {{$mei}},
                    {{$juni}},
                    {{$juli}},
                    {{$agustus}},
                    {{$september}},
                    {{$oktober}},
                    {{$november}},
                    {{$desember}},
                ],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection

