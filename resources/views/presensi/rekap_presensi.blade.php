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
        table.rekap_datatable td:nth-child(2)::before { content: "Siswa"; }
        table.rekap_datatable td:nth-child(3)::before { content: "Sakit"; }
        table.rekap_datatable td:nth-child(4)::before { content: "Izin"; }
        table.rekap_datatable td:nth-child(5)::before { content: "Alfa"; }
    }
</style>

    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
            <div class="col-12 text-center">
                <h3 class="font-weight-bold mb-1">Rekap Presensi Siswa</h3>
                <h6 class="text-muted mb-0">Tahun Akademik {{ $data_tahun->tahun }}/{{$data_tahun->tahun+1}} - Semester {{ $data_tahun->semester }}</h6>
            </div>
        </div>
        
        <div class="card shadow-sm" style="margin-bottom: 20px; border-radius: 15px;">
            <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                Filter Data
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12 mb-3">
                        <select class="form-control" id="select_kelas" name="select_kelas">
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12 col-12 d-flex align-items-center">
                        @if (auth()->user()->piket == 1)
                            <a href="{{ route('piket.index') }}" role="button" class="btn btn-warning px-4 shadow-sm">
                                <i class="fa fa-home"></i> Home
                            </a>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                        Data Rekap
                    </div>
                    <div class="card-body p-2 p-md-3">
                        <div class="table-responsive" style="border: none;">
                            <table class="table table-striped table-hover rekap_datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th>Siswa</th>
                                        <th style="width: 15%;">Sakit</th>
                                        <th style="width: 15%;">Izin</th>
                                        <th style="width: 15%;">Alfa</th>
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
        const app_path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/rekap_presensi.js') }}" defer></script>
@endsection
