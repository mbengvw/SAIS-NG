@extends('main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Dashboard Piket: Perizinan Siswa</h3>
            <h6 class="text-muted mb-0">Kelola keberangkatan dan kepulangan siswa yang izin keluar</h6>
        </div>
    </div>

    <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-bold" id="pills-menunggu-tab" data-toggle="pill" href="#pills-menunggu" role="tab" style="border-radius: 20px;">
                Menunggu Approval 
                @if($count_menunggu > 0)
                <span class="badge badge-danger ml-1">{{ $count_menunggu }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link font-weight-bold" id="pills-keluar-tab" data-toggle="pill" href="#pills-keluar" role="tab" style="border-radius: 20px;">
                Sedang di Luar
                @if($count_keluar > 0)
                <span class="badge badge-warning ml-1">{{ $count_keluar }}</span>
                @endif
            </a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- TAB MENUNGGU -->
        <div class="tab-pane fade show active" id="pills-menunggu" role="tabpanel">
            <div class="row">
                @forelse($menunggu as $izin)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100" style="border-radius: 15px; border-top: 5px solid #007bff;">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-dark">{{ $izin->siswa->nama ?? '-' }}</h5>
                            <h6 class="text-muted mb-3">{{ $izin->kelas->nama_kelas ?? '-' }}</h6>
                            
                            <p class="mb-1 text-sm"><i class="fa fa-info-circle text-primary"></i> <b>Alasan:</b><br>{{ $izin->alasan }}</p>
                            <p class="mb-2 text-sm"><i class="fa fa-user text-success"></i> <b>Izin dari:</b> {{ $izin->guruPemberi->name ?? '-' }}</p>
                            
                            @if($izin->is_pulang)
                                <div class="alert alert-danger p-2 text-center" style="font-size: 0.8rem; font-weight: bold;">
                                    Izin Pulang (Tidak Kembali)
                                </div>
                            @endif
                            
                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('piket.izin_keluar.cetak', $izin->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm shadow-sm" style="border-radius: 10px;">
                                    <i class="fa fa-print"></i> Cetak Surat
                                </a>
                                <button type="button" class="btn btn-primary btn-sm shadow-sm btn-approve" data-id="{{ $izin->id }}" style="border-radius: 10px;">
                                    <i class="fa fa-sign-out"></i> Izinkan Keluar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-light text-center shadow-sm py-5" style="border-radius: 15px;">
                        <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
                        <h5>Tidak ada pengajuan izin yang menunggu.</h5>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- TAB KELUAR -->
        <div class="tab-pane fade" id="pills-keluar" role="tabpanel">
            <div class="row">
                @forelse($keluar as $izin)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100" style="border-radius: 15px; border-top: 5px solid #ffc107;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="font-weight-bold text-dark">{{ $izin->siswa->nama ?? '-' }}</h5>
                                    <h6 class="text-muted">{{ $izin->kelas->nama_kelas ?? '-' }}</h6>
                                </div>
                                <span class="badge badge-warning p-2"><i class="fa fa-clock-o"></i> {{ date('H:i', strtotime($izin->waktu_keluar)) }}</span>
                            </div>
                            
                            <p class="mb-1 mt-3 text-sm"><i class="fa fa-info-circle text-primary"></i> <b>Alasan:</b><br>{{ $izin->alasan }}</p>
                            
                            @if($izin->is_pulang)
                                <div class="alert alert-danger p-2 text-center mt-3" style="font-size: 0.8rem; font-weight: bold;">
                                    Siswa Pulang (Tidak perlu check-in)
                                </div>
                                <button type="button" class="btn btn-success btn-sm btn-block shadow-sm btn-kembali mt-2" data-id="{{ $izin->id }}" style="border-radius: 10px;">
                                    Tutup Transaksi (Selesai)
                                </button>
                            @else
                                <hr>
                                <button type="button" class="btn btn-success btn-block shadow-sm btn-kembali" data-id="{{ $izin->id }}" style="border-radius: 10px; font-weight: bold;">
                                    <i class="fa fa-sign-in"></i> Lapor Masuk (Sudah Kembali)
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-light text-center shadow-sm py-5" style="border-radius: 15px;">
                        <i class="fa fa-bed fa-3x text-secondary mb-3"></i>
                        <h5>Tidak ada siswa yang sedang di luar sekolah.</h5>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.btn-approve').click(function() {
            let id = $(this).data('id');
            let btn = $(this);
            if (confirm('Yakin izinkan siswa ini keluar gerbang sekarang?')) {
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                $.post('{{ url("izin-keluar/piket/approve") }}/' + id, {
                    _token: '{{ csrf_token() }}'
                }, function(res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan.');
                        btn.prop('disabled', false);
                    }
                });
            }
        });

        $('.btn-kembali').click(function() {
            let id = $(this).data('id');
            let btn = $(this);
            if (confirm('Konfirmasi siswa telah kembali masuk ke area sekolah?')) {
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                $.post('{{ url("izin-keluar/piket/kembali") }}/' + id, {
                    _token: '{{ csrf_token() }}'
                }, function(res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan.');
                        btn.prop('disabled', false);
                    }
                });
            }
        });
    });
</script>
@endsection
