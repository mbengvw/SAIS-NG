@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">
    
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('gurumapel.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            <a href="{{ route('gurumapel.riwayat', $penetapan->id) }}" class="btn btn-info text-white float-right"><i class="fa fa-history"></i> Riwayat Pertemuan</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px; border-left: 5px solid #4f46e5;">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">Kelas {{ $penetapan->kelas->nama_kelas }}</h4>
                    <p class="mb-0 text-muted">
                        Mata Pelajaran: <strong>{{ $penetapan->mapel->nama_mapel }}</strong> <br>
                        Tahun Akademik: <strong>{{ $data_tahun->alias_tahun }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('gurumapel.store_catatan', $penetapan->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white font-weight-bold">
                        Detail Pertemuan
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pertemuan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="materi_pembelajaran">Materi Pembelajaran <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="materi_pembelajaran" name="materi_pembelajaran" rows="5" placeholder="Tuliskan materi yang dibahas pada pertemuan ini..." required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white font-weight-bold">
                        Daftar Siswa & Catatan Pembelajaran
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="45%">Nama Siswa</th>
                                        <th width="50%">Catatan / Uraian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siswa as $index => $row)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if(!empty($row->siswa->foto))
                                                        <img src="{{ asset($row->siswa->foto) }}" alt="Foto" class="rounded-circle mr-3" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #e0e7ff;">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($row->siswa->nama ?? 'Siswa') }}&background=e0e7ff&color=4f46e5&rounded=true&bold=true&size=120" alt="Foto" class="rounded-circle mr-3" style="width: 60px; height: 60px;">
                                                    @endif
                                                    <div>
                                                        <div class="font-weight-bold">{{ $row->siswa->nama ?? 'N/A' }}</div>
                                                        <small class="text-muted">NISN: {{ $row->siswa->nisn ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea name="catatan[{{ $row->id_siswa }}]" class="form-control" rows="2" placeholder="Tambahkan catatan khusus untuk siswa ini (opsional)..."></textarea>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada data siswa di kelas ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save"></i> Simpan Semua Catatan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
