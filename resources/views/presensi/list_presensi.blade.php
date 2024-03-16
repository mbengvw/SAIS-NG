@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;margin-bottom: 30px;">
            <h2>
                Kehadiran Harian Siswa
            </h2>
        </div>

        <div class="row">
            <div class="col-sm-4" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h4>Parameter Filter</h4>
                    </div>
                    <div class="card-body">
                        <form>
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
                                <label for="inputEmail3" class="col-sm col-form-label">Tahun</label>
                                <div class="col-sm">
                                    <select class="form-control" id="select_tahun" name="select_tahun">
                                        <option value="">Semua</option>
                                        @for ($i = 2022; $i < 2030; $i++)
                                            <option value={{ $i }}>{{ $i }}
                                                @if ($data_tahun->tahun == $i)
                                                    selected
                                                @endif
                                            </option>
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
                                <label for="inputTanggal" class="col-sm col-form-label">Tanggal</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control tanggal" name="tanggal" id="tanggal">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputnama" class="col-sm col-form-label">Nama Siswa</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="showbtn" style="margin-right:50px;">Show Data</button>
                                    <a href="{{ route('piket.index') }}" role="button" class="btn btn-warning">Home</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        Data Kehadiran
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tbl_kehadiran">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Tanggal</th>
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
@endsection

@section('script')
    <script>
        $('.tanggal').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            selectOtherYears: true,
            dateFormat: 'yy-mm-dd',
        });
    </script>
    <script>
        const app_path = {
            base_path: "{{ route('presensi.index') }}",
        };
    </script>

    <script src="{{ asset('js/attendanceman.js') }}" defer></script>
@endsection
