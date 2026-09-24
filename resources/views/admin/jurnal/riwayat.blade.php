@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">
    
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Kelas</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px; border-left: 5px solid #17a2b8;">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">Riwayat Catatan Mengajar</h4>
                    <p class="mb-0 text-muted">
                        Guru: <strong>{{ $penetapan->guru->name ?? 'N/A' }}</strong> <br>
                        Kelas: <strong>{{ $penetapan->kelas->nama_kelas ?? 'N/A' }}</strong> <br>
                        Mata Pelajaran: <strong>{{ $penetapan->mapel->nama_mapel ?? 'N/A' }}</strong>
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
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{!! $row->materi_pembelajaran !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.jurnal.show_detail', $row->id) }}" class="btn btn-info btn-sm btn-detail">
                                                <i class="fa fa-eye"></i> Detail Kehadiran & Catatan
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat pertemuan/catatan dari guru ini.</td>
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
@endsection
