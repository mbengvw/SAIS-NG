@extends('main')

@section('content')
<style>
    /* Mobile-friendly table (Card Style) */
    @media screen and (max-width: 768px) {
        #tbl_kehadiran thead {
            display: none; /* Hide header on mobile */
        }
        #tbl_kehadiran, #tbl_kehadiran tbody, #tbl_kehadiran tr, #tbl_kehadiran td {
            display: block;
            width: 100%;
        }
        #tbl_kehadiran tr {
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 10px 15px;
        }
        #tbl_kehadiran td {
            text-align: right;
            padding: 10px 0;
            padding-left: 45%;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
            border-top: none !important;
        }
        #tbl_kehadiran td:last-child {
            border-bottom: none;
        }
        #tbl_kehadiran td::before {
            position: absolute;
            left: 0;
            width: 40%;
            text-align: left;
            font-weight: 600;
            color: #555;
            white-space: nowrap;
        }
        
        /* Define column labels via CSS */
        #tbl_kehadiran td:nth-child(1)::before { content: "No."; }
        #tbl_kehadiran td:nth-child(2)::before { content: "Nama"; }
        #tbl_kehadiran td:nth-child(3)::before { content: "JK"; }
        #tbl_kehadiran td:nth-child(4)::before { content: "Tanggal"; }
        #tbl_kehadiran td:nth-child(5)::before { content: "Kelas"; }
        #tbl_kehadiran td:nth-child(6)::before { content: "Status"; }

        /* Highlight status differently on mobile */
        #tbl_kehadiran td:nth-child(6) {
            font-weight: bold;
            color: #007bff;
        }
    }
</style>

    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
            <h3 class="text-center">
                Kehadiran Harian Siswa
            </h3>
        </div>
        <div class="card shadow-sm" style="margin-bottom: 20px; border-radius: 15px;">
            <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                Filter Data
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <select class="form-control" id="select_kelas" name="select_kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($list_kelas as $kelas)
                                    <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <select class="form-control" id="select_tahun" name="select_tahun">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2022; $i < 2030; $i++)
                                    @if ($data_tahun->tahun == $i)
                                        <option value={{ $i }} selected>{{ $i }}</option>
                                    @else
                                        <option value={{ $i }}>{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <select class="form-control" id="select_semester" name="select_semester">
                                <option value="">Pilih Semester</option>
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <input type="text" class="form-control tanggal" name="tanggal" id="tanggal"
                                placeholder="Tanggal">
                        </div>
                        <div class="col-md-6 col-sm-12 col-12 mb-3">
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Nama Siswa">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center text-md-left">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm" id="showbtn" style="margin-right:10px;">
                                <i class="fa fa-search"></i> Tampilkan
                            </button>
                            @if (auth()->user()->piket == 1)
                                <a href="{{ route('piket.index') }}" role="button" class="btn btn-warning px-4 shadow-sm">
                                    <i class="fa fa-home"></i> Home
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                        Data Kehadiran
                    </div>
                    <div class="card-body p-0 p-md-3">
                        <div class="table-responsive" style="border: none;">
                            <table class="table table-striped table-hover mb-0" id="tbl_kehadiran">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Tanggal</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
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
        $('.tanggal').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            selectOtherYears: true,
            dateFormat: 'yy-mm-dd',
        });
    </script>
    <script>
        const app_path = {
            base_path: "{{ route('presensi.index') }}",
        };
    </script>

    <script src="{{ asset('js/attendanceman.js') }}" defer></script>
@endsection
