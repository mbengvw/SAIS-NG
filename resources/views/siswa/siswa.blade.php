@extends('main')

@section('content')
    <div>
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="h3 mb-0 font-weight-bold text-dark">Data Siswa</h2>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-sbi">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3 gap-2">
                    <button type="button" id="btn-generate-accounts" class="btn btn-success btn-sm"><i class="fa fa-users"></i> Generate Akun Siswa</button>
                    <a href="{{ route('siswa.download_template') }}" class="btn btn-info btn-sm">Download Template CSV</a>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#uploadCsvModal">Upload CSV</button>
                    <button type="button" name="create_record" id="create_record" class="btn btn-primary-sbi btn-sm">Tambah Siswa</button>
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
    </div>
    {{-- MODAL UPLOAD CSV --}}
    <div class="modal fade" id="uploadCsvModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Data Siswa (CSV)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.upload_csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="csv_file">Pilih file CSV</label>
                            <input type="file" class="form-control" name="csv_file" id="csv_file" required accept=".csv">
                            <small class="form-text text-muted">Pastikan format kolom sesuai dengan template yang disediakan. Gunakan NISN sebagai unik ID (update data jika NISN sudah ada).</small>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
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
                        method="POST" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="foto">Foto Siswa</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <img id="preview_foto" src="" style="width: 100px; display: none; margin-top: 10px;">
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
                    removeall_path: "{{ route('siswa.removeall') }}",
                    generate_accounts_path: "{{ route('siswa.generate-accounts') }}"
                };
            </script>
            <script src="{{ asset('js/studentsman.js') }}" defer></script>
        @endsection
