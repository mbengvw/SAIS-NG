@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Rekap Presensi Siswa
            </h2>
        </div>
        <div class="row justify-content-center">
            <h4>Tahun Akademik {{ $data_tahun->tahun }}/{{$data_tahun->tahun+1}} - Semester {{ $data_tahun->semester }}</h4>
        </div>
        <div style="width: max-content;margin-bottom: 20px;margin-top: 20px;">
            <select class="form-control" id="select_kelas" name="select_kelas">
                <option value="">Pilih Kelas</option>
                @foreach ($list_kelas as $kelas)
                    <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                @endforeach
            </select>
        </div>

        <table class="table table-striped table-bordered rekap_datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Th. Akademik</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alfa</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        const app_path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/rekap_bulanan.js') }}" defer></script>
@endsection
