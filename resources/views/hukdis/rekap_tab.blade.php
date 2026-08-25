@extends('main')

@section('content')
<style>
    /* Mobile-friendly table (Card Style) */
    @media screen and (max-width: 768px) {
        table.rekap_datatable thead {
            display: none !important; /* Hide header on mobile */
        }
        table.rekap_datatable, table.rekap_datatable tbody, table.rekap_datatable tr, table.rekap_datatable td {
            display: block;
            width: 100%;
        }
        table.rekap_datatable tr {
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 10px 15px;
        }
        table.rekap_datatable td {
            text-align: right;
            padding: 10px 0;
            padding-left: 40%;
            position: relative;
            border-bottom: 1px solid #f0f0f0 !important;
            border-top: none !important;
        }
        table.rekap_datatable td:last-child {
            border-bottom: none !important;
        }
        table.rekap_datatable td::before {
            position: absolute;
            left: 0;
            width: 35%;
            text-align: left;
            font-weight: 600;
            color: #555;
            white-space: nowrap;
        }
        
        /* Define column labels via CSS */
        table.rekap_datatable td:nth-child(1)::before { content: "No."; }
        table.rekap_datatable td:nth-child(2)::before { content: "NISN"; }
        table.rekap_datatable td:nth-child(3)::before { content: "Nama"; }
        table.rekap_datatable td:nth-child(4)::before { content: "Kelas"; }
        table.rekap_datatable td:nth-child(5)::before { content: "Total Kasus"; }
        table.rekap_datatable td:nth-child(6)::before { content: "Total Poin"; }
        table.rekap_datatable td:nth-child(6) { font-weight: bold; color: #dc3545; }
    }
    
    .nav-tabs .nav-link {
        font-weight: 600;
        color: #495057;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 12px 20px;
    }
    .nav-tabs .nav-link.active {
        color: #dc3545;
        background: transparent;
        border-bottom: 3px solid #dc3545;
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Pusat Laporan Pelanggaran Disiplin</h3>
            <h6 class="text-muted mb-0">Tahun Akademik {{ $data_tahun->tahun }}/{{$data_tahun->tahun+1}}</h6>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="laporanTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab-harian" data-toggle="tab" href="#content-harian" role="tab">Harian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-rentang" data-toggle="tab" href="#content-rentang" role="tab">Rentang Waktu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-semester" data-toggle="tab" href="#content-semester" role="tab">Per Semester</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-tahunan" data-toggle="tab" href="#content-tahunan" role="tab">Tahunan</a>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="laporanTabsContent">
        
        <!-- CONTENT HARIAN -->
        <div class="tab-pane fade show active" id="content-harian" role="tabpanel">
            <div class="card shadow-sm" style="border-radius: 15px; border-top: 4px solid #dc3545;">
                <div class="card-body">
                    <form id="filter_harian" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-muted small">Kelas</label>
                                <select name="id_kelas" class="form-control" id="harian_kelas">
                                    @if(auth()->user()->hasAnyRole(['admin', 'guru-piket']))
                                        <option value="">-- Semua Kelas --</option>
                                    @endif
                                    @foreach ($list_kelas as $kls)
                                        <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-muted small">Tanggal</label>
                                <input type="date" name="tanggal" id="harian_tanggal" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped rekap_datatable w-100" id="tbl_harian">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Total Kasus</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT RENTANG WAKTU -->
        <div class="tab-pane fade" id="content-rentang" role="tabpanel">
            <div class="card shadow-sm" style="border-radius: 15px; border-top: 4px solid #dc3545;">
                <div class="card-body">
                    <form id="filter_rentang" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-muted small">Kelas</label>
                                <select name="id_kelas" class="form-control" id="rentang_kelas">
                                    @if(auth()->user()->hasAnyRole(['admin', 'guru-piket']))
                                        <option value="">-- Semua Kelas --</option>
                                    @endif
                                    @foreach ($list_kelas as $kls)
                                        <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-muted small">Dari Tanggal</label>
                                <input type="date" name="start_date" id="rentang_start" class="form-control" value="{{ date('Y-m-01') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-muted small">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="rentang_end" class="form-control" value="{{ date('Y-m-t') }}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped rekap_datatable w-100" id="tbl_rentang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Total Kasus</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT SEMESTER -->
        <div class="tab-pane fade" id="content-semester" role="tabpanel">
            <div class="card shadow-sm" style="border-radius: 15px; border-top: 4px solid #dc3545;">
                <div class="card-body">
                    <form id="filter_semester" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-muted small">Kelas</label>
                                <select name="id_kelas" class="form-control" id="semester_kelas">
                                    @if(auth()->user()->hasAnyRole(['admin', 'guru-piket']))
                                        <option value="">-- Semua Kelas --</option>
                                    @endif
                                    @foreach ($list_kelas as $kls)
                                        <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-muted small">Semester</label>
                                <select name="semester" class="form-control" id="semester_val">
                                    <option value="1" {{ $data_tahun->semester == 1 ? 'selected' : '' }}>Ganjil (1)</option>
                                    <option value="2" {{ $data_tahun->semester == 2 ? 'selected' : '' }}>Genap (2)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped rekap_datatable w-100" id="tbl_semester">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Total Kasus</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT TAHUNAN -->
        <div class="tab-pane fade" id="content-tahunan" role="tabpanel">
            <div class="card shadow-sm" style="border-radius: 15px; border-top: 4px solid #dc3545;">
                <div class="card-body">
                    <form id="filter_tahunan" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-muted small">Kelas</label>
                                <select name="id_kelas" class="form-control" id="tahunan_kelas">
                                    @if(auth()->user()->hasAnyRole(['admin', 'guru-piket']))
                                        <option value="">-- Semua Kelas --</option>
                                    @endif
                                    @foreach ($list_kelas as $kls)
                                        <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped rekap_datatable w-100" id="tbl_tahunan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Total Kasus</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
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
        const path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/rekap_pelanggaran_tab.js') }}" defer></script>
@endsection
