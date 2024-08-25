@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Daftar Siswa MAN 2 KUNINGAN
            </h2>
        </div>
        <table class="table table-striped table-bordered students_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Tahun Masuk</th>
                    <th>Tempat Lahir</th>
                    <th>Tgl. Lahir</th>
                    <th>Status</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                    <th width="180px">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="row text-center" style="margin-bottom: 20px">
        <div class="col-sm-10">
            @if (auth()->user()->piket == 1)
                <a href="{{ route('piket.index') }}" role="button" class="btn btn-warning">Home</a>
            @endif
        </div>
    </div>

    {{-- MODAL TAMBAH/EDIT --}}

    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_heading"></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">

                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td id="detail_nama">Otto</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td id="detail_tempat"></td>
                            </tr>
                            <tr>
                                <td>Tgl. Lahir</td>
                                <td id="detail_tgl"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td id="detail_alamat"></td>
                            </tr>
                            <tr>
                                <td>Tahun Masuk</td>
                                <td id="detail_tahun_masuk"></td>
                            </tr>
                            <tr>
                                <td>NISN</td>
                                <td id="detail_nisn"></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td id="detail_kelas">Kelas</td>
                            </tr>
                        </tbody>

                    </table>
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
    <script src="{{ asset('js/students.js') }}" defer></script>
@endsection
