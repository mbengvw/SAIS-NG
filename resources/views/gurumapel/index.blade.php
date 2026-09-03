@extends('main')

@section('content')
<style>
    /* Styling for Hero Banner */
    .hero-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        border-radius: 20px;
        color: white;
        padding: 40px 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .hero-banner::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 50%;
        background: url('data:image/svg+xml;utf8,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M0 100 Q 50 50 100 0 L 100 100 Z" fill="rgba(255,255,255,0.1)"/></svg>') no-repeat right bottom;
        background-size: cover;
        z-index: 1;
        pointer-events: none;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 500;
        margin-bottom: 0;
    }

    .badge-year {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 15px;
        backdrop-filter: blur(5px);
    }
    
    .class-card {
        border-radius: 15px; 
        border: none; 
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: #ffffff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .class-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.15);
    }
    
    .class-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .class-card:hover .class-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: #ffffff;
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
        }
        .hero-banner {
            padding: 30px 20px;
        }
    }
</style>

<div class="container-fluid" style="margin-top: 25px;">
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang, {{ $nama }}! 👋</h1>
            <p class="hero-subtitle">Dashboard Guru Mata Pelajaran</p>
            <div class="badge-year">
                <i class="fa fa-calendar-check-o mr-2"></i> Tahun Akademik {{ $tahun }}
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 mb-3">
            <h4 class="font-weight-bold">Mata Pelajaran yang Diampu</h4>
        </div>
        
        @if(isset($kelas_diampu) && count($kelas_diampu) > 0)
            @foreach($kelas_diampu as $penetapan)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card class-card h-100">
                        <div class="card-body text-center p-4 d-flex flex-column">
                            <div class="class-icon-wrapper">
                                <i class="fa fa-book"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">{{ $penetapan->mapel->nama_mapel ?? 'Mapel' }}</h5>
                            <p class="text-muted mb-4" style="font-size: 0.95rem; font-weight: 500;">
                                <i class="fa fa-users text-info mr-1"></i> Kelas {{ $penetapan->kelas->nama_kelas ?? 'Kelas' }}
                            </p>
                            <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}" class="btn btn-primary btn-sm btn-block rounded-pill mt-auto font-weight-bold" style="padding: 10px 15px; text-transform: uppercase; letter-spacing: 0.5px;">
                                Buka Kelas <i class="fa fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px; border: none;">
                    <div class="card-body text-center p-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/3081/3081078.png" alt="Welcome" style="width: 150px; opacity: 0.6; margin-bottom: 20px;">
                        <h4 class="text-muted font-weight-bold">Belum Ada Kelas</h4>
                        <p class="text-muted">Anda belum ditetapkan sebagai guru mata pelajaran untuk kelas manapun pada tahun akademik ini.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
