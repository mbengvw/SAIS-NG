@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">

    {{-- Navigasi Atas --}}
    <div class="row mb-3">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-2">
                <a href="{{ route('gurumapel.nilai.index', $penetapan->id) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-graduation-cap"></i> Penilaian Siswa
                </a>
            </div>
            <div class="mb-2">
                <a href="{{ route('gurumapel.create_catatan', $penetapan->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Catatan
                </a>
            </div>
        </div>
    </div>

    {{-- Banner Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 14px; background: linear-gradient(135deg, #0891b2 0%, #0ea5e9 60%, #38bdf8 100%); box-shadow: 0 8px 30px rgba(8, 145, 178, 0.35);">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="badge px-3 py-1 mb-2 font-weight-bold" style="font-size: 0.8rem; background-color: rgba(255,255,255,0.2); color:#fff; border-radius: 20px; letter-spacing: 0.5px;">
                                <i class="fa fa-book mr-1"></i> JURNAL PEMBELAJARAN
                            </span>
                            <h4 class="font-weight-bold mb-1" style="color:#fff;">
                                Kelas {{ $penetapan->kelas->nama_kelas }}
                            </h4>
                            <p class="mb-0" style="font-size: 0.95rem; color: rgba(255,255,255,0.85);">
                                Mata Pelajaran: <strong style="color:#fff;">{{ $penetapan->mapel->nama_mapel }}</strong>
                            </p>
                        </div>
                        <div class="text-right mt-2 mt-md-0">
                            <div style="background: rgba(255,255,255,0.18); border-radius: 10px; padding: 10px 16px; display: inline-block;">
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px;">TOTAL PERTEMUAN</div>
                                <div style="color:#fff; font-size: 1.8rem; font-weight: 800; line-height: 1;">{{ count($riwayat) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Daftar Pertemuan --}}
    <div class="row">
        <div class="col-12">
            @forelse($riwayat as $index => $row)
                <div class="card border-0 mb-3 pertemuan-card"
                     style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.09); border-left: 4px solid #0ea5e9 !important; transition: transform 0.22s ease, box-shadow 0.22s ease; background: #ffffff;">
                    <div class="card-body" style="padding: 1.2rem 1.4rem;">
                        <div class="row align-items-start">

                            {{-- Nomor + tanggal + materi --}}
                            <div class="col-12 col-md-8 d-flex align-items-start mb-3 mb-md-0" style="gap: 12px;">
                                <div class="flex-shrink-0" style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #0891b2, #38bdf8); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.9rem;">
                                    {{ $index + 1 }}
                                </div>
                                <div style="min-width: 0; flex: 1;">
                                    <span class="badge font-weight-bold mb-2 d-inline-block" style="background: #e0f2fe; color: #0891b2; border-radius: 8px; font-size: 0.78rem; padding: 4px 10px;">
                                        <i class="fa fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                    <div class="text-dark" style="font-size: 0.9rem; line-height: 1.6; overflow-wrap: break-word; word-break: break-word;">
                                        {!! $row->materi_pembelajaran !!}
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="col-12 col-md-4 d-flex flex-wrap align-items-center justify-content-md-end" style="gap: 6px;">
                                <button type="button" class="btn btn-sm btn-detail font-weight-bold"
                                        data-id="{{ $row->id }}"
                                        style="background: #e0f2fe; color: #0891b2; border: none; border-radius: 50px; padding: 6px 14px;">
                                    <i class="fa fa-eye mr-1"></i> Detail
                                </button>
                                <a href="{{ route('gurumapel.edit_pertemuan', $row->id) }}"
                                   class="btn btn-sm font-weight-bold"
                                   style="background: #fef3c7; color: #b45309; border: none; border-radius: 50px; padding: 6px 14px;">
                                    <i class="fa fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('gurumapel.destroy_pertemuan', $row->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus catatan pertemuan ini? Seluruh catatan siswa ikut terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm font-weight-bold"
                                            style="background: #fee2e2; color: #b91c1c; border: none; border-radius: 50px; padding: 6px 14px;">
                                        <i class="fa fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="card border-0 text-center" style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.08);">
                    <div class="card-body p-5">
                        <i class="fa fa-book text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h5 class="font-weight-bold text-dark">Belum Ada Catatan Pertemuan</h5>
                        <p class="text-muted mb-4" style="max-width: 420px; margin: 0 auto;">
                            Mulai dokumentasikan setiap pertemuan kelas dengan klik tombol di bawah ini.
                        </p>
                        <a href="{{ route('gurumapel.create_catatan', $penetapan->id) }}" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 50px;">
                            <i class="fa fa-plus-circle mr-1"></i> Tambah Catatan Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</div>

{{-- Modal Detail Catatan Siswa --}}
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 14px;">
            <div class="modal-header border-0 px-4 pt-4 pb-3" style="background: linear-gradient(135deg, #0891b2, #0ea5e9); border-radius: 14px 14px 0 0;">
                <h5 class="modal-title font-weight-bold" style="color: #fff;">
                    <i class="fa fa-users mr-2"></i> Detail Catatan Siswa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.85;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 0.9rem;">
                        <thead class="bg-light font-weight-bold text-dark" style="font-size: 0.82rem;">
                            <tr>
                                <th class="px-4 py-3" width="35%">Nama Siswa</th>
                                <th class="py-3" width="15%">Kehadiran</th>
                                <th class="py-3" width="50%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="detail_body">
                            <tr><td colspan="3" class="text-center py-4 text-muted">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary font-weight-bold px-4" data-dismiss="modal" style="border-radius: 50px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Floating Back Button --}}
<style>
    .pertemuan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(8, 145, 178, 0.18) !important;
    }

    .btn {
        border-radius: 50px !important;
    }

    .fab-back {
        position: fixed;
        bottom: 28px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 52px;
        height: 52px;
        border-radius: 28px;
        background: linear-gradient(135deg, #6b7280, #374151);
        color: #ffffff;
        border: none;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        cursor: pointer;
        transition: transform 0.25s ease, box-shadow 0.25s ease, width 0.25s ease, background 0.25s ease;
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
    }
    .fab-back:hover {
        transform: translateX(-50%) translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        width: auto;
        padding: 0 22px;
        background: linear-gradient(135deg, #374151, #111827);
        color: #ffffff;
        text-decoration: none;
    }
    .fab-back .fab-label {
        display: none;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 8px;
        letter-spacing: 0.3px;
    }
    .fab-back:hover .fab-label {
        display: inline;
    }
    @media (max-width: 576px) {
        .fab-back {
            bottom: 18px;
            width: auto;
            height: 46px;
            font-size: 0.9rem;
            padding: 0 18px;
            border-radius: 28px;
        }
        .fab-back .fab-label {
            display: inline;
        }
        .fab-back:hover {
            transform: translateX(-50%) translateY(-3px);
        }
    }
</style>

<a href="{{ route('gurumapel.index') }}" class="fab-back" title="Kembali ke Dashboard Guru Mapel">
    <i class="fa fa-arrow-left"></i>
    <span class="fab-label">Dashboard Guru</span>
</a>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.btn-detail').click(function () {
            var id_pertemuan = $(this).data('id');
            $('#detail_body').html('<tr><td colspan="3" class="text-center py-4"><i class="fa fa-spinner fa-spin mr-1"></i> Memuat data...</td></tr>');
            $('#detailModal').modal('show');

            $.ajax({
                url: "{{ url('gurumapel/pertemuan') }}/" + id_pertemuan + "/detail",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.length > 0) {
                        $.each(data, function (index, item) {
                            var namaSiswa = item.siswa ? item.siswa.nama : 'N/A';
                            var kehadiran = item.status_kehadiran ? item.status_kehadiran : '-';

                            var badgeStyle = 'background:#e2e8f0; color:#475569;';
                            if (kehadiran === 'H') badgeStyle = 'background:#d1fae5; color:#065f46;';
                            if (kehadiran === 'S') badgeStyle = 'background:#cffafe; color:#155e75;';
                            if (kehadiran === 'I') badgeStyle = 'background:#fef3c7; color:#92400e;';
                            if (kehadiran === 'A') badgeStyle = 'background:#fee2e2; color:#991b1b;';
                            if (kehadiran === 'D') badgeStyle = 'background:#ede9fe; color:#5b21b6;';

                            html += '<tr>';
                            html += '<td class="px-4 py-2"><strong>' + namaSiswa + '</strong></td>';
                            html += '<td><span style="' + badgeStyle + ' padding: 3px 10px; border-radius: 20px; font-size: 0.82rem; font-weight: 600;">' + kehadiran + '</span></td>';
                            html += '<td>' + (item.catatan ? item.catatan.replace(/\n/g, '<br>') : '<span class="text-muted">-</span>') + '</td>';
                            html += '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="3" class="text-center py-4 text-muted">Tidak ada catatan untuk pertemuan ini.</td></tr>';
                    }
                    $('#detail_body').html(html);
                },
                error: function () {
                    $('#detail_body').html('<tr><td colspan="3" class="text-center text-danger py-4"><i class="fa fa-exclamation-triangle mr-1"></i> Gagal memuat data.</td></tr>');
                }
            });
        });
    });
</script>
@endsection
