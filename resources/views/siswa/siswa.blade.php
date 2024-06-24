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
                    {{-- <th>NIK</th> --}}
                    <th>Tahun Masuk</th>
                    <th>Tempat Lahir</th>
                    <th>Tgl. Lahir</th>
                    <th>Status</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                    {{-- <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Nama Wali</th> --}}
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
                            <select class="form-control select2" name="jk" id="jk">
                                <option value="" selected>Pilih</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>

                        </div>
                        <div class="form-group">
                            Angkatan:<br>
                            <input type="text" class="form-control" id="angkatan" name="angkatan"
                                placeholder="Angkatan">
                        </div>
                        <div class="form-group">
                            Jalur:<br>
                            <select class="form-control select2" name="jalur" id="jalur">
                                <option value="" selected>Pilih</option>
                                <option value="PRESTASI">PRESTASI</option>
                                <option value="REGULER">REGULER</option>
                                <option value="PINDAHAN">PINDAHAN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Asala SLTP:<br>
                            <input type="text" class="form-control" id="asal_sltp" name="asal_sltp"
                                placeholder="Asal SLTP">
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif

                        <input type="submit" class="btn btn-primary" id="btn_simpan" name="btn_simpan" value="Simpan">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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
