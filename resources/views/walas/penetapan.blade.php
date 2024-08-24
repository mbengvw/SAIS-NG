@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Penatapan Wali Kelas
            </h2>
        </div>
        <div class="row justify-content-center">
            <p>
                Tahun Akademik : {{ $tahun }} / Semester : {{ $semester }}
            </p>
        </div>

        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record"
                class="btn btn-success">Tambah Data</button>
        </div>
        <div class="table-wrapper" style="overflow-x:auto;">
            <table class="table table-striped table-bordered walas_datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kelas</th>
                        <th>Walikelas</th>
                        <th>Tahun</th>
                        <th width="180px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- Modal Tambah Data --}}
    @include('modals.add_edit_walas')
@endsection

@section('script')
    <script>
        const app_path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/penetapan_walas.js') }}" defer></script>
@endsection
