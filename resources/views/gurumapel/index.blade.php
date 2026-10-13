@extends('main')

@section('content')
<style>
    /* ===== HERO BANNER ===== */
    .hero-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 55%, #818cf8 100%);
        border-radius: 16px;
        color: white;
        padding: 36px 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 35px rgba(79, 70, 229, 0.35);
        position: relative;
        overflow: hidden;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        pointer-events: none;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: 80px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 1.9rem;
        font-weight: 800;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .hero-subtitle {
        font-size: 1rem;
        opacity: 0.85;
        font-weight: 400;
        margin-bottom: 0;
    }

    .hero-stat-box {
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        padding: 12px 20px;
        display: inline-block;
        margin-top: 18px;
        backdrop-filter: blur(6px);
    }

    .hero-stat-box .stat-num {
        font-size: 1.7rem;
        font-weight: 800;
        line-height: 1;
        color: #fff;
    }

    .hero-stat-box .stat-label {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.8);
        font-weight: 500;
        letter-spacing: 0.5px;
        margin-top: 2px;
    }

    /* ===== CLASS CARDS ===== */
    .class-card {
        border-radius: 16px;
        border: none;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        background: #ffffff;
        box-shadow: 0 4px 18px rgba(0,0,0,0.09);
        overflow: hidden;
        position: relative;
    }

    .class-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 36px rgba(0,0,0,0.14);
    }


    .class-icon-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        transition: transform 0.22s ease;
    }

    .class-card:hover .class-icon-wrapper {
        transform: scale(1.1) rotate(4deg);
    }

    .btn { border-radius: 50px !important; }

    /* ===== SECTION LABEL ===== */
    .section-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #94a3b8;
        margin-bottom: 4px;
    }

    @media (max-width: 576px) {
        .hero-title { font-size: 1.5rem; }
        .hero-banner { padding: 26px 18px; }
    }
</style>

<div class="container-fluid" style="margin-top: 25px;">

    {{-- Hero Banner --}}
    <div class="hero-banner">
        <div class="hero-content">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <div>
                    <div class="section-label" style="color: rgba(255,255,255,0.7);">DASHBOARD GURU MATA PELAJARAN</div>
                    <h1 class="hero-title">Selamat Datang, {{ $nama }}! 👋</h1>
                    <p class="hero-subtitle">
                        <i class="fa fa-calendar mr-1"></i> Tahun Akademik <strong style="color:#fff;">{{ $tahun }}</strong>
                    </p>
                </div>
                <div class="d-flex mt-3 mt-md-0" style="gap: 12px; flex-wrap: wrap;">
                    <div class="hero-stat-box">
                        <div class="stat-num">{{ isset($kelas_diampu) ? count($kelas_diampu) : 0 }}</div>
                        <div class="stat-label">KELAS DIAMPU</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Kelas --}}
    <div class="row mb-3 align-items-center">
        <div class="col">
            <div class="section-label">DAFTAR KELAS</div>
            <h5 class="font-weight-bold text-dark mb-0">Mata Pelajaran yang Diampu</h5>
        </div>
    </div>

    @php
    $cardPalette = [
        ['accent' => '#4f46e5', 'light' => '#ede9fe', 'icon_bg' => 'linear-gradient(135deg, #4f46e5, #6366f1)'],
        ['accent' => '#0ea5e9', 'light' => '#e0f2fe', 'icon_bg' => 'linear-gradient(135deg, #0891b2, #38bdf8)'],
        ['accent' => '#10b981', 'light' => '#d1fae5', 'icon_bg' => 'linear-gradient(135deg, #059669, #34d399)'],
        ['accent' => '#f59e0b', 'light' => '#fef3c7', 'icon_bg' => 'linear-gradient(135deg, #d97706, #fbbf24)'],
        ['accent' => '#ec4899', 'light' => '#fce7f3', 'icon_bg' => 'linear-gradient(135deg, #db2777, #f472b6)'],
        ['accent' => '#8b5cf6', 'light' => '#ede9fe', 'icon_bg' => 'linear-gradient(135deg, #7c3aed, #a78bfa)'],
        ['accent' => '#14b8a6', 'light' => '#ccfbf1', 'icon_bg' => 'linear-gradient(135deg, #0d9488, #2dd4bf)'],
        ['accent' => '#ef4444', 'light' => '#fee2e2', 'icon_bg' => 'linear-gradient(135deg, #dc2626, #f87171)'],
    ];
    @endphp

    <div class="row">
        @if(isset($kelas_diampu) && count($kelas_diampu) > 0)
            @foreach($kelas_diampu as $i => $penetapan)
                @php $pal = $cardPalette[$i % count($cardPalette)]; @endphp
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card class-card h-100">
                        <div class="card-body p-4 d-flex flex-column">
                            {{-- Icon + info --}}
                            <div class="d-flex align-items-center mb-3" style="gap: 14px;">
                                <div class="class-icon-wrapper" style="background: {{ $pal['icon_bg'] }}; color: #fff;">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div style="min-width: 0;">
                                    <h6 class="font-weight-bold text-dark mb-0" style="font-size: 0.97rem; line-height: 1.3;">
                                        {{ $penetapan->mapel->nama_mapel ?? 'Mapel' }}
                                    </h6>
                                    <span class="badge font-weight-bold mt-1" style="background: {{ $pal['light'] }}; color: {{ $pal['accent'] }}; border-radius: 8px; font-size: 0.75rem; padding: 3px 8px;">
                                        <i class="fa fa-users mr-1"></i> Kelas {{ $penetapan->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Info rows --}}
                            <div class="mb-3 px-2 py-2" style="background: #f8fafc; border-radius: 10px;">
                                <div class="d-flex justify-content-between align-items-center small text-muted">
                                    <span><i class="fa fa-calendar mr-1" style="color: {{ $pal['accent'] }};"></i> Tahun Akademik</span>
                                    <strong class="text-dark">{{ $penetapan->tahun->alias_tahun ?? '-' }}</strong>
                                </div>
                            </div>

                            {{-- Action buttons --}}
                            <div class="row mt-auto" style="gap: 0;">
                                <div class="col-6 pr-1">
                                    <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}"
                                       class="btn btn-sm btn-block font-weight-bold"
                                       style="background: {{ $pal['light'] }}; color: {{ $pal['accent'] }}; border: none; font-size: 0.82rem; padding: 8px 0;">
                                        <i class="fa fa-book mr-1"></i> Jurnal
                                    </a>
                                </div>
                                <div class="col-6 pl-1">
                                    <a href="{{ route('gurumapel.nilai.index', $penetapan->id) }}"
                                       class="btn btn-sm btn-block font-weight-bold"
                                       style="background: {{ $pal['accent'] }}; color: #fff; border: none; font-size: 0.82rem; padding: 8px 0; box-shadow: 0 3px 10px {{ $pal['accent'] }}55;">
                                        <i class="fa fa-graduation-cap mr-1"></i> Nilai
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="card border-0 text-center" style="border-radius: 16px; box-shadow: 0 4px 18px rgba(0,0,0,0.08);">
                    <div class="card-body p-5">
                        <i class="fa fa-inbox text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h5 class="font-weight-bold text-dark">Belum Ada Kelas yang Diampu</h5>
                        <p class="text-muted" style="max-width: 400px; margin: 0 auto;">
                            Anda belum ditetapkan sebagai guru mata pelajaran untuk kelas manapun pada tahun akademik ini.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
