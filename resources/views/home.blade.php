@extends('main')

@section('content')
<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        padding: 20px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    /* Hero Banner */
    .hero-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        margin-bottom: 30px;
    }

    .hero-banner::after, .hero-banner::before {
        content: '';
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    .hero-banner::after {
        top: -50%; right: -10%;
        width: 300px; height: 300px;
        backdrop-filter: blur(10px);
    }
    .hero-banner::before {
        bottom: -30%; right: 10%;
        width: 200px; height: 200px;
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 1.05rem;
        opacity: 0.95;
        font-weight: 400;
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .badge-tahun {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(5px);
        padding: 6px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* Widget Cards */
    .widget-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        border: 1px solid #f1f5f9;
    }
    .widget-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }
    .widget-info h6 {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .widget-info h2 {
        color: #0f172a;
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1;
    }
    .widget-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .icon-blue { background: #eff6ff; color: #3b82f6; }
    .icon-green { background: #f0fdf4; color: #10b981; }
    .icon-red { background: #fef2f2; color: #ef4444; }
    .icon-orange { background: #fffbeb; color: #f59e0b; }

    /* Content Cards (Charts & Tables) */
    .content-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        border: 1px solid #f1f5f9;
        height: 100%;
    }
    .content-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .content-card-title i {
        color: #64748b;
    }

    /* Tables */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table-modern th {
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        padding: 0 15px 10px;
        border: none;
    }
    .table-modern td {
        background: #f8fafc;
        padding: 12px 15px;
        color: #334155;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .table-modern tr td:first-child { border-radius: 10px 0 0 10px; }
    .table-modern tr td:last-child { border-radius: 0 10px 10px 0; }
    .poin-badge {
        background: #fee2e2;
        color: #b91c1c;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* App Launcher Menu */
    .app-menu-container {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
    }
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 10px;
        justify-items: center;
    }
    @media (min-width: 576px) { .menu-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (min-width: 768px) { .menu-grid { grid-template-columns: repeat(6, 1fr); gap: 30px 20px; } }
    .app-icon-link {
        display: flex; flex-direction: column; align-items: center;
        text-decoration: none !important; color: #374151;
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        width: 100%;
    }
    .app-icon-link:hover { transform: scale(1.08); }
    .app-icon-bg {
        width: 60px; height: 60px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: white; margin-bottom: 8px;
        box-shadow: 0 6px 12px rgba(var(--card-rgb), 0.25);
        background: linear-gradient(135deg, var(--card-color-1), var(--card-color-2));
    }
    .app-icon-label {
        font-size: 0.8rem; font-weight: 500; text-align: center;
        line-height: 1.2; color: #4b5563;
    }
    .app-icon-link:hover .app-icon-label { color: rgb(var(--card-rgb)); font-weight: 600; }
    
    .card-siswa { --card-rgb: 59, 130, 246; --card-color-1: #60a5fa; --card-color-2: #3b82f6; }
    .card-kelas { --card-rgb: 16, 185, 129; --card-color-1: #34d399; --card-color-2: #10b981; }
    .card-grouping { --card-rgb: 236, 72, 153; --card-color-1: #f472b6; --card-color-2: #ec4899; }
    .card-tahun { --card-rgb: 245, 158, 11; --card-color-1: #fbbf24; --card-color-2: #f59e0b; }
    .card-hukdis { --card-rgb: 239, 68, 68; --card-color-1: #f87171; --card-color-2: #ef4444; }
    .card-user { --card-rgb: 139, 92, 246; --card-color-1: #a78bfa; --card-color-2: #8b5cf6; }
</style>

<div class="container-fluid dashboard-wrapper">
    
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div style="position: relative; z-index: 10;">
            <h1 class="hero-title">Welcome back, {{ $nama }}! ✨</h1>
            <div class="hero-subtitle">
                <span>Dashboard Kesiswaan - MAN 2 Kuningan</span>
                <span class="badge-tahun"><i class="fa fa-calendar mr-2"></i>Tahun Akademik: {{ $tahun ?? 'Belum Diatur' }}</span>
            </div>
        </div>
    </div>

    @if(isset($dashboard) && !empty($dashboard))
    <!-- Stats Widgets Row -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="widget-card">
                <div class="widget-info">
                    <h6>Total Siswa Aktif</h6>
                    <h2>{{ number_format($dashboard['stats']['total_siswa']) }}</h2>
                </div>
                <div class="widget-icon icon-blue">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="widget-card">
                <div class="widget-info">
                    <h6>Total Kelas</h6>
                    <h2>{{ number_format($dashboard['stats']['total_kelas']) }}</h2>
                </div>
                <div class="widget-icon icon-green">
                    <i class="fa fa-building-o"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="widget-card">
                <div class="widget-info">
                    <h6>Kasus Bulan Ini</h6>
                    <h2>{{ number_format($dashboard['stats']['total_kasus_bulan_ini']) }}</h2>
                </div>
                <div class="widget-icon icon-red">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="widget-card">
                <div class="widget-info">
                    <h6>Absen Bulan Ini (S/I/A)</h6>
                    <h2>{{ number_format($dashboard['stats']['total_absen_bulan_ini']) }}</h2>
                </div>
                <div class="widget-icon icon-orange">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Pelanggaran Trend -->
        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <div class="content-card-title">
                    <i class="fa fa-line-chart"></i> Tren Pelanggaran Bulanan
                </div>
                <div style="height: 300px;">
                    <canvas id="pelanggaranChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Presensi Trend -->
        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <div class="content-card-title">
                    <i class="fa fa-bar-chart"></i> Tren Ketidakhadiran Bulanan (S/I/A)
                </div>
                <div style="height: 300px;">
                    <canvas id="presensiChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Lists Row -->
    <div class="row">
        <!-- Top 5 Kelas -->
        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <div class="content-card-title text-danger">
                    <i class="fa fa-fire text-danger"></i> Top 5 Kelas Terbanyak Pelanggaran
                </div>
                <table class="table-modern w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Total Kasus</th>
                            <th class="text-right">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dashboard['top_kelas'] as $index => $k)
                        <tr>
                            <td>#{{ $index + 1 }}</td>
                            <td><strong>{{ $k->nama_kelas }}</strong></td>
                            <td>{{ $k->total_kasus }} kasus</td>
                            <td class="text-right"><span class="poin-badge">{{ $k->total_poin }} Poin</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data pelanggaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Top 5 Siswa -->
        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <div class="content-card-title text-danger">
                    <i class="fa fa-user-times text-danger"></i> Top 5 Siswa Poin Tertinggi
                </div>
                <table class="table-modern w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th class="text-right">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dashboard['top_siswa'] as $index => $s)
                        <tr>
                            <td>#{{ $index + 1 }}</td>
                            <td><strong>{{ $s->nama }}</strong></td>
                            <td>{{ $s->nama_kelas }}</td>
                            <td class="text-right"><span class="poin-badge">{{ $s->total_poin }} Poin</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data pelanggaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="mb-5 mt-4">
        <h5 class="font-weight-bold text-dark mb-4 px-2" style="font-family: 'Inter', sans-serif;">
            <i class="fa fa-th-large mr-2 text-primary"></i> Quick Access Menu
        </h5>
        
        <div class="app-menu-container">
            <div class="menu-grid">
                @if(isset($userMenus) && $userMenus->count() > 0)
                    @foreach($userMenus as $menu)
                        <a href="{{ Route::has($menu->route_name) ? route($menu->route_name) : '#' }}" class="app-icon-link {{ $menu->color_class }}">
                            <div class="app-icon-bg">
                                <i class="fa {{ $menu->icon }}"></i>
                            </div>
                            <div class="app-icon-label">{{ $menu->title }}</div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center w-100 py-4 text-muted">
                        <i class="fa fa-folder-open-o fa-2x mb-3"></i>
                        <p>Menu belum dikonfigurasi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(isset($dashboard) && !empty($dashboard))
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Shared Chart Options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                titleFont: { size: 13, family: 'Inter' },
                bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                padding: 12,
                cornerRadius: 8,
                displayColors: false,
            }
        },
        scales: {
            x: {
                grid: { display: false, drawBorder: false },
                ticks: { font: { family: 'Inter', size: 12 }, color: '#64748b' }
            },
            y: {
                grid: { borderDash: [5, 5], color: '#f1f5f9', drawBorder: false },
                ticks: { font: { family: 'Inter', size: 12 }, color: '#64748b', precision: 0, beginAtZero: true }
            }
        },
        interaction: { mode: 'index', intersect: false }
    };

    // Pelanggaran Trend Chart (Line Chart with Area)
    const ctxPelanggaran = document.getElementById('pelanggaranChart').getContext('2d');
    
    // Create gradient
    let gradientRed = ctxPelanggaran.createLinearGradient(0, 0, 0, 300);
    gradientRed.addColorStop(0, 'rgba(239, 68, 68, 0.3)');
    gradientRed.addColorStop(1, 'rgba(239, 68, 68, 0.0)');

    new Chart(ctxPelanggaran, {
        type: 'line',
        data: {
            labels: {!! json_encode($dashboard['trend_pelanggaran']['labels']) !!},
            datasets: [{
                label: 'Kasus Pelanggaran',
                data: {!! json_encode($dashboard['trend_pelanggaran']['data']) !!},
                borderColor: '#ef4444',
                backgroundColor: gradientRed,
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ef4444',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: commonOptions
    });

    // Presensi Trend Chart (Bar Chart)
    const ctxPresensi = document.getElementById('presensiChart').getContext('2d');
    
    new Chart(ctxPresensi, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dashboard['trend_presensi']['labels']) !!},
            datasets: [{
                label: 'Ketidakhadiran (S/I/A)',
                data: {!! json_encode($dashboard['trend_presensi']['data']) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 6,
                barPercentage: 0.6,
                hoverBackgroundColor: '#2563eb'
            }]
        },
        options: commonOptions
    });
});
</script>
@endif

@endsection

@section('script')
@endsection
