@extends('main')

@section('content')
@php
$jenisConfig = [
    'tugas'    => ['color' => '#0ea5e9', 'light' => '#e0f2fe', 'icon' => 'fa-file-text-o',    'label' => 'Tugas / PR',       'grad' => 'linear-gradient(135deg, #0891b2, #38bdf8)'],
    'uh'       => ['color' => '#f59e0b', 'light' => '#fef3c7', 'icon' => 'fa-pencil',          'label' => 'Ulangan Harian',   'grad' => 'linear-gradient(135deg, #d97706, #fbbf24)'],
    'formatif' => ['color' => '#10b981', 'light' => '#d1fae5', 'icon' => 'fa-check-circle-o', 'label' => 'Formatif',         'grad' => 'linear-gradient(135deg, #059669, #34d399)'],
    'sumatif'  => ['color' => '#8b5cf6', 'light' => '#ede9fe', 'icon' => 'fa-star-o',          'label' => 'Sumatif',          'grad' => 'linear-gradient(135deg, #7c3aed, #a78bfa)'],
    'sts'      => ['color' => '#ef4444', 'light' => '#fee2e2', 'icon' => 'fa-bookmark-o',      'label' => 'STS',              'grad' => 'linear-gradient(135deg, #dc2626, #f87171)'],
    'sas'      => ['color' => '#ec4899', 'light' => '#fce7f3', 'icon' => 'fa-trophy',          'label' => 'SAS',              'grad' => 'linear-gradient(135deg, #db2777, #f472b6)'],
    'praktik'  => ['color' => '#14b8a6', 'light' => '#ccfbf1', 'icon' => 'fa-cogs',           'label' => 'Praktik',          'grad' => 'linear-gradient(135deg, #0d9488, #2dd4bf)'],
    'lainnya'  => ['color' => '#6b7280', 'light' => '#f3f4f6', 'icon' => 'fa-tag',            'label' => 'Lainnya',          'grad' => 'linear-gradient(135deg, #4b5563, #9ca3af)'],
];
$cfg = $jenisConfig[$komponen->jenis] ?? $jenisConfig['lainnya'];
@endphp

<style>
    .btn { border-radius: 50px !important; }

    .siswa-row {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 12px 20px;
        transition: background 0.15s;
    }
    .siswa-row:last-child { border-bottom: none; }
    .siswa-row:hover { background: #f8fafc; }

    .input-nilai {
        border-radius: 10px !important;
        border: 1.5px solid #e2e8f0 !important;
        font-size: 1.05rem !important;
        font-weight: 700 !important;
        text-align: center;
        color: {{ $cfg['color'] }};
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .input-nilai:focus {
        border-color: {{ $cfg['color'] }} !important;
        box-shadow: 0 0 0 3px {{ $cfg['color'] }}25 !important;
        outline: none;
    }
    .input-nilai::placeholder { color: #cbd5e1; font-weight: 400; }

    .input-catatan {
        border-radius: 10px !important;
        border: 1.5px solid #e2e8f0 !important;
        font-size: 0.85rem !important;
        transition: border-color 0.18s;
    }
    .input-catatan:focus {
        border-color: {{ $cfg['color'] }} !important;
        box-shadow: 0 0 0 3px {{ $cfg['color'] }}20 !important;
    }

    @media (max-width: 576px) {
        .siswa-row { padding: 12px 14px; }
    }
</style>

<div class="container-fluid" style="margin-top: 25px;">

    {{-- Navigasi --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('gurumapel.nilai.index', $penetapan->id) }}" class="btn btn-sm" style="background:#f1f5f9; color:#475569; border:none; font-weight:600;">
                <i class="fa fa-arrow-left mr-1"></i> Kembali ke Daftar Nilai
            </a>
        </div>
    </div>

    {{-- Banner --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0" style="border-radius: 14px; background: {{ $cfg['grad'] }}; box-shadow: 0 8px 30px {{ $cfg['color'] }}55;">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="badge px-3 py-1 mb-2 font-weight-bold" style="font-size: 0.8rem; background-color: rgba(255,255,255,0.2); color:#fff; border-radius: 20px; letter-spacing: 0.5px;">
                                <i class="fa {{ $cfg['icon'] }} mr-1"></i> INPUT NILAI: {{ strtoupper($cfg['label']) }}
                            </span>
                            <h4 class="font-weight-bold mb-1" style="color:#fff;">
                                {{ $komponen->nama_komponen }}
                            </h4>
                            <p class="mb-0" style="font-size: 0.92rem; color: rgba(255,255,255,0.85);">
                                Kelas <strong style="color:#fff;">{{ $penetapan->kelas->nama_kelas ?? '-' }}</strong>
                                &bull; <strong style="color:#fff;">{{ $penetapan->mapel->nama_mapel ?? '-' }}</strong>
                            </p>
                        </div>
                        <div class="d-flex mt-2 mt-md-0" style="gap: 10px;">
                            <div style="background: rgba(255,255,255,0.18); border-radius: 10px; padding: 10px 16px; display: inline-block; text-align: center;">
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.72rem; font-weight: 600; letter-spacing: 0.5px;">BOBOT</div>
                                <div style="color:#fff; font-size: 1.5rem; font-weight: 800; line-height: 1;">{{ $komponen->bobot }}</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.18); border-radius: 10px; padding: 10px 16px; display: inline-block; text-align: center;">
                                <div style="color: rgba(255,255,255,0.8); font-size: 0.72rem; font-weight: 600; letter-spacing: 0.5px;">SISWA</div>
                                <div style="color:#fff; font-size: 1.5rem; font-weight: 800; line-height: 1;">{{ count($siswaList) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert AJAX --}}
    <div id="ajaxAlertContainer"></div>

    {{-- Form Input Nilai --}}
    <form id="formInputNilai" action="{{ route('gurumapel.nilai.store_batch', $komponen->id) }}" method="POST">
        @csrf
        <div class="card border-0 mb-5" style="border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.09);">

            {{-- Card Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center px-4 py-3" style="border-bottom: 1.5px solid #f1f5f9; gap: 10px;">
                <div class="d-flex align-items-center" style="gap: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: {{ $cfg['grad'] }}; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; flex-shrink: 0;">
                        <i class="fa fa-pencil-square-o"></i>
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-0">Form Pengisian Nilai</h5>
                        <small class="text-muted">Tekan <strong>Enter</strong> pada kolom nilai untuk berpindah ke siswa berikutnya.</small>
                    </div>
                </div>
                <button type="button" class="btn btn-sm font-weight-bold" id="btnFillEmpty"
                        style="background: {{ $cfg['light'] }}; color: {{ $cfg['color'] }}; border: none; padding: 8px 16px;">
                    <i class="fa fa-magic mr-1"></i> Isi yang Kosong
                </button>
            </div>

            {{-- Header kolom (desktop only) --}}
            <div class="d-none d-md-flex px-4 py-2" style="background: #f8fafc; border-bottom: 1px solid #f1f5f9; gap: 0;">
                <div style="flex: 0 0 5%; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">No</div>
                <div style="flex: 0 0 15%; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">NISN</div>
                <div style="flex: 1; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Nama Siswa</div>
                <div style="flex: 0 0 15%; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;">Nilai (0–100)</div>
                <div style="flex: 0 0 22%; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Catatan</div>
            </div>

            {{-- List Siswa --}}
            <div id="siswaListContainer">
                @forelse($siswaList as $idx => $s)
                    <div class="siswa-row">
                        <div class="row align-items-center">

                            {{-- Profil --}}
                            <div class="col-12 col-md-7 d-flex align-items-center mb-3 mb-md-0" style="gap: 10px;">
                                <span class="font-weight-bold text-muted" style="font-size: 0.8rem; min-width: 24px; flex-shrink: 0;">{{ $idx + 1 }}.</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($s['nama'] ?? 'Siswa') }}&background={{ ltrim($cfg['light'], '#') }}&color={{ ltrim($cfg['color'], '#') }}&rounded=true&bold=true&size=80"
                                     alt="Foto" class="rounded-circle flex-shrink-0"
                                     style="width: 38px; height: 38px; border: 2px solid {{ $cfg['light'] }};">
                                <div style="min-width: 0;">
                                    <div class="font-weight-bold text-dark" style="font-size: 0.9rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $s['nama'] }}
                                    </div>
                                    <small class="text-muted">{{ $s['nisn'] }} &bull; {{ $s['jenis_kelamin'] }}</small>
                                </div>
                            </div>

                            {{-- Input Nilai --}}
                            <div class="col-6 col-md-2 mb-2 mb-md-0">
                                <div class="d-md-none text-muted mb-1" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Nilai</div>
                                <input type="number"
                                       step="0.01" min="0" max="100"
                                       name="nilai[{{ $s['id_siswa'] }}]"
                                       class="form-control input-nilai"
                                       placeholder="–"
                                       value="{{ $s['nilai'] !== null ? $s['nilai'] : '' }}"
                                       style="padding: 10px 8px;">
                            </div>

                            {{-- Input Catatan --}}
                            <div class="col-6 col-md-3">
                                <div class="d-md-none text-muted mb-1" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Catatan</div>
                                <input type="text"
                                       name="catatan[{{ $s['id_siswa'] }}]"
                                       class="form-control input-catatan"
                                       placeholder="Catatan..."
                                       value="{{ $s['catatan'] ?? '' }}"
                                       style="padding: 10px 12px;">
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fa fa-users text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                        <p class="text-muted">Tidak ada siswa yang terdaftar di kelas ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center px-4 py-3" style="border-radius: 0 0 14px 14px; border-top: 1.5px solid #f1f5f9; gap: 10px;">
                <span class="text-muted small">
                    <i class="fa fa-info-circle mr-1" style="color: {{ $cfg['color'] }};"></i>
                    Jangan lupa klik simpan setelah selesai mengisi.
                </span>
                <button type="button" class="btn font-weight-bold px-4 btn-submit-nilai"
                        style="background: {{ $cfg['grad'] }}; color: #fff; border: none; box-shadow: 0 3px 12px {{ $cfg['color'] }}50; padding: 10px 28px;">
                    <i class="fa fa-save mr-1"></i> Simpan Semua Nilai
                </button>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form      = document.getElementById('formInputNilai');
    const alertBox  = document.getElementById('ajaxAlertContainer');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                      || '{{ csrf_token() }}';

    // Enter key auto-advance
    const inputs = Array.from(document.querySelectorAll('.input-nilai'));
    inputs.forEach((input, index) => {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (index + 1 < inputs.length) {
                    inputs[index + 1].focus();
                    inputs[index + 1].select();
                }
            }
        });
    });

    // Isi nilai kosong
    const btnFillEmpty = document.getElementById('btnFillEmpty');
    if (btnFillEmpty) {
        btnFillEmpty.addEventListener('click', function () {
            const val = prompt('Masukkan nilai untuk semua siswa yang nilainya masih kosong (0 - 100):');
            if (val !== null && val.trim() !== '') {
                const num = parseFloat(val);
                if (isNaN(num) || num < 0 || num > 100) {
                    alert('Nilai harus berupa angka antara 0 hingga 100!');
                    return;
                }
                inputs.forEach(input => {
                    if (input.value === '') input.value = num;
                });
            }
        });
    }

    // Submit AJAX
    document.querySelectorAll('.btn-submit-nilai').forEach(btn => {
        btn.addEventListener('click', async function () {
            document.querySelectorAll('.btn-submit-nilai').forEach(b => {
                b.disabled = true;
                b.innerHTML = '<i class="fa fa-spinner fa-spin mr-1"></i> Menyimpan...';
            });

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: new FormData(form)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    alertBox.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle mr-1"></i> <strong>Berhasil!</strong> ${result.message || 'Nilai siswa berhasil disimpan.'}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>`;
                } else {
                    alertBox.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-triangle mr-1"></i> <strong>Gagal:</strong> ${result.message || 'Gagal menyimpan nilai.'}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>`;
                }
                alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });

            } catch (err) {
                console.error(err);
                alertBox.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle mr-1"></i> Terjadi kesalahan jaringan.
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>`;
            } finally {
                document.querySelectorAll('.btn-submit-nilai').forEach(b => {
                    b.disabled = false;
                    b.innerHTML = '<i class="fa fa-save mr-1"></i> Simpan Semua Nilai';
                });
            }
        });
    });
});
</script>
@endsection
