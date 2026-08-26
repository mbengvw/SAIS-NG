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
        margin-bottom: 20px;
    }
    .status-card {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
    }
    .kelas-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
    }
    .kelas-wali {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .badge-status {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-sudah {
        background-color: #d4edda;
        color: #155724;
    }
    .badge-belum {
        background-color: #f8d7da;
        color: #721c24;
    }
    .date-filter-form {
        padding: 0 20px 15px;
    }
    .date-filter-form input {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
        width: 100%;
        text-align: center;
        font-weight: 600;
        color: #495057;
    }
</style>

<div class="mobile-wrapper">
    <div class="mobile-header text-center">
        <h4 class="mb-2 font-weight-bold">Monitoring Absen</h4>
        <p class="mb-0 text-white-50" style="font-size: 14px;">Tahun Akademik Aktif: {{ $data_tahun->tahun }}</p>
    </div>

    <form class="date-filter-form" method="GET" action="{{ route('piket.status_absensi') }}">
        <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()">
    </form>

    @foreach($list_kelas as $kelas)
        <div class="status-card">
            <div>
                <div class="kelas-name">{{ $kelas['nama_kelas'] }}</div>
                <div class="kelas-wali">Wali: {{ $kelas['walikelas']['user']['name'] ?? 'Belum diset' }}</div>
            </div>
            <div>
                @if($kelas['sudah_diabsen'])
                    <span class="badge-status badge-sudah">Sudah Diabsen</span>
                    <div style="font-size: 0.75rem; color: #6c757d; margin-top: 5px; text-align: right;">oleh {{ $kelas['diabsen_oleh'] }}</div>
                @else
                    <span class="badge-status badge-belum">Belum Diabsen</span>
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center mt-4" style="padding: 0 20px;">
        <a href="{{ route('piket.index') }}" class="btn btn-dark btn-block" style="border-radius: 20px;">⬅ Kembali ke Dashboard Piket</a>
    </div>
</div>
@endsection
