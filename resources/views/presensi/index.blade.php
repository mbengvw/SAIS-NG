@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Kehadiran Harian Siswa
            </h2>
        </div>
        <div class="row justify-content-center">
            <p>
                Tahun Akademik : {{ $data_th_akademik->tahun }} / Semester : {{ $data_th_akademik->semester }}
                <input type="text" id="tahun_aktif" value="{{ $data_th_akademik->tahun }}" hidden>
                <input type="text" id="semester" value="{{ $data_th_akademik->semester }}" hidden>
            </p>
        </div>

        <div class="row justify-content-center">
            <p>
                Tanggal : {{ $tanggal }}
            </p>
        </div>
        <div class="row">
            <div class="col">
                Kelas :
                <select id="select_kelas" name="select_kelas" style="margin-bottom: 20px;">
                    <option value="">Pilih Kelas</option>
                    @foreach ($list_kelas as $kelas)
                        <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Siswa - Kelas
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper" style="overflow-x:auto;">
                            <table class="table table-striped table-bordered" id="tbl_kehadiran">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Sakit</th>
                                        <th>Izin</th>
                                        <th>Alfa</th>
                                        <th>Ket.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('piket.index') }}" role="button" class="btn btn-primary" style="margin-top: 20px;">Home</a>
                </div>
            </div>
        </div>
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
