@extends('main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Riwayat Pengajuan Izin Keluar (Hari Ini)</h3>
            <h6 class="text-muted mb-0">Kelola dan pantau izin keluar siswa yang Anda setujui</h6>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm" style="border-radius: 10px;">
        <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="mb-4 text-right">
        <a href="{{ route('guru.izin_keluar.create') }}" class="btn btn-primary shadow-sm" style="border-radius: 20px;">
            <i class="fa fa-plus"></i> Ajukan Izin Baru
        </a>
    </div>

    <div class="card shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0 p-md-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Alasan</th>
                            <th>Waktu Keluar</th>
                            <th>Waktu Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat_izin as $index => $izin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-weight-bold">{{ $izin->siswa->nama ?? '-' }}</td>
                            <td>{{ $izin->kelas->nama_kelas ?? '-' }}</td>
                            <td>
                                {{ $izin->alasan }}
                                @if($izin->is_pulang)
                                    <br><span class="badge badge-danger">Izin Pulang (Tidak Kembali)</span>
                                @endif
                            </td>
                            <td>{{ $izin->waktu_keluar ? date('H:i', strtotime($izin->waktu_keluar)) : '-' }}</td>
                            <td>{{ $izin->waktu_kembali ? date('H:i', strtotime($izin->waktu_kembali)) : '-' }}</td>
                            <td>
                                @if($izin->status == 'menunggu')
                                    <span class="badge badge-secondary">Menunggu Piket</span>
                                @elseif($izin->status == 'keluar')
                                    <span class="badge badge-warning">Sedang di Luar</span>
                                @elseif($izin->status == 'kembali')
                                    <span class="badge badge-success">Sudah Kembali</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada pengajuan izin hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
