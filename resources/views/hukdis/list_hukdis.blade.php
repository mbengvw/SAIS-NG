@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Rekapitulasi Hukuman Disiplin Siswa
            </h2>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Parameter Filter Data
                    </div>
                    <div class="card-body">

                        <form id="hukdis_form">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm col-form-label">Tahun</label>
                                <div class="col-sm">
                                    <select class="form-control" id="select_tahun" name="select_tahun">
                                        <option value="">Semua</option>
                                        @for ($i = 2022; $i < 2030; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm col-form-label">Semester</label>
                                <div class="col-sm">
                                    <select class="form-control" id="select_semester" name="select_semester">
                                        <option value="">Semua</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm col-form-label">Kelas</label>
                                <div class="col-sm">
                                    <select class="form-control" id="select_kelas" name="select_kelas">
                                        <option value="">Semua</option>
                                        @foreach ($list_kelas as $kelas)
                                            <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputnama" class="col-sm col-form-label">Nama Siswa</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                            </div>

                            {{-- bagian pesan kesalahan validasi --}}
                            <div class="alert alert-danger print-error-msg" style="display:none;margin-top: 20px;">
                                <ul></ul>
                            </div>

                            <div class="form-group">
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-primary" id="showbtn">Tampilkan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        Riwayat Hukdis--
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered" id="tbl_hukdis">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Th. Akademik</th>
                                        <th>Smt.</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggaran</th>
                                        <th>Poin</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
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
        const app_path = {
            base_path: "{{ route('hukdisman.index') }}",
        };
    </script>

    <script src="{{ asset('js/hukdisman.js') }}" defer></script>
@endsection
