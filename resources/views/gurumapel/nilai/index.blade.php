@extends('main')

@section('content')
<div class="container-fluid" style="margin-top: 25px;">
    
    {{-- Navigasi Atas --}}
    <div class="row mb-3">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <a href="{{ route('gurumapel.show_kelas', $penetapan->id) }}" class="btn btn-outline-primary btn-sm mb-2">
                    <i class="fa fa-book"></i> Jurnal Pembelajaran
                </a>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modalTambahKomponen">
                    <i class="fa fa-plus-circle"></i> Tambah Komponen Nilai
                </button>
            </div>
        </div>
    </div>

    {{-- Banner Header Kelas --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 14px; background: linear-gradient(135deg, #4f46e5 0%, #6366f1 60%, #818cf8 100%); box-shadow: 0 8px 30px rgba(79, 70, 229, 0.35);">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="badge px-3 py-1 mb-2 font-weight-bold" style="font-size: 0.8rem; background-color: rgba(255,255,255,0.2); color:#fff; border-radius: 20px; letter-spacing: 0.5px;">
                                <i class="fa fa-graduation-cap mr-1"></i> PENGELOLAAN NILAI SISWA
                            </span>
                            <h4 class="font-weight-bold mb-1" style="color:#fff;">
                                Kelas {{ $penetapan->kelas->nama_kelas ?? '-' }}
                            </h4>
                            <p class="mb-0" style="font-size: 0.95rem; color: rgba(255,255,255,0.85);">
                                Mata Pelajaran: <strong style="color:#fff;">{{ $penetapan->mapel->nama_mapel ?? '-' }}</strong> &bull; 
                                Tahun Akademik: <strong style="color:#fff;">{{ $penetapan->tahun->alias_tahun ?? '-' }}</strong>
                            </p>
                        </div>
                        <div class="text-right mt-2 mt-md-0">
                            <div style="background: rgba(255,255,255,0.18); border-radius: 10px; padding: 10px 16px; display: inline-block;">
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px;">TOTAL KOMPONEN</div>
                                <div style="color:#fff; font-size: 1.8rem; font-weight: 800; line-height: 1;">{{ count($komponen) }}</div>
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

    {{-- Stacked Card Tabs --}}
    <div class="stacked-tabs-container">

        {{-- Tab Cards Header --}}
        <div class="stacked-tab-headers">
            <button class="stacked-tab-card active" id="btn-tab-komponen" data-target="tab-komponen" type="button">
                <div class="stacked-tab-icon" style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
                    <i class="fa fa-th-large"></i>
                </div>
                <div class="stacked-tab-info">
                    <div class="stacked-tab-title">Komponen Penilaian</div>
                    <div class="stacked-tab-sub">{{ count($komponen) }} komponen tersedia</div>
                </div>
                <span class="stacked-tab-badge" style="background:#4f46e5;">{{ count($komponen) }}</span>
            </button>
            <button class="stacked-tab-card" id="btn-tab-rekap" data-target="tab-rekap" type="button">
                <div class="stacked-tab-icon" style="background: linear-gradient(135deg, #0ea5e9, #38bdf8);">
                    <i class="fa fa-table"></i>
                </div>
                <div class="stacked-tab-info">
                    <div class="stacked-tab-title">Rekap Semua Nilai</div>
                    <div class="stacked-tab-sub">{{ count($rekap) }} siswa terdaftar</div>
                </div>
                <span class="stacked-tab-badge" style="background:#0ea5e9;">{{ count($rekap) }}</span>
            </button>
        </div>

        {{-- Tab Content Panel --}}
        <div class="stacked-tab-body">
            {{-- TAB 1: DAFTAR KOMPONEN PENILAIAN --}}
            <div class="stacked-tab-pane active" id="tab-komponen">
@php
$jenisConfig = [
    'tugas'    => ['color' => '#0ea5e9', 'light' => '#e0f2fe', 'icon' => 'fa-file-text-o',     'label' => 'Tugas / PR'],
    'uh'       => ['color' => '#f59e0b', 'light' => '#fef3c7', 'icon' => 'fa-pencil',           'label' => 'Ulangan Harian'],
    'formatif' => ['color' => '#10b981', 'light' => '#d1fae5', 'icon' => 'fa-check-circle-o',  'label' => 'Formatif'],
    'sumatif'  => ['color' => '#8b5cf6', 'light' => '#ede9fe', 'icon' => 'fa-star-o',           'label' => 'Sumatif'],
    'sts'      => ['color' => '#ef4444', 'light' => '#fee2e2', 'icon' => 'fa-bookmark-o',       'label' => 'STS'],
    'sas'      => ['color' => '#ec4899', 'light' => '#fce7f3', 'icon' => 'fa-trophy',           'label' => 'SAS'],
    'praktik'  => ['color' => '#14b8a6', 'light' => '#ccfbf1', 'icon' => 'fa-cogs',            'label' => 'Praktik'],
    'lainnya'  => ['color' => '#6b7280', 'light' => '#f3f4f6', 'icon' => 'fa-tag',             'label' => 'Lainnya'],
];
@endphp
            @if(count($komponen) > 0)
                <div class="row">
                    @foreach($komponen as $item)
                        @php
                            $cfg = $jenisConfig[$item->jenis] ?? $jenisConfig['lainnya'];
                        @endphp
                        <div class="col-xl-4 col-md-6 mb-4" id="card-komponen-{{ $item->id }}">
                            <div class="card border-0 h-100 komponen-card" style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.10); transition: transform 0.22s ease, box-shadow 0.22s ease; border-top: 4px solid {{ $cfg['color'] }} !important; background: #ffffff;">
                                <div class="card-body d-flex flex-column" style="padding: 1.4rem;">

                                    {{-- Header: ikon berwarna + jenis badge + menu --}}
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:38px; height:38px; border-radius:10px; background:{{ $cfg['light'] }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                <i class="fa {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }}; font-size: 1.05rem;"></i>
                                            </div>
                                            <span class="badge font-weight-bold text-uppercase px-2 py-1" style="font-size: 0.72rem; letter-spacing: 0.5px; background: {{ $cfg['light'] }}; color: {{ $cfg['color'] }}; border-radius: 8px;">
                                                {{ $cfg['label'] }}
                                            </span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm text-muted" type="button" data-toggle="dropdown" style="background: #f8fafc; border-radius: 8px; width: 32px; height: 32px; padding: 0; border: 1px solid #e2e8f0;">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 10px;">
                                                <button class="dropdown-item btn-edit-komponen"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->nama_komponen }}"
                                                        data-jenis="{{ $item->jenis }}"
                                                        data-bobot="{{ $item->bobot }}"
                                                        data-urutan="{{ $item->urutan }}">
                                                    <i class="fa fa-edit text-warning mr-2"></i> Edit Komponen
                                                </button>
                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item text-danger btn-hapus-komponen"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->nama_komponen }}">
                                                    <i class="fa fa-trash mr-2"></i> Hapus Komponen
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Nama komponen --}}
                                    <h5 class="font-weight-bold mb-1" style="color: #1e293b;">{{ $item->nama_komponen }}</h5>

                                    {{-- Meta info --}}
                                    <div class="d-flex gap-2 mb-3">
                                        <span class="small" style="background:#f1f5f9; border-radius:6px; padding: 3px 10px; color: #64748b;">
                                            <i class="fa fa-balance-scale mr-1"></i> Bobot <strong>{{ $item->bobot }}</strong>
                                        </span>
                                        <span class="small" style="background:#f1f5f9; border-radius:6px; padding: 3px 10px; color: #64748b;">
                                            <i class="fa fa-sort-numeric-asc mr-1"></i> Urutan <strong>{{ $item->urutan }}</strong>
                                        </span>
                                    </div>

                                    {{-- Progress siswa yang dinilai --}}
                                    <div class="d-flex align-items-center justify-content-between mb-3 px-3 py-2" style="background: {{ $cfg['light'] }}; border-radius: 10px;">
                                        <span class="small font-weight-bold" style="color: {{ $cfg['color'] }};"><i class="fa fa-users mr-1"></i> Siswa dinilai</span>
                                        <span class="font-weight-bold" style="color: {{ $cfg['color'] }}; font-size: 1rem;">{{ $item->nilai_siswa_count }}</span>
                                    </div>

                                    {{-- Tombol input --}}
                                    <a href="{{ route('gurumapel.nilai.input', $item->id) }}" class="btn btn-block rounded-pill font-weight-bold mt-auto" style="background: {{ $cfg['color'] }}; color: #fff; letter-spacing: 0.3px; border: none; box-shadow: 0 3px 10px {{ $cfg['color'] }}55; padding: 10px;">
                                        <i class="fa fa-pencil-square-o mr-1"></i> Input / Edit Nilai
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card shadow-sm border-0 text-center p-5" style="border-radius: 12px;">
                    <div class="card-body">
                        <i class="fa fa-clipboard text-muted mb-3" style="font-size: 4rem; opacity: 0.4;"></i>
                        <h5 class="font-weight-bold text-dark">Belum Ada Komponen Penilaian</h5>
                        <p class="text-muted mb-4" style="max-width: 450px; margin: 0 auto;">
                            Buat komponen penilaian terlebih dahulu (contoh: <em>Tugas 1, UH Bab 1, STS, SAS</em>) untuk mulai menginput nilai siswa kelas ini.
                        </p>
                        <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold rounded-pill" data-toggle="modal" data-target="#modalTambahKomponen">
                            <i class="fa fa-plus-circle mr-1"></i> Tambah Komponen Nilai Pertama
                        </button>
                    </div>
                </div>
            @endif
            </div>{{-- /stacked-tab-pane #tab-komponen --}}

            {{-- TAB 2: REKAP SEMUA NILAI (MATRIX SPREADSHEET VIEW) --}}
            <div class="stacked-tab-pane" id="tab-rekap">
                <div class="card border-0" style="border-radius: 0 0 14px 14px; border-top: none;">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-0 text-dark">
                            <i class="fa fa-table text-primary mr-1"></i> Rekap Nilai Siswa
                        </h5>
                        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                            <i class="fa fa-print mr-1"></i> Cetak / PDF
                        </button>
                    </div>
                    <div class="card-body p-0">

                        {{-- ===== DESKTOP: Tabel Matrix (hidden di mobile) ===== --}}
                        <div class="d-none d-md-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0" style="vertical-align: middle;">
                                    <thead class="bg-light text-dark font-weight-bold text-center" style="font-size: 0.85rem;">
                                        <tr>
                                            <th width="4%">No</th>
                                            <th width="12%">NISN</th>
                                            <th class="text-left" width="24%">Nama Siswa</th>
                                            <th width="5%">JK</th>
                                            @foreach($komponen as $k)
                                                <th style="min-width: 90px;">
                                                    <a href="{{ route('gurumapel.nilai.input', $k->id) }}" class="text-dark text-decoration-none" title="Klik untuk edit nilai">
                                                        {{ $k->nama_komponen }}
                                                        <div class="small text-muted font-weight-normal">B: {{ $k->bobot }}</div>
                                                    </a>
                                                </th>
                                            @endforeach
                                            <th width="10%" class="bg-primary text-white">Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.9rem;">
                                        @forelse($rekap as $index => $row)
                                            <tr>
                                                <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                                <td class="text-center text-muted">{{ $row['nisn'] }}</td>
                                                <td class="font-weight-bold text-dark">{{ $row['nama'] }}</td>
                                                <td class="text-center">{{ $row['jenis_kelamin'] }}</td>
                                                @foreach($komponen as $k)
                                                    @php $val = $row['nilai_komponen'][$k->id] ?? null; @endphp
                                                    <td class="text-center font-weight-bold {{ $val !== null ? 'text-dark' : 'text-muted' }}">
                                                        {{ $val !== null ? number_format($val, 1) : '-' }}
                                                    </td>
                                                @endforeach
                                                <td class="text-center font-weight-bold bg-light" style="font-size: 0.95rem;">
                                                    @if($row['rata_rata'] !== null)
                                                        <span class="badge {{ $row['rata_rata'] >= 75 ? 'badge-success' : 'badge-warning' }} px-2 py-1">
                                                            {{ number_format($row['rata_rata'], 2) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ 5 + count($komponen) }}" class="text-center py-4 text-muted">
                                                    Tidak ada data siswa di kelas ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- ===== MOBILE: Card per Siswa (hidden di desktop) ===== --}}
                        <div class="d-md-none">
                            @forelse($rekap as $index => $row)
                                <div style="border-bottom: 1px solid #f1f5f9; padding: 14px 16px;">

                                    {{-- Header: Nomor + Nama + Rata-rata --}}
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center" style="gap: 10px; min-width: 0;">
                                            <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #4f46e5, #6366f1); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.8rem; flex-shrink: 0;">
                                                {{ $index + 1 }}
                                            </div>
                                            <div style="min-width: 0;">
                                                <div class="font-weight-bold text-dark" style="font-size: 0.9rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    {{ $row['nama'] }}
                                                </div>
                                                <small class="text-muted">{{ $row['nisn'] }} &bull; {{ $row['jenis_kelamin'] }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right ml-2" style="flex-shrink: 0;">
                                            @if($row['rata_rata'] !== null)
                                                <div style="font-size: 0.7rem; color: #94a3b8; font-weight: 600; letter-spacing: 0.5px;">RATA-RATA</div>
                                                <span class="badge {{ $row['rata_rata'] >= 75 ? 'badge-success' : 'badge-warning' }} px-2 py-1" style="font-size: 0.9rem;">
                                                    {{ number_format($row['rata_rata'], 2) }}
                                                </span>
                                            @else
                                                <span class="badge badge-light px-2 py-1">-</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Nilai per komponen --}}
                                    @if(count($komponen) > 0)
                                        <div class="d-flex flex-wrap mt-2" style="gap: 6px;">
                                            @foreach($komponen as $k)
                                                @php
                                                    $val = $row['nilai_komponen'][$k->id] ?? null;
                                                    $cfg = $jenisConfig[$k->jenis] ?? $jenisConfig['lainnya'];
                                                @endphp
                                                <div style="background: {{ $cfg['light'] }}; border-radius: 8px; padding: 5px 10px; min-width: 0; flex-shrink: 0;">
                                                    <div style="font-size: 0.68rem; color: {{ $cfg['color'] }}; font-weight: 700; letter-spacing: 0.3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 90px;">
                                                        {{ $k->nama_komponen }}
                                                    </div>
                                                    <div class="font-weight-bold" style="font-size: 0.95rem; color: {{ $val !== null ? $cfg['color'] : '#94a3b8' }};">
                                                        {{ $val !== null ? number_format($val, 1) : '-' }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="fa fa-inbox text-muted mb-2" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                    <p class="text-muted mb-0">Tidak ada data siswa.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>{{-- /stacked-tab-pane #tab-rekap --}}

        </div>{{-- /stacked-tab-body --}}
    </div>{{-- /stacked-tabs-container --}}
</div>{{-- /container-fluid --}}

{{-- MODAL TAMBAH KOMPONEN NILAI --}}
<div class="modal fade" id="modalTambahKomponen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Komponen Nilai
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambahKomponen" action="{{ route('gurumapel.nilai.komponen.store', $penetapan->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Nama Komponen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_komponen" class="form-control" placeholder="Contoh: Tugas 1, UH Bab 1, STS" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Kategori / Jenis</label>
                        <select name="jenis" class="form-control">
                            <option value="tugas">Tugas / PR</option>
                            <option value="uh">Ulangan Harian (UH)</option>
                            <option value="formatif">Formatif</option>
                            <option value="sumatif">Sumatif Lingkup Materi</option>
                            <option value="sts">Sumatif Tengah Semester (STS)</option>
                            <option value="sas">Sumatif Akhir Semester (SAS)</option>
                            <option value="praktik">Praktik / Kinerja</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Bobot Nilai</label>
                                <input type="number" name="bobot" class="form-control" value="1" min="1">
                                <small class="text-muted">Untuk bobot rata-rata</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Urutan Tampil</label>
                                <input type="number" name="urutan" class="form-control" value="{{ count($komponen) + 1 }}" min="1">
                                <small class="text-muted">Posisi kolom</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-radius: 0 0 12px 12px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold px-4" id="btnSimpanKomponen">
                        <i class="fa fa-save mr-1"></i> Simpan Komponen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT KOMPONEN NILAI --}}
<div class="modal fade" id="modalEditKomponen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header bg-warning text-dark" style="border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fa fa-edit mr-1"></i> Edit Komponen Nilai
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditKomponen" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_id_komponen">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Nama Komponen <span class="text-danger">*</span></label>
                        <input type="text" id="edit_nama_komponen" name="nama_komponen" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Kategori / Jenis</label>
                        <select id="edit_jenis" name="jenis" class="form-control">
                            <option value="tugas">Tugas / PR</option>
                            <option value="uh">Ulangan Harian (UH)</option>
                            <option value="formatif">Formatif</option>
                            <option value="sumatif">Sumatif Lingkup Materi</option>
                            <option value="sts">Sumatif Tengah Semester (STS)</option>
                            <option value="sas">Sumatif Akhir Semester (SAS)</option>
                            <option value="praktik">Praktik / Kinerja</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Bobot Nilai</label>
                                <input type="number" id="edit_bobot" name="bobot" class="form-control" min="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Urutan Tampil</label>
                                <input type="number" id="edit_urutan" name="urutan" class="form-control" min="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-radius: 0 0 12px 12px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning font-weight-bold px-4" id="btnUpdateKomponen">
                        <i class="fa fa-save mr-1"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                      || '{{ csrf_token() }}';

    // ===== STACKED CARD TABS TOGGLE =====
    document.querySelectorAll('.stacked-tab-card').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;

            // Deactivate all tabs & panes
            document.querySelectorAll('.stacked-tab-card').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.stacked-tab-pane').forEach(p => p.classList.remove('active'));

            // Activate clicked tab & matching pane
            this.classList.add('active');
            const pane = document.getElementById(target);
            if (pane) pane.classList.add('active');
        });
    });

    // Edit Komponen Handler
    document.querySelectorAll('.btn-edit-komponen').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const jenis = this.dataset.jenis;
            const bobot = this.dataset.bobot;
            const urutan = this.dataset.urutan;

            document.getElementById('edit_id_komponen').value = id;
            document.getElementById('edit_nama_komponen').value = nama;
            document.getElementById('edit_jenis').value = jenis;
            document.getElementById('edit_bobot').value = bobot;
            document.getElementById('edit_urutan').value = urutan;

            const form = document.getElementById('formEditKomponen');
            form.action = `/gurumapel/nilai/komponen/${id}`;

            $('#modalEditKomponen').modal('show');
        });
    });

    // Hapus Komponen Handler (AJAX)
    document.querySelectorAll('.btn-hapus-komponen').forEach(btn => {
        btn.addEventListener('click', async function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;

            if (!confirm(`Yakin ingin menghapus komponen "${nama}"? Semua data nilai siswa pada komponen ini akan ikut terhapus!`)) {
                return;
            }

            try {
                const response = await fetch(`/gurumapel/nilai/komponen/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();
                if (response.ok && result.success) {
                    alert('Komponen berhasil dihapus!');
                    window.location.reload();
                } else {
                    alert(result.message || 'Gagal menghapus komponen.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi.');
            }
        });
    });
});
</script>

<style>
    /* ===== STACKED CARD TABS ===== */
    .stacked-tabs-container {
        position: relative;
    }

    .stacked-tab-headers {
        display: flex;
        gap: 10px;
        padding-bottom: 0;
        position: relative;
        z-index: 2;
    }

    .stacked-tab-card {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 14px;
        background: #f1f5f9;
        border: none;
        border-radius: 14px 14px 0 0;
        padding: 14px 18px;
        cursor: pointer;
        transition: all 0.22s ease;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.06);
        position: relative;
        bottom: -4px;
        text-align: left;
        color: #64748b;
    }

    .stacked-tab-card.active {
        background: #ffffff;
        color: #1e293b;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.10);
        bottom: 0;
        z-index: 3;
    }

    .stacked-tab-card:not(.active):hover {
        background: #e8edf5;
        bottom: -2px;
    }

    .stacked-tab-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        flex-shrink: 0;
        transition: transform 0.2s;
    }

    .stacked-tab-card:not(.active) .stacked-tab-icon {
        filter: grayscale(60%) opacity(0.7);
    }

    .stacked-tab-card.active .stacked-tab-icon {
        transform: scale(1.08);
    }

    .stacked-tab-title {
        font-weight: 700;
        font-size: 0.95rem;
        line-height: 1.2;
    }

    .stacked-tab-sub {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 2px;
        font-weight: 400;
    }

    .stacked-tab-card.active .stacked-tab-sub {
        color: #94a3b8;
    }

    .stacked-tab-badge {
        margin-left: auto;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        flex-shrink: 0;
    }

    .stacked-tab-card:not(.active) .stacked-tab-badge {
        opacity: 0.5;
    }

    .stacked-tab-body {
        background: #ffffff;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        padding: 24px;
        position: relative;
        z-index: 1;
    }

    .stacked-tab-pane {
        display: none;
    }

    .stacked-tab-pane.active {
        display: block;
    }

    @media (max-width: 576px) {
        .stacked-tab-card {
            padding: 10px 12px;
            gap: 8px;
        }
        .stacked-tab-title {
            font-size: 0.82rem;
        }
        .stacked-tab-sub,
        .stacked-tab-badge {
            display: none;
        }
        .stacked-tab-icon {
            width: 34px;
            height: 34px;
            font-size: 0.9rem;
        }
        .stacked-tab-body {
            padding: 16px;
        }
    }
</style>

<style>
    /* Hover lift effect untuk komponen card */
    .komponen-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 36px rgba(0, 0, 0, 0.15) !important;
    }

    /* Semua tombol lebih rounded */
    .btn:not(.btn-sm):not(.dropdown-item) {
        border-radius: 50px !important;
    }
    .btn-sm {
        border-radius: 50px !important;
    }
</style>

<style>
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

{{-- Floating Back Button: Kembali ke Dashboard Guru Mapel --}}
<a href="{{ route('gurumapel.index') }}" class="fab-back" title="Kembali ke Dashboard Guru Mapel">
    <i class="fa fa-arrow-left"></i>
    <span class="fab-label">Dashboard Guru</span>
</a>
@endsection
