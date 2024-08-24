@extends('main')

@section('content')
    <div class="container-fluid">
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
@endsection

@section('script')
@endsection
