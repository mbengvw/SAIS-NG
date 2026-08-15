@extends('main')

@section('content')
<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        padding: 20px;
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
        margin-bottom: 40px;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        backdrop-filter: blur(10px);
    }
    
    .hero-banner::before {
        content: '';
        position: absolute;
        bottom: -30%;
        right: 10%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 1.1rem;
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

    /* App Launcher Style Menu */
    .app-menu-container {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 10px;
        justify-items: center;
    }
    
    @media (min-width: 576px) {
        .menu-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    @media (min-width: 768px) {
        .menu-grid {
            grid-template-columns: repeat(6, 1fr);
            gap: 30px 20px;
        }
    }

    .app-icon-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        color: #374151;
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        width: 100%;
    }

    .app-icon-link:hover {
        transform: scale(1.08);
    }

    .app-icon-bg {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 8px;
        box-shadow: 0 6px 12px rgba(var(--card-rgb), 0.25);
        background: linear-gradient(135deg, var(--card-color-1), var(--card-color-2));
    }

    .app-icon-label {
        font-size: 0.8rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.2;
        color: #4b5563;
    }
    
    .app-icon-link:hover .app-icon-label {
        color: rgb(var(--card-rgb));
        font-weight: 600;
    }

    /* Specific Card Colors */
    .card-siswa { --card-rgb: 59, 130, 246; --card-color-1: #60a5fa; --card-color-2: #3b82f6; } /* Blue */
    .card-kelas { --card-rgb: 16, 185, 129; --card-color-1: #34d399; --card-color-2: #10b981; } /* Green */
    .card-grouping { --card-rgb: 236, 72, 153; --card-color-1: #f472b6; --card-color-2: #ec4899; } /* Pink */
    .card-tahun { --card-rgb: 245, 158, 11; --card-color-1: #fbbf24; --card-color-2: #f59e0b; } /* Yellow */
    .card-hukdis { --card-rgb: 239, 68, 68; --card-color-1: #f87171; --card-color-2: #ef4444; } /* Red */
    .card-user { --card-rgb: 139, 92, 246; --card-color-1: #a78bfa; --card-color-2: #8b5cf6; } /* Purple */
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
        }
        .hero-banner {
            padding: 30px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
        }
        .app-icon-bg {
            width: 56px;
            height: 56px;
            font-size: 24px;
            border-radius: 16px;
        }
        .app-icon-label {
            font-size: 0.75rem;
        }
    }
</style>

<div class="container-fluid dashboard-wrapper">
    
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div style="position: relative; z-index: 10;">
            <h1 class="hero-title">Welcome back, {{ $nama }}! ✨</h1>
            <div class="hero-subtitle">
                <span>Sistem Informasi Siswa MAN 2 Kuningan</span>
                <span class="badge-tahun"><i class="fa fa-calendar mr-2"></i>Tahun Akademik: {{ $tahun ?? 'Belum Diatur' }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-5 mt-2">
        <h5 class="font-weight-bold text-dark mb-4 px-2" style="font-family: 'Inter', sans-serif;">Menu Administrator</h5>
        
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
@endsection

@section('script')
@endsection
