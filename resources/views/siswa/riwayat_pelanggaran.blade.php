@extends('main')

@section('content')
    <div>
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="h3 mb-0 font-weight-bold text-dark">Riwayat Pelanggaran: {{ $siswa->nama }}</h2>
                <p class="text-muted mb-0">NISN: {{ $siswa->nisn }}</p>
            </div>
            <div class="col text-right">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali ke Data Siswa</a>
            </div>
        </div>
        
        <div class="card card-sbi">
            <div class="card-body">
                <table class="table table-striped table-bordered pelanggaran_datatable">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Tanggal</th>
                            <th>Semester</th>
                            <th>Deskripsi Pelanggaran</th>
                            <th>Poin</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('.pelanggaran_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siswa.riwayat_pelanggaran', $siswa->id) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'semester', name: 'semester'},
                    {data: 'deskripsi', name: 'deskripsi'},
                    {data: 'poin', name: 'poin'},
                    {data: 'petugas', name: 'petugas', defaultContent: '-'},
                ]
            });
        });
    </script>
@endsection
