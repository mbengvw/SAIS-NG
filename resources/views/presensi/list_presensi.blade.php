@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                List Kehadiran Siswa
            </h2>
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tbl_kehadiran">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Kelas</th>
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
            </div>
        </div>
    </div>
@endsection.

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('presensi.index') }}",
        };
    </script>

    <script src="{{ asset('js/attendance.js') }}" defer></script>
@endsection
