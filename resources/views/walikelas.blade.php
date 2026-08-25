@extends('main')

@section('content')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .info-box {
        display: block;
        min-height: 90px;
        background: #fff;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 10px;
        margin-bottom: 15px;
        padding: 15px;
        position: relative;
    }
    .info-box-icon {
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        width: 60px;
        height: 60px;
        float: left;
        color: #fff;
    }
    .info-box-content {
        margin-left: 75px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 60px;
    }
    .info-box-text {
        text-transform: uppercase;
        font-size: 13px;
        color: #6c757d;
        font-weight: 600;
    }
    .info-box-number {
        font-weight: bold;
        font-size: 20px;
        color: #343a40;
    }
    .bg-alfa { background-color: #dc3545; }
    .bg-sakitizin { background-color: #ffc107; color: #fff !important; }
    .bg-pelanggaran { background-color: #6f42c1; }
    .bg-poin { background-color: #17a2b8; }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        background: #fff;
        font-weight: bold;
        color: #333;
    }
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .leaderboard-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .leaderboard-list li {
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .leaderboard-list li:last-child {
        border-bottom: none;
    }
    .badge-rank {
        width: 25px;
        height: 25px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        font-size: 12px;
        font-weight: bold;
        margin-right: 10px;
    }
    .rank-1 { background-color: #dc3545; }
    .rank-2 { background-color: #fd7e14; }
    .rank-3 { background-color: #ffc107; }
    .rank-other { background-color: #6c757d; }
</style>

<div class="container-fluid" style="padding-top: 20px;">
    <!-- Welcome Heading -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="font-weight-bold mb-1">Cockpit Wali Kelas</h3>
            <h6 class="text-muted mb-0">Selamat Datang, {{ $nama }} | Tahun Akademik {{ $tahun }} (Semester Berjalan)</h6>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-alfa"><i class="fa fa-user-times"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Alfa</span>
                    <span class="info-box-number">{{ $metrics['summary']['total_alfa'] ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-sakitizin"><i class="fa fa-medkit"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Sakit/Izin</span>
                    <span class="info-box-number">{{ $metrics['summary']['total_sakit_izin'] ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-pelanggaran"><i class="fa fa-warning"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pelanggaran Disiplin</span>
                    <span class="info-box-number">{{ $metrics['summary']['total_pelanggaran'] ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-poin"><i class="fa fa-trophy"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Poin Tertinggi</span>
                    <span class="info-box-number text-danger">{{ $metrics['summary']['poin_tertinggi'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mt-2">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><i class="fa fa-pie-chart text-primary"></i> Rasio Ketidakhadiran</div>
                <div class="card-body">
                    <canvas id="piePresensi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fa fa-bar-chart text-danger"></i> Top 5 Ketidakhadiran (S, I, A)</div>
                <div class="card-body">
                    <canvas id="barTopAbsen" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fa fa-line-chart text-success"></i> Tren Ketidakhadiran Per Bulan</div>
                <div class="card-body">
                    <canvas id="lineTrend" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="min-height: 350px;">
                <div class="card-header"><i class="fa fa-list-ol text-warning"></i> Top 5 Pelanggar Disiplin</div>
                <div class="card-body">
                    @if(count($metrics['top_pelanggar']) > 0)
                        <ul class="leaderboard-list">
                            @php $rank = 1; @endphp
                            @foreach($metrics['top_pelanggar'] as $nama_siswa => $poin)
                                <li>
                                    <div>
                                        <span class="badge-rank {{ $rank <= 3 ? 'rank-'.$rank : 'rank-other' }}">{{ $rank }}</span>
                                        <span class="font-weight-bold">{{ $nama_siswa }}</span>
                                    </div>
                                    <span class="badge badge-danger" style="font-size: 14px;">{{ $poin }} Poin</span>
                                </li>
                                @php $rank++; @endphp
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center text-muted mt-5">
                            <i class="fa fa-check-circle" style="font-size: 40px; color: #28a745;"></i>
                            <p class="mt-2">Belum ada pelanggaran disiplin di kelas ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JSON Data for Javascript -->
<script>
    const dashboardData = {
        piePresensi: @json($metrics['pie_presensi']),
        topAbsen: @json($metrics['top_absen']),
        trendAbsensi: @json($metrics['trend_absensi']),
        distribusiHukdis: @json($metrics['distribusi_hukdis'])
    };
</script>

@endsection

@section('script')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Pie Chart (Rasio Ketidakhadiran)
    const pieCtx = document.getElementById('piePresensi').getContext('2d');
    const pieData = dashboardData.piePresensi;
    
    // Only show S, I, A on Pie Chart (hide Hadir for better perspective on problems)
    let pieLabels = ['Sakit', 'Izin', 'Alfa'];
    let pieValues = [pieData.Sakit || 0, pieData.Izin || 0, pieData.Alfa || 0];
    let totalPie = pieValues.reduce((a,b) => a+b, 0);

    if (totalPie === 0) {
        pieLabels = ['Tidak ada absen'];
        pieValues = [1];
        new Chart(pieCtx, {
            type: 'doughnut',
            data: { labels: pieLabels, datasets: [{ data: pieValues, backgroundColor: ['#e9ecef'] }] },
            options: { plugins: { tooltip: { enabled: false } }, cutout: '70%' }
        });
    } else {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieValues,
                    backgroundColor: ['#ffc107', '#17a2b8', '#dc3545'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    // 2. Bar Chart (Top 5 Absen)
    const barCtx = document.getElementById('barTopAbsen').getContext('2d');
    const topAbsenData = dashboardData.topAbsen;
    
    let barLabels = topAbsenData.map(item => item.nama);
    let barAlfa = topAbsenData.map(item => parseInt(item.alfa));
    let barIzin = topAbsenData.map(item => parseInt(item.izin));
    let barSakit = topAbsenData.map(item => parseInt(item.sakit));

    if (topAbsenData.length === 0) {
        new Chart(barCtx, {
            type: 'bar',
            data: { labels: ['Tidak ada data'], datasets: [{ data: [0] }] },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { display: false }, x: { display: false } } }
        });
    } else {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [
                    { label: 'Alfa', backgroundColor: '#dc3545', data: barAlfa },
                    { label: 'Izin', backgroundColor: '#17a2b8', data: barIzin },
                    { label: 'Sakit', backgroundColor: '#ffc107', data: barSakit }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true }
                }
            }
        });
    }

    // 3. Line Chart (Tren Ketidakhadiran)
    const lineCtx = document.getElementById('lineTrend').getContext('2d');
    const trendData = dashboardData.trendAbsensi;
    
    let lineLabels = trendData.map(item => item.nama_bulan);
    let lineAlfa = trendData.map(item => parseInt(item.alfa));
    let lineSakitIzin = trendData.map(item => parseInt(item.sakit) + parseInt(item.izin));

    if (trendData.length === 0) {
        new Chart(lineCtx, {
            type: 'line',
            data: { labels: ['Tidak ada data'], datasets: [{ data: [0] }] },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { display: false }, x: { display: false } } }
        });
    } else {
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: lineLabels,
                datasets: [
                    {
                        label: 'Alfa',
                        backgroundColor: 'rgba(220, 53, 69, 0.2)',
                        borderColor: '#dc3545',
                        borderWidth: 2,
                        pointBackgroundColor: '#dc3545',
                        fill: true,
                        tension: 0.4,
                        data: lineAlfa
                    },
                    {
                        label: 'Sakit/Izin',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        borderColor: '#17a2b8',
                        borderWidth: 2,
                        pointBackgroundColor: '#17a2b8',
                        fill: true,
                        tension: 0.4,
                        data: lineSakitIzin
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
});
</script>
@endsection
