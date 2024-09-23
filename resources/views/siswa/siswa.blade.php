@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Data Siswa
            </h2>
        </div>
        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record"
                class="btn btn-success">Tambah Siswa</button>
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
                    <th width="50px"><button type="button" name="bulk_delete" id="bulk_delete"
                            class="btn btn-danger btn-xs">Delete</button></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
                    <form action="javascript:void(0)" id="student_form" name="student_form" class="form-horizontal"
                        method="POST">
                        <input type="hidden" name="id_siswa" id="id_siswa">
                        <input type="hidden" name="status" id="status" value="A">
                        <input type="hidden" name="action" id="action" value="Add" />

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_siswa" name="nama"
                                placeholder="Nama Siswa">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nisn" name="nisn"
                                placeholder="Nomor Induk Nasional">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk"
                                placeholder="Tahun Masuk">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                placeholder="Tempat Lahir">
                        </div>
                        <div class="form-group">
                            Tgl. Lahir <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                data-date-format="YYYY/MM/DD">
                        </div>

                        <div class="form-group">
                            <textarea id="alamat" name="alamat" rows="4" cols="50" placeholder="Alamat Siswa"></textarea>
                        </div>

                        <div class="form-group">
                            <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamink">
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                placeholder="Nama Ayah">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                placeholder="Nama Ibu">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                placeholder="Nama Wali">
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary" id="btn_simpan" name="btn_simpan"
                                value="Simpan">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
