@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Pengelolaan Tahun Akademik
            </h2>
        </div>
        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record"
                class="btn btn-success">Tambah Tahun</button>
            <button style="margin-bottom: 10px;" type="button" class="exit btn btn-primary">Close</button>
        </div>
        <table class="table table-striped table-bordered tahun_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tahun</th>
                    <th>Semester</th>
                    <th>Alias Tahun</th>
                    <th>Status</th>
                    <th width="180px">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        const app_path = {
            dashboard_path: "{{ route('admin.dashboard') }}",
            base_path: "{{ route('tahun.index') }}",
        };
    </script>
    <script src="{{ asset('js/tahun.js') }}" defer></script>
@endsection
