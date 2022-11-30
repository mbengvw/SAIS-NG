@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Kehadiran Harian Siswa
            </h2>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Parameter Filter</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="select_kelas" name="select_kelas"
                                        style="margin-bottom: 20px;">
                                        <option value="">Semua</option>
                                        @foreach ($list_kelas as $kelas)
                                            <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="select_kelas" name="select_kelas"
                                        style="margin-bottom: 20px;">
                                        <option value="">Semua</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="select_kelas" name="select_kelas"
                                        style="margin-bottom: 20px;">
                                        <option value="">Semua</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Show Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

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
                                        <th>Status</th>
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
