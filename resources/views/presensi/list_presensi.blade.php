@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;margin-bottom: 30px;">
            <h2>
                Kehadiran Harian Siswa
            </h2>
        </div>
        <div class="card" style="margin-bottom: 20px">
            <div class="card-header">
                Filter Data
            </div>
            <div class="card-body">
                <form>
                    <div class="row" style="padding-bottom: 20px">
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col">
                                    <select class="form-control" id="select_kelas" name="select_kelas">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($list_kelas as $kelas)
                                            <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="select_tahun" name="select_tahun">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = 2022; $i < 2030; $i++)
                                            @if ($data_tahun->tahun == $i)
                                                <option value={{ $i }} selected>{{ $i }}</option>
                                            @else
                                                <option value={{ $i }}>{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="select_semester" name="select_semester">
                                        <option value="">Pilih Semester</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control tanggal" name="tanggal" id="tanggal"
                                        placeholder="Tanggal">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Siswa">
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" id="showbtn" style="margin-right:50px;">Show
                                Data</button>
                            <a href="{{ route('piket.index') }}" role="button" class="btn btn-warning">Home</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
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
