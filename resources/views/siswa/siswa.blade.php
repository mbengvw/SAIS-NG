@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Data Siswa
            </h2>
        </div>

        <table class="table table-striped table-bordered students_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No. Daftar</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Angkatan</th>
                    <th>Jalur</th>
                    <th>Asal SLTP</th>
                    <th width="180px">Action</th>
                    <th width="50px"><button type="button" name="bulk_delete" id="bulk_delete"
                            class="btn btn-danger btn-xs">Delete</button></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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

    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_heading"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="student_form" name="student_form" class="form-horizontal"
                        method="POST">
                        <input type="hidden" name="id_siswa" id="id_siswa">
                        <input type="hidden" name="action" id="action" value="Add" />

                        <div class="form-group">
                            No. Daftar:<br>
                            <input type="text" class="form-control" id="no_daftar" name="no_daftar"
                                placeholder="Nomor Pendaftaran">
                        </div>
                        <div class="form-group">
                            No. Induk Sekolah:<br>
                            <input type="text" class="form-control" id="nis" name="nis"
                                placeholder="Nomor Induk Sekolah">
                        </div>
                        <div class="form-group">
                            NISN:<br>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                        </div>
                        <div class="form-group">
                            Nama:<br>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Nama Siswa">
                        </div>
                        <div class="form-group">
                            Jenis Kelamin:<br>
                            <input type="text" class="form-control" id="jk" name="jk"
                                placeholder="Jenis Kelamin">
                        </div>
                        <div class="form-group">
                            Angkatan:<br>
                            <input type="text" class="form-control" id="angkatan" name="angkatan"
                                placeholder="Angkatan">
                        </div>
                        <div class="form-group">
                            Jalur:<br>
                            <input type="text" class="form-control" id="jalur" name="jalur"
                                placeholder="Jalur Penerimaan">
                        </div>
                        <div class="form-group">
                            Asala SLTP:<br>
                            <input type="text" class="form-control" id="asal_sltp" name="asal_sltp"
                                placeholder="Asal SLTP">
                        </div>
                        <input type="submit" class="btn btn-primary" id="btn_simpan" name="btn_simpan" value="Simpan">

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@section('script')
    <script>
        const path = {
            base_path: "{{ route('siswa.index') }}",
            removeall_path: "{{ route('siswa.removeall') }}"
        };
    </script>
    <script src="{{ asset('js/studentsman.js') }}" defer></script>
@endsection
