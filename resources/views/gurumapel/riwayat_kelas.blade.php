@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">
    
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali ke Form Catatan</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px; border-left: 5px solid #17a2b8;">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">Riwayat Catatan Pembelajaran</h4>
                    <p class="mb-0 text-muted">
                        Kelas: <strong>{{ $penetapan->kelas->nama_kelas }}</strong> <br>
                        Mata Pelajaran: <strong>{{ $penetapan->mapel->nama_mapel }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white font-weight-bold">
                    Daftar Pertemuan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%">Tanggal Pertemuan</th>
                                    <th width="65%">Materi Pembelajaran</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $index => $row)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $row->materi_pembelajaran }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('gurumapel.edit_pertemuan', $row->id) }}" class="btn btn-warning btn-sm text-white mb-1">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-info btn-sm btn-detail mb-1" data-id="{{ $row->id }}">
                                                <i class="fa fa-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada riwayat pertemuan/catatan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Catatan -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Detail Catatan Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="35%">Nama Siswa</th>
                                <th width="65%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="detail_body">
                            <!-- Data dimuat via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.btn-detail').click(function() {
            var id_pertemuan = $(this).data('id');
            $('#detail_body').html('<tr><td colspan="2" class="text-center">Memuat data...</td></tr>');
            $('#detailModal').modal('show');

            $.ajax({
                url: "{{ url('gurumapel/pertemuan') }}/" + id_pertemuan + "/detail",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            var namaSiswa = item.siswa ? item.siswa.nama : 'N/A';
                            html += '<tr>';
                            html += '<td><strong>' + namaSiswa + '</strong></td>';
                            html += '<td>' + (item.catatan ? item.catatan.replace(/\n/g, "<br>") : '-') + '</td>';
                            html += '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="2" class="text-center">Tidak ada catatan untuk siswa pada pertemuan ini.</td></tr>';
                    }
                    $('#detail_body').html(html);
                },
                error: function() {
                    $('#detail_body').html('<tr><td colspan="2" class="text-center text-danger">Gagal memuat data.</td></tr>');
                }
            });
        });
    });
</script>
@endsection
