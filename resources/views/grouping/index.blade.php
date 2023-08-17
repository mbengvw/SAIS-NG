@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Grouping / Pengkelasan
            </h2>
        </div>
        <div class="row justify-content-center">
            <p>
                Tahun Akademik : {{ $data_th_akademik->tahun }} / Semester : {{ $data_th_akademik->semester }}
                <input type="text" id="tahun_aktif" value="{{ $data_th_akademik->tahun }}" hidden>
                <input type="text" id="semester" value="{{ $data_th_akademik->semester }}" hidden>
            </p>
        </div>
        <div class="row">
            <div class="col" style="margin-bottom: 20px;">
                Kelas :
                <select id="select_kelas" name="select_kelas">
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
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        Siswa - Kelas
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tbl_grouping">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Angkatan</th>
                                        <th>Kelas..</th>
                                        <th width="180px">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Daftar Siswa
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered students_datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Angkatan</th>
                                        <th width="50px"><button type="button" value="test" name="bulk_pilih"
                                                id="bulk_pilih" class="btn btn-danger btn-xs">Kelaskan</button></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('grouping.index') }}",
        };
    </script>

    <script src="{{ asset('js/grouping.js') }}" defer></script>
@endsection
