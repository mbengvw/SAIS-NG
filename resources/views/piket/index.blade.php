@extends('main')

@section('content')
    <div class="container-fluid">
        <div style="padding: 50px 0px;">
            <div class="row justify-content-center">
                <h2>
                    Hai {{ $nama }}...wilujeng sumping<br>
                </h2>
            </div>
            <div class="row justify-content-center">

                <h4>
                    Tahun Akademik Aktif :{{ $tahun }}
                </h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('presensi.index') }}">
                        <img src="{{ asset('images/legalisir.png') }}" class="rounded-circle" style="max-width: 200px;">
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('presensi.show_all') }}">
                        <img src="{{ asset('images/absen.png') }}" class="rounded-circle" style="max-width: 200px;">
                    </a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('presensi.index') }}"><strong> Absensi Harian Siswa </strong></a>
                </div>
            </div>
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('presensi.show_all') }}"><strong> Lihat Data Kehadiran</strong></a>
                </div>
            </div>

        </div>


        <div class="row" style="margin-top: 100px">
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('piket.list-students') }}">
                        <img src="{{ asset('images/peoples.png') }}" class="rounded-circle" style="max-width: 200px;">
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('piket.hukdis') }}">
                        <img src="{{ asset('images/hukdis.png') }}" class="rounded-circle" style="max-width: 200px;">
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('piket.list-students') }}"><strong> Daftar Siswa </strong></a>
                </div>
            </div>
            <div class="col-sm">
                <div class="text-center">
                    <a href="{{ route('piket.hukdis') }}"><strong> Hukuman Disiplin </strong></a>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('script')
@endsection
