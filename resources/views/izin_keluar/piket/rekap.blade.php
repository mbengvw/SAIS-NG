@extends('main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Rekap Riwayat Izin Keluar</h3>
            <h6 class="text-muted mb-0">Tahun Akademik {{ $data_tahun->tahun }}/{{$data_tahun->tahun+1}}</h6>
        </div>
    </div>

    <div class="card shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">Filter Laporan</div>
        <div class="card-body">
            <form id="form-filter">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-3">
                        <label>Kelas</label>
                        <select class="form-control" name="id_kelas" id="id_kelas">
                            <option value="">Semua Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas['id_kelas'] }}">{{ $kelas['nama_kelas'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-12 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0 p-md-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0" id="tbl_rekap">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Siswa / Kelas</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Guru Pemberi Izin</th>
                            <th>Keluar</th>
                            <th>Kembali</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var table = $('#tbl_rekap').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('piket.izin_keluar.rekap.data') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.id_kelas = $('#id_kelas').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal' },
                { 
                    data: 'siswa.nama', 
                    name: 'siswa.nama',
                    render: function(data, type, row) {
                        let kelas = row.kelas ? row.kelas.nama_kelas : '-';
                        return '<b>' + (data ? data : '-') + '</b><br><small>' + kelas + '</small>';
                    }
                },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'alasan', name: 'alasan' },
                { data: 'guru_pemberi.name', name: 'guruPemberi.name', defaultContent: '-' },
                { data: 'waktu_keluar_formatted', name: 'waktu_keluar', orderable: false, searchable: false },
                { data: 'waktu_kembali_formatted', name: 'waktu_kembali', orderable: false, searchable: false }
            ],
            order: [[1, 'desc']],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });

        $('#form-filter').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });
    });
</script>
@endsection
