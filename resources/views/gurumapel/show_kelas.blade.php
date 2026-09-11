@extends('main')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

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
            <div class="col-12">
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
                            <textarea class="form-control" id="materi_pembelajaran" name="materi_pembelajaran" rows="5" placeholder="Tuliskan materi yang dibahas pada pertemuan ini..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white font-weight-bold">
                        Daftar Siswa & Catatan Pembelajaran
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <!-- Header (Hanya tampil di desktop) -->
                            <div class="list-group-item bg-light font-weight-bold d-none d-md-block">
                                <div class="row">
                                    <div class="col-md-4">Nama Siswa</div>
                                    <div class="col-md-4">Kehadiran</div>
                                    <div class="col-md-4">Catatan / Uraian</div>
                                </div>
                            </div>
                            
                            <!-- Daftar Siswa -->
                            @forelse($siswa as $index => $row)
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        
                                        <!-- Bagian 1: Profil Siswa -->
                                        <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex align-items-center">
                                            <span class="mr-3 font-weight-bold text-muted">{{ $index + 1 }}.</span>
                                            @if(!empty($row->siswa->foto))
                                                <img src="{{ asset($row->siswa->foto) }}" alt="Foto" class="rounded-circle mr-3" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #e0e7ff;">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($row->siswa->nama ?? 'Siswa') }}&background=e0e7ff&color=4f46e5&rounded=true&bold=true&size=100" alt="Foto" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                                            @endif
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ $row->siswa->nama ?? 'N/A' }}</div>
                                                <small class="text-muted">NISN: {{ $row->siswa->nisn ?? '-' }}</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Bagian 2: Absensi Kehadiran -->
                                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                                            <div class="d-md-none text-muted mb-1 small font-weight-bold">Kehadiran:</div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <div class="form-check form-check-inline mr-2 mb-1">
                                                    <input class="form-check-input" type="radio" name="kehadiran[{{ $row->id_siswa }}]" id="hadir_{{ $row->id_siswa }}" value="H" checked>
                                                    <label class="form-check-label text-success font-weight-bold" for="hadir_{{ $row->id_siswa }}">H</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-2 mb-1">
                                                    <input class="form-check-input" type="radio" name="kehadiran[{{ $row->id_siswa }}]" id="sakit_{{ $row->id_siswa }}" value="S">
                                                    <label class="form-check-label text-info font-weight-bold" for="sakit_{{ $row->id_siswa }}">S</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-2 mb-1">
                                                    <input class="form-check-input" type="radio" name="kehadiran[{{ $row->id_siswa }}]" id="izin_{{ $row->id_siswa }}" value="I">
                                                    <label class="form-check-label text-warning font-weight-bold" for="izin_{{ $row->id_siswa }}">I</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-2 mb-1">
                                                    <input class="form-check-input" type="radio" name="kehadiran[{{ $row->id_siswa }}]" id="alpa_{{ $row->id_siswa }}" value="A">
                                                    <label class="form-check-label text-danger font-weight-bold" for="alpa_{{ $row->id_siswa }}">A</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-0 mb-1">
                                                    <input class="form-check-input" type="radio" name="kehadiran[{{ $row->id_siswa }}]" id="dispen_{{ $row->id_siswa }}" value="D">
                                                    <label class="form-check-label text-primary font-weight-bold" for="dispen_{{ $row->id_siswa }}">D</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Bagian 3: Catatan Pembelajaran -->
                                        <div class="col-12 col-md-4">
                                            <div class="d-md-none text-muted mb-1 small font-weight-bold">Catatan (Opsional):</div>
                                            <textarea name="catatan[{{ $row->id_siswa }}]" class="form-control form-control-sm" rows="2" placeholder="Tulis catatan di sini..."></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-center py-4 text-muted">
                                    Belum ada data siswa di kelas ini.
                                </div>
                            @endforelse
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

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#materi_pembelajaran').summernote({
                placeholder: 'Tuliskan materi yang dibahas pada pertemuan ini...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
