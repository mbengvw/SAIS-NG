@extends('main')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px; border-left: 5px solid #4f46e5;">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">Monitoring Jurnal Guru Mapel</h4>
                    <p class="mb-0 text-muted">
                        Tahun Akademik: <strong>{{ $tahun }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white font-weight-bold d-flex justify-content-between align-items-center">
            <span>Daftar Penetapan Guru Mapel</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penetapan as $index => $row)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="font-weight-bold">{{ $row->guru->name ?? 'N/A' }}</td>
                                <td>{{ $row->mapel->nama_mapel ?? 'N/A' }}</td>
                                <td>{{ $row->kelas->nama_kelas ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.jurnal.show_riwayat', $row->id) }}" class="btn btn-sm btn-info" title="Lihat Jurnal">
                                        <i class="fa fa-eye"></i> Riwayat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada penetapan guru mapel di tahun ajaran ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
