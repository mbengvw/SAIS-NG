@extends('main')

@section('content')
<style>
    .mobile-wrapper {
        max-width: 480px;
        margin: 0 auto;
        background: #f8f9fa;
        min-height: calc(100vh - 120px);
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding-bottom: 30px;
    }
    .mobile-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 40px 20px 30px;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        margin-bottom: 30px;
    }
    .menu-grid {
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .menu-card {
        background: white;
        border-radius: 15px;
        padding: 25px 15px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none !important;
        display: block;
        color: #333;
        border: 1px solid rgba(0,0,0,0.02);
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        color: #007bff;
    }
    .menu-icon {
        width: 65px;
        height: 65px;
        margin-bottom: 15px;
        object-fit: contain;
    }
    .menu-title {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.3;
    }
</style>

<div class="mobile-wrapper">
    <div class="mobile-header text-center">
        <h4 class="mb-2 font-weight-bold">Hai {{ $nama }} 👋</h4>
        <p class="mb-0 text-white-50" style="font-size: 14px;">Tahun Akademik Aktif: {{ $tahun }}</p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('presensi.index') }}" class="menu-card">
            <img src="{{ asset('images/legalisir.png') }}" class="menu-icon">
            <div class="menu-title">Absensi Harian Siswa</div>
        </a>
        
        <a href="{{ route('presensi.rekap') }}" class="menu-card">
            <img src="{{ asset('images/absen.png') }}" class="menu-icon">
            <div class="menu-title">Data Kehadiran</div>
        </a>
        
        <a href="{{ route('piket.list-students') }}" class="menu-card">
            <img src="{{ asset('images/peoples.png') }}" class="menu-icon">
            <div class="menu-title">Daftar Siswa</div>
        </a>
        
        <a href="{{ route('piket.hukdis') }}" class="menu-card">
            <img src="{{ asset('images/hukdis.png') }}" class="menu-icon">
            <div class="menu-title">Hukuman Disiplin</div>
        </a>
    </div>
</div>
@endsection

@section('script')
@endsection
