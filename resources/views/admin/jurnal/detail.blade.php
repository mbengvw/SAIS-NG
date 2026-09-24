@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">
    
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.jurnal.show_riwayat', $penetapan->id) }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali ke Riwayat</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px; border-left: 5px solid #4f46e5;">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">Detail Jurnal Mengajar (Read-Only)</h4>
                    <p class="mb-0 text-muted">
                        Guru: <strong>{{ $penetapan->guru->name ?? 'N/A' }}</strong> <br>
                        Kelas: <strong>{{ $penetapan->kelas->nama_kelas ?? 'N/A' }}</strong> <br>
                        Mata Pelajaran: <strong>{{ $penetapan->mapel->nama_mapel ?? 'N/A' }}</strong> <br>
                        Tanggal Pertemuan: <strong>{{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('d F Y') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white font-weight-bold">
                    Materi Pembelajaran
                </div>
                <div class="card-body">
                    {!! nl2br(e($pertemuan->materi_pembelajaran)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white font-weight-bold">
                    Daftar Siswa & Catatan Kehadiran
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <!-- Header -->
                        <div class="list-group-item bg-light font-weight-bold d-none d-md-block">
                            <div class="row">
                                <div class="col-md-4">Nama Siswa</div>
                                <div class="col-md-4">Kehadiran</div>
                                <div class="col-md-4">Catatan Khusus</div>
                            </div>
                        </div>
                        
                        <!-- Daftar Siswa -->
                        @forelse($siswa as $row)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    
                                    <!-- Profil Siswa -->
                                    <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex align-items-center">
                                        <span class="mr-3 font-weight-bold text-muted">{{ $loop->iteration }}.</span>
                                        <div>
                                            <div class="font-weight-bold text-dark">{{ $row->siswa->nama ?? 'N/A' }}</div>
                                            <small class="text-muted">NISN: {{ $row->siswa->nisn ?? '-' }}</small>
                                        </div>
                                    </div>
                                    
                                    <!-- Absensi -->
                                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                                        @php 
                                            $status_hadir = $kehadiran_lama[$row->id_siswa] ?? '-'; 
                                            $badge_class = 'badge-secondary';
                                            if ($status_hadir == 'H') $badge_class = 'badge-success';
                                            if ($status_hadir == 'S') $badge_class = 'badge-info';
                                            if ($status_hadir == 'I') $badge_class = 'badge-warning';
                                            if ($status_hadir == 'A') $badge_class = 'badge-danger';
                                            if ($status_hadir == 'D') $badge_class = 'badge-primary';
                                        @endphp
                                        <span class="badge {{ $badge_class }} p-2">{{ $status_hadir }}</span>
                                    </div>
                                    
                                    <!-- Catatan -->
                                    <div class="col-12 col-md-4">
                                        <div class="text-muted small">
                                            {{ $catatan_lama[$row->id_siswa] ?? '-' }}
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center py-4 text-muted">
                                Belum ada data siswa.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
