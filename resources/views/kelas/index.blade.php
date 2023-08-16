@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Master Data Kelas
            </h2>
        </div>
        <div class="row justify-content-center">
            <p>
                Tahun Akademik : {{ $tahun }} / Semester : {{ $semester }}
            </p>
        </div>

        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record"
                class="btn btn-success">Tambah Kelas</button>
            <button style="margin-bottom: 10px;" type="button" class="exit btn btn-primary">Close</button>
        </div>
        <div class="table-wrapper" style="overflow-x:auto;">
            <table class="table table-striped table-bordered kelas_datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jurusan</th>
                        <th>Tingkat</th>
                        <th>Paralel</th>
                        <th>Nama Kelas</th>
                        <th width="180px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- Modal Tambah Kelas --}}
    @include('modals.add_edit_kelas')
@endsection

@section('script')
    <script>
        const app_path = {
            dashboard_path: "{{ route('admin.dashboard') }}",
            base_path: "{{ route('kelas.index') }}",
        };
    </script>
    <script src="{{ asset('js/kelas.js') }}" defer></script>
@endsection
