@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Rekap Presensi Siswa
            </h2>
        </div>
        <div class="card" style="margin-bottom: 20px">
            <div class="card-header">
                Filter Data
            </div>
            <div class="card-body">
                <form action="" id="frm_bulanan">
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
                                    <select class="form-control" id="select_bulan" name="select_bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" id="show_btn" style="margin-right:50px;">Show Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped table-bordered rekap_datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Th. Akademik</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alfa</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        const app_path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/rekap_bulanan.js') }}" defer></script>
@endsection
