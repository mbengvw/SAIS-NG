@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Hukuman Disiplin Siswa
            </h2>
        </div>
        <div class="row justify-content-center">
            <p>
                Tahun Akademik : {{ $data_th_akademik->tahun }} / Semester : {{ $data_th_akademik->semester }}
            </p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Eksekusi Hukdis
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="select_kelas" name="select_kelas">
                                        <option value="">Semua</option>
                                        @foreach ($list_kelas as $kelas)
                                            <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputnama" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="select_nama" name="select_nama">
                                        <option value="">Pilih Siswa</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    Akumulasi Poin :
                                </div>
                                <div class="col-sm-1">
                                    70
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pelanggaran</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="select_hukdis" name="select_hukdis">
                                        <option value="">Pilih Pelanggaran</option>
                                        @foreach ($list_hukdis as $hukdis)
                                            <option value="{{ $hukdis['id_hukdi'] }}">
                                                {{ $hukdis['deskripsi'] }} -- Poin : {{ $hukdis['poin'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="showbtn">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Riwayat Hukdis
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered hukdis_datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Angkatan</th>
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
@endsection.

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('hukdis.index') }}",
        };
    </script>

    <script src="{{ asset('js/hukdis.js') }}" defer></script>
@endsection
