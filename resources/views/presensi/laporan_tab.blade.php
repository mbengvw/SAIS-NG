@extends('main')

@section('content')
<style>
    /* Tab Styling */
    .nav-tabs .nav-link {
        border-radius: 10px;
        margin-right: 5px;
        color: #555;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 12px 20px;
    }
    .nav-tabs .nav-link.active {
        background-color: transparent;
        color: #007bff;
        border-bottom: 3px solid #007bff;
    }
    .nav-tabs .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
        color: #007bff;
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 20px;
    }

    /* Sembunyikan kolom "No." di device kecil untuk menghemat ruang */
    @media screen and (max-width: 768px) {
        .table th:first-child,
        .table td:first-child {
            display: none !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Pusat Laporan Presensi</h3>
            <h6 class="text-muted mb-0">Tahun Akademik {{ $data_tahun->tahun }}/{{$data_tahun->tahun+1}}</h6>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="laporanTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab-harian" data-toggle="tab" href="#content-harian" role="tab">Harian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-bulanan" data-toggle="tab" href="#content-bulanan" role="tab">Bulanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-rentang" data-toggle="tab" href="#content-rentang" role="tab">Rentang Waktu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-semester" data-toggle="tab" href="#content-semester" role="tab">Per Semester</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-tahunan" data-toggle="tab" href="#content-tahunan" role="tab">Per Tahun</a>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="laporanTabsContent">
        
        <!-- ================= TAB HARIAN ================= -->
        <div class="tab-pane fade show active" id="content-harian" role="tabpanel">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Harian</div>
                <div class="card-body">
                    <form id="form-harian">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <input type="text" class="form-control tanggal" name="tanggal" placeholder="Tanggal" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Siswa (Opsional)">
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-0 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" id="tbl_kehadiran">
                            <thead>
                                <tr><th>No.</th><th>Nama</th><th>Status</th><th>JK</th><th>Kelas</th><th>Tanggal</th></tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= TAB BULANAN ================= -->
        <div class="tab-pane fade" id="content-bulanan" role="tabpanel">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Bulanan</div>
                <div class="card-body">
                    <form id="form-bulanan">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="bulan" required>
                                    <option value="">Pilih Bulan</option>
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 10)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-12 mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-2 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover rekap_datatable" id="tbl_bulanan" style="width: 100%;">
                            <thead><tr><th style="width: 5%;">No.</th><th>Siswa</th><th style="width: 15%;">Sakit</th><th style="width: 15%;">Izin</th><th style="width: 15%;">Alfa</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= TAB RENTANG WAKTU ================= -->
        <div class="tab-pane fade" id="content-rentang" role="tabpanel">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Rentang Waktu</div>
                <div class="card-body">
                    <form id="form-rentang">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <input type="text" class="form-control tanggal" name="start_date" placeholder="Dari Tanggal" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <input type="text" class="form-control tanggal" name="end_date" placeholder="Sampai Tanggal" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-2 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover rekap_datatable" id="tbl_rentang" style="width: 100%;">
                            <thead><tr><th style="width: 5%;">No.</th><th>Siswa</th><th style="width: 15%;">Sakit</th><th style="width: 15%;">Izin</th><th style="width: 15%;">Alfa</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= TAB SEMESTER ================= -->
        <div class="tab-pane fade" id="content-semester" role="tabpanel">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Per Semester</div>
                <div class="card-body">
                    <form id="form-semester">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2022; $i < 2030; $i++)
                                        <option value="{{ $i }}" {{ $data_tahun->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="semester" required>
                                    <option value="">Pilih Semester</option>
                                    <option value="1" {{ $data_tahun->semester == 1 ? 'selected' : '' }}>Ganjil</option>
                                    <option value="2" {{ $data_tahun->semester == 2 ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-2 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover rekap_datatable" id="tbl_semester" style="width: 100%;">
                            <thead><tr><th style="width: 5%;">No.</th><th>Siswa</th><th style="width: 15%;">Sakit</th><th style="width: 15%;">Izin</th><th style="width: 15%;">Alfa</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= TAB TAHUNAN ================= -->
        <div class="tab-pane fade" id="content-tahunan" role="tabpanel">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Per Tahun</div>
                <div class="card-body">
                    <form id="form-tahunan">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                <select class="form-control" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2022; $i < 2030; $i++)
                                        <option value="{{ $i }}" {{ $data_tahun->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-12 mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-2 p-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover rekap_datatable" id="tbl_tahunan" style="width: 100%;">
                            <thead><tr><th style="width: 5%;">No.</th><th>Siswa</th><th style="width: 15%;">Sakit</th><th style="width: 15%;">Izin</th><th style="width: 15%;">Alfa</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    <script>
        $('.tanggal').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            selectOtherYears: true,
            dateFormat: 'yy-mm-dd',
        });

        const app_path = {
            ajax: "{{ url('ajax') }}",
            harian: "{{ route('presensi.all') }}", // PresensiController@ajax_list_by
        };
    </script>
    <script src="{{ asset('js/laporan_tab.js') }}" defer></script>
@endsection
