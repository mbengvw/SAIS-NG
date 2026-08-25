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
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: none;">
                <div class="card-body text-center p-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081078.png" alt="Welcome" style="width: 150px; opacity: 0.6; margin-bottom: 20px;">
                    <h4 class="text-muted font-weight-bold">Halo Guru Mapel!</h4>
                    <p class="text-muted">Fitur khusus untuk Guru Mata Pelajaran akan segera hadir di sini.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
