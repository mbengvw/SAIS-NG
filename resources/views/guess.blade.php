@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2>
                Selamat Datang {{ auth()->user()->name }}
            </h2>
        </div>
        <div class="row justify-content-center">
            <h4>
                Tahun Akademik Aktif saat ini: {{ $tahun }}
            </h4>
        </div>
    </div>
@endsection

@section('script')
@endsection
