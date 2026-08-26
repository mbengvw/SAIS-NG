@extends('main')

@section('content')
<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        padding: 20px;
    }

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
    
    @media (min-width: 992px) {
        .menu-grid {
            grid-template-columns: repeat(6, 1fr);
        }
    }

    .app-icon-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        color: #374151;
        width: 100%;
        cursor: default; /* Not clickable */
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

    .card-status-sudah { --card-rgb: 16, 185, 129; --card-color-1: #34d399; --card-color-2: #10b981; } /* Green */
    .card-status-belum { --card-rgb: 239, 68, 68; --card-color-1: #fca5a5; --card-color-2: #ef4444; } /* Red */
</style>

<div class="container-fluid dashboard-wrapper">
    <div class="mb-5 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4 px-2">
            <h5 class="font-weight-bold text-dark m-0" style="font-family: 'Inter', sans-serif;">
                <i class="fa fa-dashboard text-primary mr-2"></i> Status Absensi Hari Ini
            </h5>
            <form method="GET" action="{{ route('presensi.monitoring_piket') }}">
                <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="form-control" style="border-radius: 20px; font-weight: 600;">
            </form>
        </div>
        
        <div class="app-menu-container" style="background: #f8fafc; border: 1px solid #e2e8f0;">
            <div class="menu-grid">
                @foreach($list_kelas as $kelas)
                    <div class="app-icon-link {{ $kelas['sudah_diabsen'] ? 'card-status-sudah' : 'card-status-belum' }}">
                        <div class="app-icon-bg" style="font-size: 0.8rem; font-weight: bold; width: 64px; height: 64px; text-align: center; line-height: 1.2; padding: 4px; word-break: break-all; overflow-wrap: anywhere; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            {{ str_replace('10.', 'X.', str_replace('11.', 'XI.', str_replace('12.', 'XII.', $kelas['nama_kelas']))) }}
                        </div>
                        <div class="app-icon-label" style="margin-top: 5px;">
                            @if($kelas['sudah_diabsen'])
                                <i class="fa fa-check text-success"></i> <span class="text-success font-weight-bold">Selesai</span>
                                <div style="font-size: 0.65rem; color: #6c757d; margin-top: 2px; line-height: 1.1;">oleh {{ $kelas['diabsen_oleh'] }}</div>
                            @else
                                <i class="fa fa-times text-danger"></i> <span class="text-danger font-weight-bold">Belum</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
