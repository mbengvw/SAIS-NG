@extends('main')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        padding: 20px;
    }

    .app-menu-container {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 10px;
        justify-items: center;
    }
    
    @media (min-width: 576px) {
        .menu-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    @media (min-width: 992px) {
        .menu-grid {
            grid-template-columns: repeat(6, 1fr);
        }
    }

    .app-icon-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        color: #374151;
        width: 100%;
        cursor: pointer;
        transition: transform 0.2s;
    }
    
    .app-icon-link:hover {
        transform: scale(1.05);
    }

    .app-icon-bg {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 8px;
        box-shadow: 0 6px 12px rgba(var(--card-rgb), 0.25);
        background: linear-gradient(135deg, var(--card-color-1), var(--card-color-2));
    }

    .app-icon-label {
        font-size: 0.8rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.2;
        color: #4b5563;
    }

    .status-belum { --card-rgb: 239, 68, 68; --card-color-1: #fca5a5; --card-color-2: #ef4444; } /* Merah */
    .status-diambil { --card-rgb: 245, 158, 11; --card-color-1: #fcd34d; --card-color-2: #f59e0b; } /* Kuning */
    .status-selesai { --card-rgb: 16, 185, 129; --card-color-1: #34d399; --card-color-2: #10b981; } /* Hijau */
</style>

<div class="container-fluid dashboard-wrapper">
    <div class="mb-5 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4 px-2">
            <div>
                <h5 class="font-weight-bold text-dark m-0" style="font-family: 'Inter', sans-serif;">
                    <i class="fa fa-cutlery text-primary mr-2"></i> Dashboard Distribusi MBG
                </h5>
                <small class="text-muted">Klik ikon kelas untuk memproses tray makanan.</small>
            </div>
            <form method="GET" action="{{ route('mbg.index') }}">
                <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="form-control" style="border-radius: 20px; font-weight: 600;" id="current-date">
            </form>
        </div>
        
        <div class="app-menu-container" style="background: #f8fafc; border: 1px solid #e2e8f0;">
            <div class="menu-grid">
                @foreach($list_kelas as $kelas)
                    @php
                        $statusClass = 'status-belum';
                        $statusText = 'Belum Diambil';
                        $statusIcon = 'fa-times';
                        $statusColor = 'text-danger';
                        
                        if ($kelas['status_mbg'] == 'diambil') {
                            $statusClass = 'status-diambil';
                            $statusText = 'Dipinjam';
                            $statusIcon = 'fa-clock-o';
                            $statusColor = 'text-warning';
                        } else if ($kelas['status_mbg'] == 'selesai') {
                            $statusClass = 'status-selesai';
                            $statusText = 'Selesai';
                            $statusIcon = 'fa-check';
                            $statusColor = 'text-success';
                        }
                    @endphp
                    
                    <div class="app-icon-link {{ $statusClass }}" onclick="openMbgModal({{ $kelas['id_kelas'] }}, '{{ $kelas['nama_kelas'] }}', '{{ $kelas['status_mbg'] }}', {{ $kelas['sudah_absen'] ? 'true' : 'false' }})">
                        <div class="app-icon-bg" style="font-size: 0.8rem; font-weight: bold; width: 64px; height: 64px; text-align: center; line-height: 1.2; padding: 4px; word-break: break-all; overflow-wrap: anywhere; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            {{ str_replace('10.', 'X.', str_replace('11.', 'XI.', str_replace('12.', 'XII.', $kelas['nama_kelas']))) }}
                        </div>
                        <div class="app-icon-label" style="margin-top: 5px;">
                            <i class="fa {{ $statusIcon }} {{ $statusColor }}"></i> <span class="{{ $statusColor }} font-weight-bold">{{ $statusText }}</span>
                            @if(!$kelas['sudah_absen'])
                                <div style="font-size: 0.65rem; color: #dc3545; margin-top: 2px; line-height: 1.1;"><i class="fa fa-exclamation-triangle"></i> Absen blm disubmit</div>
                            @else
                                <div style="font-size: 0.65rem; color: #6c757d; margin-top: 2px; line-height: 1.1;">Target: {{ $kelas['target_hadir'] }} Tray</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal MBG -->
<div class="modal fade" id="mbgModal" tabindex="-1" role="dialog" aria-labelledby="mbgModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 15px; border: none; font-family: 'Inter', sans-serif;">
      <div class="modal-header" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
        <h5 class="modal-title font-weight-bold" id="mbgModalLabel">Proses Tray MBG: <span id="modal-kelas-name"></span></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body-content">
        <!-- Loading -->
        <div class="text-center py-4" id="modal-loading">
            <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
            <p class="mt-2">Memuat data...</p>
        </div>
        
        <!-- Form Check-out -->
        <form id="checkoutForm" style="display: none;">
            @csrf
            <input type="hidden" id="co_id_kelas" name="id_kelas">
            <input type="hidden" id="co_tanggal" name="tanggal">
            <input type="hidden" id="co_jumlah_hadir" name="jumlah_hadir">
            
            <div class="alert alert-info" style="border-radius: 10px;">
                <div class="row text-center">
                    <div class="col-6 border-right">
                        <small>Total Siswa</small><br>
                        <strong style="font-size: 1.2rem;" id="txt_total_siswa">-</strong>
                    </div>
                    <div class="col-6">
                        <small>Target Tray (Hadir)</small><br>
                        <strong style="font-size: 1.2rem; color: #0056b3;" id="txt_target_hadir">-</strong>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">Jumlah Tray Diberikan</label>
                <input type="number" class="form-control" id="co_jumlah_diambil" name="jumlah_diambil" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nama Pengambil (Opsional)</label>
                <input type="text" class="form-control" id="co_nama_pengambil" name="nama_pengambil" placeholder="Nama ketua kelas / siswa yang mengambil">
            </div>

            <div id="lock_warning" class="alert alert-danger" style="display: none; border-radius: 10px;">
                <i class="fa fa-lock"></i> <strong>Terkunci!</strong> Absensi kelas belum disubmit.
                @if($is_admin ?? false)
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="co_unlock" value="1">
                    <label class="custom-control-label text-dark" style="font-size: 0.9rem;" for="co_unlock">Buka Kunci (Lanjutkan Tanpa Data Absen)</label>
                </div>
                @else
                <div class="mt-2" style="font-size: 0.85rem;">Hubungi Admin/Kesiswaan untuk membuka kunci.</div>
                @endif
            </div>

            <button type="submit" id="co_btn_submit" class="btn btn-primary btn-block font-weight-bold" style="border-radius: 10px;">Simpan & Checkout Tray</button>
        </form>

        <!-- Form Check-in -->
        <form id="checkinForm" style="display: none;">
            @csrf
            <input type="hidden" id="ci_id_kelas" name="id_kelas">
            <input type="hidden" id="ci_tanggal" name="tanggal">
            
            <div class="alert alert-warning" style="border-radius: 10px;">
                <div class="row text-center">
                    <div class="col-4 border-right">
                        <small>Total Pinjam</small><br>
                        <strong style="font-size: 1.1rem; color: #856404;" id="txt_tray_dipinjam">-</strong>
                    </div>
                    <div class="col-4 border-right">
                        <small>Sdh Kembali</small><br>
                        <strong style="font-size: 1.1rem; color: #28a745;" id="txt_tray_kembali">-</strong>
                    </div>
                    <div class="col-4">
                        <small>Sisa (Max)</small><br>
                        <strong style="font-size: 1.1rem; color: #dc3545;" id="txt_tray_sisa">-</strong>
                    </div>
                </div>
                <div class="text-center mt-2 pt-2 border-top" style="font-size: 0.8rem;" id="txt_info_pengambil"></div>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">Jumlah Tray Dikembalikan Saat Ini</label>
                <input type="number" class="form-control" id="ci_jumlah_kembali" name="jumlah_kembali" required min="0">
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="ci_is_selesai" name="is_selesai" value="1">
                    <label class="custom-control-label" for="ci_is_selesai">Selesaikan (Tidak ada tray lagi yang kembali)</label>
                </div>
            </div>
            <div class="form-group" id="container_keterangan" style="display: none;">
                <label class="font-weight-bold text-danger"><i class="fa fa-exclamation-triangle"></i> Keterangan Selisih/Hilang</label>
                <textarea class="form-control" id="ci_keterangan" name="keterangan" placeholder="Wajib diisi jika ditutup namun tray kurang (hilang/rusak/dkk)." rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block font-weight-bold" style="border-radius: 10px;">Simpan & Selesai</button>
        </form>

        <!-- Summary View (Read Only) -->
        <div id="summaryView" style="display: none;">
            <div class="alert alert-success" style="border-radius: 10px;">
                <div class="text-center mb-3">
                    <i class="fa fa-check-circle fa-3x text-success"></i>
                    <h5 class="mt-2 font-weight-bold">Selesai</h5>
                </div>
                <div class="row text-center">
                    <div class="col-6 border-right">
                        <small>Total Pinjam</small><br>
                        <strong style="font-size: 1.2rem;" id="sum_tray_dipinjam">-</strong>
                    </div>
                    <div class="col-6">
                        <small>Total Kembali</small><br>
                        <strong style="font-size: 1.2rem;" id="sum_tray_kembali">-</strong>
                    </div>
                </div>
                <div class="text-center mt-3 pt-2 border-top" style="font-size: 0.85rem;" id="sum_info_keterangan"></div>
            </div>
            <button type="button" class="btn btn-secondary btn-block font-weight-bold" style="border-radius: 10px;" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    let currentTrayPinjam = 0;

    function openMbgModal(id_kelas, nama_kelas, status, sudah_absen) {
        $('#modal-kelas-name').text(nama_kelas);
        $('#modal-loading').show();
        $('#checkoutForm').hide();
        $('#checkinForm').hide();
        $('#summaryView').hide();
        $('#mbgModal').modal('show');

        let tgl = $('#current-date').val();

        $.ajax({
            url: '/mbg/kelas/' + id_kelas + '?tanggal=' + tgl,
            type: 'GET',
            success: function(res) {
                $('#modal-loading').hide();
                
                if (status === 'belum') {
                    // Checkout Mode
                    $('#co_id_kelas').val(id_kelas);
                    $('#co_tanggal').val(tgl);
                    $('#co_jumlah_hadir').val(res.target_hadir);
                    $('#txt_total_siswa').text(res.total_siswa);
                    $('#txt_target_hadir').text(res.target_hadir);
                    $('#co_jumlah_diambil').val(res.target_hadir);
                    $('#co_nama_pengambil').val('');
                    
                    if (!sudah_absen) {
                        $('#lock_warning').show();
                        $('#co_btn_submit').hide();
                        $('#co_unlock').prop('checked', false);
                    } else {
                        $('#lock_warning').hide();
                        $('#co_btn_submit').show();
                    }
                    
                    $('#checkoutForm').show();
                } else if (status === 'diambil') {
                    // Checkin Mode
                    $('#ci_id_kelas').val(id_kelas);
                    $('#ci_tanggal').val(tgl);
                    
                    currentTrayPinjam = res.trx ? parseInt(res.trx.jumlah_diambil) || 0 : 0;
                    let sudahKembali = res.trx ? parseInt(res.trx.jumlah_kembali) || 0 : 0;
                    let sisaTray = currentTrayPinjam - sudahKembali;
                    let pengambil = res.trx && res.trx.nama_pengambil ? res.trx.nama_pengambil : 'Tidak ada nama';
                    let jam = res.trx && res.trx.waktu_diambil ? res.trx.waktu_diambil : '-';
                    
                    $('#txt_tray_dipinjam').text(currentTrayPinjam);
                    $('#txt_tray_kembali').text(sudahKembali);
                    $('#txt_tray_sisa').text(sisaTray);
                    $('#txt_info_pengambil').html('Diambil oleh: <b>' + pengambil + '</b> pada <b>' + jam + '</b>');
                    
                    $('#ci_jumlah_kembali').attr('max', sisaTray).val(sisaTray);
                    $('#ci_is_selesai').prop('checked', false);
                    $('#container_keterangan').hide();
                    $('#ci_keterangan').removeAttr('required');
                    
                    $('#checkinForm').show();
                } else if (status === 'selesai') {
                    // Summary Mode
                    let pinjam = res.trx ? parseInt(res.trx.jumlah_diambil) || 0 : 0;
                    let kembali = res.trx ? parseInt(res.trx.jumlah_kembali) || 0 : 0;
                    let keterangan = res.trx && res.trx.keterangan ? res.trx.keterangan : 'Tidak ada selisih/catatan.';
                    let pengambil = res.trx && res.trx.nama_pengambil ? res.trx.nama_pengambil : 'Tidak ada nama';
                    let jamPinjam = res.trx && res.trx.waktu_diambil ? res.trx.waktu_diambil : '-';
                    let jamKembali = res.trx && res.trx.waktu_kembali ? res.trx.waktu_kembali : '-';

                    $('#sum_tray_dipinjam').text(pinjam);
                    $('#sum_tray_kembali').text(kembali);
                    
                    let ketHtml = 'Diambil oleh: <b>' + pengambil + '</b> (' + jamPinjam + ')<br>';
                    ketHtml += 'Selesai dikembalikan pada: <b>' + jamKembali + '</b><br><br>';
                    ketHtml += 'Catatan: <i>' + keterangan + '</i>';

                    $('#sum_info_keterangan').html(ketHtml);
                    $('#summaryView').show();
                }
            },
            error: function() {
                alert('Gagal memuat data kelas.');
                $('#mbgModal').modal('hide');
            }
        });
    }

    // Deteksi selisih pada checkin
    function toggleKeterangan() {
        let val = parseInt($('#ci_jumlah_kembali').val()) || 0;
        let sisa = parseInt($('#txt_tray_sisa').text()) || 0;
        let isSelesai = $('#ci_is_selesai').is(':checked');
        
        if (isSelesai && val < sisa) {
            $('#container_keterangan').slideDown();
            $('#ci_keterangan').attr('required', 'required');
        } else {
            $('#container_keterangan').slideUp();
            $('#ci_keterangan').removeAttr('required');
        }
    }

    $('#ci_jumlah_kembali').on('input', toggleKeterangan);
    $('#ci_is_selesai').on('change', toggleKeterangan);

    $('#co_unlock').on('change', function() {
        if ($(this).is(':checked')) {
            $('#co_btn_submit').slideDown();
        } else {
            $('#co_btn_submit').slideUp();
        }
    });

    $('#checkoutForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true).text('Menyimpan...');
        
        $.ajax({
            url: '{{ route("mbg.checkout") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if(res.success) {
                    location.reload();
                } else {
                    alert(res.message);
                    btn.prop('disabled', false).text('Simpan & Checkout Tray');
                }
            },
            error: function() {
                alert('Terjadi kesalahan.');
                btn.prop('disabled', false).text('Simpan & Checkout Tray');
            }
        });
    });

    $('#checkinForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true).text('Menyimpan...');
        
        $.ajax({
            url: '{{ route("mbg.checkin") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if(res.success) {
                    location.reload();
                } else {
                    alert(res.message);
                    btn.prop('disabled', false).text('Simpan & Selesai');
                }
            },
            error: function() {
                alert('Terjadi kesalahan.');
                btn.prop('disabled', false).text('Simpan & Selesai');
            }
        });
    });
</script>
@endsection
