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
    .content-wrapper {
        padding: 0 15px;
    }
    .card-mobile {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        background: #fff;
    }
    .card-mobile .card-header {
        background-color: transparent;
        border-bottom: 1px solid #f0f0f0;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 15px 20px;
        color: #1a202c;
    }
    .card-mobile .card-body {
        padding: 20px;
    }
    .input-mobile {
        width: 100%;
        padding: 12px 15px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        font-size: 1rem;
        background-color: #f8f9fa;
        color: #2c3e50;
        outline: none;
        transition: border-color 0.3s ease;
        margin-bottom: 15px;
    }
    .input-mobile:focus {
        border-color: #4a90e2;
    }
    .btn-mobile {
        width: 100%;
        border-radius: 12px;
        padding: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .table-mobile-wrapper {
        font-size: 0.85rem;
    }
</style>

<div class="mobile-app-wrapper">
    <div class="app-header">
        <div class="app-title">Eksekusi Hukdis</div>
        <div class="app-subtitle">
            Sem {{ $data_th_akademik->semester }} ({{ $data_th_akademik->tahun }})
            <input type="text" value="{{ $data_th_akademik->tahun }}" id="tahun_aktif" hidden>
            <input type="text" value="{{ $data_th_akademik->semester }}" id="semester" hidden>
        </div>
    </div>

    <div class="content-wrapper">
        <!-- Form Eksekusi -->
        <div class="card card-mobile">
            <div class="card-body">
                <form id="hukdis_form">
                    <select class="input-mobile" id="select_kelas" name="select_kelas">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($list_kelas as $kelas)
                            <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                        @endforeach
                    </select>

                    <select class="input-mobile" id="select_nama" name="select_nama">
                        <option value="">-- Pilih Siswa --</option>
                    </select>

                    <select class="input-mobile" id="select_hukdis" name="select_hukdis">
                        <option value="">-- Pilih Pelanggaran --</option>
                        @foreach ($list_hukdis as $hukdis)
                            <option value="{{ $hukdis['id_hukdis'] }}">
                                {{ $hukdis['deskripsi'] }} ({{ $hukdis['poin'] }} Poin)
                            </option>
                        @endforeach
                    </select>

                    <div class="alert alert-danger print-error-msg" style="display:none; border-radius: 10px;">
                        <ul style="margin-bottom: 0; padding-left: 20px;"></ul>
                    </div>

                    <button type="submit" class="btn btn-primary btn-mobile" id="showbtn">Simpan Pelanggaran</button>
                    {{-- @if (auth()->user()->admin != 1)
                        <a href="{{ route('piket.index') }}" role="button" class="btn btn-dark btn-mobile">⬅ Kembali ke Beranda</a>
                    @endif --}}
                </form>
            </div>
        </div>

        <!-- Riwayat Hukdis -->
        <div class="card card-mobile">
            <div class="card-header">
                Riwayat Hukdis
            </div>
            <div class="card-body" style="padding: 15px; background: transparent;" id="history_container">
                <div class="text-center text-muted" style="padding: 20px;">
                    Pilih kelas dan siswa untuk melihat riwayat...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('hukdis.index') }}",
        };
    </script>

    <script src="{{ asset('js/hukdis.js') }}" defer></script>
@endsection
