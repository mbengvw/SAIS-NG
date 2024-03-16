@extends('main')

@section('content')
    <div class="container-fluid">
        <div style="padding: 50px 0px;">
            <div class="row justify-content-center">
                <h2>
                    Selamat Datang {{ $nama }}
                </h2>
            </div>
            <div class="row justify-content-center">
                <h4>
                    Tahun Akademik Aktif :{{ $tahun }}
                </h4>
            </div>
        </div>
<hr>
        <div class="text-center">
            <a href="{{ route('presensi.index') }}" role="button" class="btn btn-primary"
                style="border-radius: 20px;padding: 20px 30px;margin: 10px;"><strong> ABSENSI HARIAN </strong></a>
            <a href="{{ route('presensi.show_all') }}" role="button" class="btn btn-primary"
                style="border-radius: 20px;padding: 20px 30px;margin: 10px;"><strong> LIHAT </strong></a>
        </div>
        <hr>
        <div class="text-center">
            <a href="{{ route('hukdis.index') }}" role="button" class="btn btn-danger"
                style="border-radius: 20px;padding: 20px 30px;margin: 10px;"><strong> PELANGGARAN DISIPLIN </strong></a>
            <a href="{{ route('presensi.show_all') }}" role="button" class="btn btn-danger"
                style="border-radius: 20px;padding: 20px 30px;margin: 10px;"><strong> LIHAT </strong></a>
        </div>
    </div>
@endsection

@section('script')
@endsection
