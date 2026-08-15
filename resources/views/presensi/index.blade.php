@extends('main')

@section('content')
<style>
    /* Mobile App Global Styles */
    body {
        background-color: #f4f6f9 !important;
    }
    .mobile-app-wrapper {
        max-width: 480px;
        margin: 0 auto;
        background-color: #f4f6f9;
        min-height: 100vh;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        position: relative;
        padding-bottom: 80px;
    }
    .app-header {
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 10;
        padding: 15px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        margin-bottom: 20px;
    }
    .app-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 2px;
    }
    .app-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
    }
    .form-group-mobile {
        margin-top: 15px;
    }
    .select-kelas-mobile {
        width: 100%;
        padding: 12px 15px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        font-size: 1.1rem;
        font-weight: 700;
        background-color: #f8f9fa;
        color: #2c3e50;
        outline: none;
        transition: border-color 0.3s ease;
    }
    .select-kelas-mobile:focus {
        border-color: #4a90e2;
    }
    .search-input-mobile {
        width: 100%;
        padding: 12px 15px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        font-size: 1rem;
        background-color: #f8f9fa;
        margin-top: 12px;
        outline: none;
    }
    .search-input-mobile:focus {
        border-color: #4a90e2;
    }
    .cards-wrapper {
        padding: 0 15px;
    }

    /* Student Card overrides for mobile app */
    .student-card {
        margin-bottom: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        border-radius: 16px;
        border: none;
        border-left: 6px solid #ccc;
        background: #fff;
        transition: transform 0.2s ease;
    }
    .student-card .card-body {
        padding: 20px;
    }
    .student-name {
        font-weight: 800;
        font-size: 1.35rem;
        color: #1a202c;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .student-gender {
        font-size: 0.95rem;
        color: #718096;
        margin-bottom: 15px;
        font-weight: 600;
    }
    .btn-presensi {
        flex: 1;
        padding: 8px 5px;
        font-size: 1rem;
        font-weight: 800;
        border-radius: 12px !important;
        margin: 0 5px;
        border: 2px solid transparent;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-group-presensi {
        display: flex;
        width: 100%;
        margin-bottom: 15px;
        justify-content: space-between;
    }
    .btn-presensi.active {
        border: 2px solid #2d3748;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-2px) scale(1.02);
    }
    .status-S.active { background-color: #ffc107 !important; color: #000; border-color: #d39e00; }
    .status-I.active { background-color: #17a2b8 !important; color: #fff; border-color: #117a8b; }
    .status-A.active { background-color: #dc3545 !important; color: #fff; border-color: #bd2130; }
    
    .status-S { background-color: #fff8e1; color: #b78700; border: 1px solid #ffecb3; }
    .status-I { background-color: #e0f7fa; color: #00838f; border: 1px solid #b2ebf2; }
    .status-A { background-color: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

    .action-row {
        display: flex;
        gap: 12px;
    }
    .action-row input {
        flex-grow: 1;
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        background: #f7fafc;
        font-size: 1rem;
    }
    .action-row button {
        border-radius: 10px;
        font-weight: 700;
        padding: 0 16px;
    }
    .home-btn-wrapper {
        padding: 25px 15px;
        text-align: center;
    }
    .home-btn-wrapper a {
        border-radius: 25px;
        padding: 14px 30px;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        width: 100%;
    }
</style>

<div class="mobile-app-wrapper">
    <div class="app-header">
        <div class="app-title">Absensi Kehadiran</div>
        <div class="app-subtitle">
            Sem {{ $data_th_akademik->semester }} ({{ $data_th_akademik->tahun }}) • {{ $tanggal }}
            <input type="text" id="tahun_aktif" value="{{ $data_th_akademik->tahun }}" hidden>
            <input type="text" id="semester" value="{{ $data_th_akademik->semester }}" hidden>
        </div>
        
        <div class="form-group-mobile">
            <select id="select_kelas" name="select_kelas" class="select-kelas-mobile">
                <option value="">-- Pilih Kelas --</option>
                @foreach ($list_kelas as $kelas)
                    <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                @endforeach
            </select>
        </div>
        
        <input type="text" id="search_student" class="search-input-mobile" placeholder="🔍 Cari nama siswa (ketik di sini...)">
    </div>

    <div class="cards-wrapper" id="attendance_container">
        <!-- Kartu-kartu absen siswa akan dirender di sini via Javascript -->
    </div>

    @if (auth()->user()->hasRole('guru-piket') || auth()->user()->piket == 1)
        <div class="home-btn-wrapper">
            <a href="{{ route('piket.index') }}" class="btn btn-dark btn-block">⬅ Kembali ke Beranda</a>
        </div>
    @endif
</div>
@endsection

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('presensi.index') }}",
        };
    </script>

    <script src="{{ asset('js/attendance.js') }}" defer></script>
@endsection
