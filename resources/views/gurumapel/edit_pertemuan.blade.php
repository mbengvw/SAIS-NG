@extends('main')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<style>
    .btn { border-radius: 50px !important; }

    /* Absensi pill buttons */
    .absen-group { display: flex; flex-wrap: wrap; gap: 6px; }

    .absen-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        color: #64748b;
        transition: all 0.18s ease;
        user-select: none;
    }

    .absen-label:hover {
        border-color: #cbd5e1;
        background: #f1f5f9;
    }

    .absen-radio:checked + .absen-label {
        border-color: transparent;
        color: #fff;
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    .absen-radio[value="H"]:checked + .absen-label { background: #10b981; }
    .absen-radio[value="S"]:checked + .absen-label { background: #0ea5e9; }
    .absen-radio[value="I"]:checked + .absen-label { background: #f59e0b; }
    .absen-radio[value="A"]:checked + .absen-label { background: #ef4444; }
    .absen-radio[value="D"]:checked + .absen-label { background: #8b5cf6; }
    .absen-radio { display: none; }

    .siswa-row {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 14px 20px;
        transition: background 0.15s;
    }
    .siswa-row:last-child { border-bottom: none; }
    .siswa-row:hover { background: #f8fafc; }

    @media (max-width: 576px) {
        .absen-label { width: 36px; height: 36px; font-size: 0.82rem; }
    }
</style>

<div class="container-fluid" style="margin-top: 25px;">

    {{-- Navigasi --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}" class="btn btn-sm" style="background:#f1f5f9; color:#475569; border:none; font-weight:600;">
                <i class="fa fa-arrow-left mr-1"></i> Kembali ke Jurnal
            </a>
        </div>
    </div>

    {{-- Banner --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 14px; background: linear-gradient(135deg, #d97706 0%, #f59e0b 60%, #fbbf24 100%); box-shadow: 0 8px 30px rgba(217, 119, 6, 0.35);">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="badge px-3 py-1 mb-2 font-weight-bold" style="font-size: 0.8rem; background-color: rgba(255,255,255,0.2); color:#fff; border-radius: 20px; letter-spacing: 0.5px;">
                                <i class="fa fa-edit mr-1"></i> EDIT CATATAN PERTEMUAN
                            </span>
                            <h4 class="font-weight-bold mb-1" style="color:#fff;">
                                Kelas {{ $penetapan->kelas->nama_kelas }}
                            </h4>
                            <p class="mb-0" style="font-size: 0.95rem; color: rgba(255,255,255,0.85);">
                                Mata Pelajaran: <strong style="color:#fff;">{{ $penetapan->mapel->nama_mapel }}</strong>
                                &bull; Tahun Akademik: <strong style="color:#fff;">{{ $data_tahun->alias_tahun }}</strong>
                            </p>
                        </div>
                        <div class="text-right mt-2 mt-md-0">
                            <div style="background: rgba(255,255,255,0.18); border-radius: 10px; padding: 10px 16px; display: inline-block;">
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px;">TANGGAL PERTEMUAN</div>
                                <div style="color:#fff; font-size: 1.05rem; font-weight: 700; line-height: 1.3; margin-top: 2px;">
                                    {{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('d F Y') }}
                                </div>
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
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <form action="{{ route('gurumapel.update_pertemuan', $pertemuan->id) }}" method="POST">
        @csrf

        {{-- Card: Detail Pertemuan --}}
        <div class="card border-0 mb-4" style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.09);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4" style="gap: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #d97706, #fbbf24); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; flex-shrink: 0;">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-0">Detail Pertemuan</h5>
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal" class="font-weight-bold text-dark" style="font-size: 0.88rem;">
                        Tanggal Pertemuan <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                           id="tanggal" name="tanggal"
                           value="{{ \Carbon\Carbon::parse($pertemuan->tanggal)->format('Y-m-d') }}"
                           style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                           required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label for="materi_pembelajaran" class="font-weight-bold text-dark" style="font-size: 0.88rem;">
                        Materi Pembelajaran <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('materi_pembelajaran') is-invalid @enderror"
                              id="materi_pembelajaran" name="materi_pembelajaran"
                              rows="4">{{ $pertemuan->materi_pembelajaran }}</textarea>
                    @error('materi_pembelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Card: Daftar Siswa --}}
        <div class="card border-0 mb-5" style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.09);">
            <div class="card-body p-0">
                {{-- Header card --}}
                <div class="d-flex align-items-center px-4 py-3" style="border-bottom: 1.5px solid #f1f5f9; gap: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #4f46e5, #6366f1); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; flex-shrink: 0;">
                        <i class="fa fa-users"></i>
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-0">Daftar Siswa & Catatan Pembelajaran</h5>
                        <small class="text-muted">{{ count($siswa) }} siswa — Perbarui kehadiran dan catatan</small>
                    </div>
                </div>

                {{-- Header kolom (desktop only) --}}
                <div class="d-none d-md-flex px-4 py-2" style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                    <div style="flex: 0 0 42%; font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Nama Siswa</div>
                    <div style="flex: 0 0 25%; font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Kehadiran</div>
                    <div style="flex: 1; font-size: 0.78rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Catatan</div>
                </div>

                {{-- List siswa --}}
                @forelse($siswa as $index => $row)
                    @php $status_hadir = $kehadiran_lama[$row->id_siswa] ?? 'H'; @endphp
                    <div class="siswa-row">
                        <div class="row align-items-center">

                            {{-- Profil siswa --}}
                            <div class="col-12 col-md-5 d-flex align-items-center mb-3 mb-md-0" style="gap: 12px;">
                                <span class="font-weight-bold text-muted" style="font-size: 0.82rem; min-width: 22px;">{{ $loop->iteration }}.</span>
                                @if(!empty($row->siswa->foto))
                                    <img src="{{ asset($row->siswa->foto) }}" alt="Foto"
                                         class="rounded-circle flex-shrink-0"
                                         style="width: 42px; height: 42px; object-fit: cover; border: 2px solid #fef3c7;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($row->siswa->nama ?? 'Siswa') }}&background=fef3c7&color=d97706&rounded=true&bold=true&size=100"
                                         alt="Foto" class="rounded-circle flex-shrink-0"
                                         style="width: 42px; height: 42px;">
                                @endif
                                <div style="min-width: 0;">
                                    <div class="font-weight-bold text-dark" style="font-size: 0.92rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $row->siswa->nama ?? 'N/A' }}
                                    </div>
                                    <small class="text-muted">{{ $row->siswa->nisn ?? '-' }}</small>
                                </div>
                            </div>

                            {{-- Absensi --}}
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <div class="d-md-none text-muted mb-2" style="font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Kehadiran</div>
                                <div class="absen-group">
                                    @foreach(['H' => 'H', 'S' => 'S', 'I' => 'I', 'A' => 'A', 'D' => 'D'] as $val => $label)
                                        <input class="absen-radio" type="radio"
                                               name="kehadiran[{{ $row->id_siswa }}]"
                                               id="{{ strtolower($val) }}_{{ $row->id_siswa }}"
                                               value="{{ $val }}"
                                               {{ $status_hadir == $val ? 'checked' : '' }}>
                                        <label class="absen-label" for="{{ strtolower($val) }}_{{ $row->id_siswa }}"
                                               title="{{ ['H'=>'Hadir','S'=>'Sakit','I'=>'Izin','A'=>'Alpa','D'=>'Dispensasi'][$val] }}">
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="col-12 col-md-4">
                                <div class="d-md-none text-muted mb-2" style="font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Catatan (Opsional)</div>
                                <textarea name="catatan[{{ $row->id_siswa }}]"
                                          class="form-control"
                                          rows="2"
                                          placeholder="Catatan untuk siswa ini..."
                                          style="border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 0.88rem; resize: none;">{{ $catatan_lama[$row->id_siswa] ?? '' }}</textarea>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fa fa-users text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                        <p class="text-muted">Belum ada data siswa di kelas ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Footer: tombol aksi --}}
            <div class="card-footer bg-white d-flex justify-content-end px-4 py-3" style="border-radius: 0 0 14px 14px; border-top: 1.5px solid #f1f5f9;">
                <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}"
                   class="btn btn-sm mr-2 font-weight-bold"
                   style="background:#f1f5f9; color:#475569; border:none; padding: 10px 22px;">
                    Batal
                </a>
                <button type="submit" class="btn btn-warning font-weight-bold px-4 text-white" style="padding: 10px 28px; box-shadow: 0 3px 12px rgba(217,119,6,0.35); background: linear-gradient(135deg, #d97706, #f59e0b); border: none;">
                    <i class="fa fa-save mr-1"></i> Perbarui Catatan
                </button>
            </div>
        </div>

    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function () {
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
