@extends('main')

@section('content')
<style>
    .profile-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 15px;
        color: white;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #10b981;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin: 0 auto;
    }
    
    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
    }
</style>

<div class="container-fluid" style="margin-top: 25px;">
    <!-- Profile Header -->
    <div class="row">
        <div class="col-12">
            <div class="profile-header text-center text-md-left d-md-flex align-items-center">
                <div class="mr-md-4 mb-3 mb-md-0">
                    <div class="profile-avatar" style="overflow: hidden;">
                        @if($student->foto)
                            <img src="{{ asset($student->foto) }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fa fa-user"></i>
                        @endif
                    </div>
                </div>
                <div>
                    <h2 class="font-weight-bold mb-1">{{ $student->nama }}</h2>
                    <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">
                        NISN: {{ $student->nisn }} | NIK: {{ $student->nik }}
                    </p>
                    <span class="badge badge-light mt-2 px-3 py-2 text-success" style="font-size: 0.9rem;">Status: {{ $student->status === 'A' || $student->status === 'Aktif' ? 'Aktif' : 'Non-Aktif' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold border-bottom-0" style="border-radius: 15px 15px 0 0; padding: 20px 20px 0;">
                    <h5 class="mb-0"><i class="fa fa-edit text-success mr-2"></i> Update Data Pribadi</h5>
                </div>
                <div class="card-body p-4">
                    <form id="form-update-profile" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label class="text-muted font-weight-bold">Foto Profil</label>
                                <input type="file" class="form-control" name="foto" accept="image/*">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="text-muted font-weight-bold">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $student->tempat_lahir }}" placeholder="Contoh: Kuningan">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="text-muted font-weight-bold">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ $student->tanggal_lahir }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="text-muted font-weight-bold">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin">
                                    <option value="L" {{ $student->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $student->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="text-muted font-weight-bold">Tahun Masuk</label>
                                <input type="text" class="form-control" value="{{ $student->tahun_masuk }}" readonly disabled>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-muted font-weight-bold">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ $student->alamat }}</textarea>
                        </div>

                        <hr class="my-4">
                        <h6 class="font-weight-bold text-success mb-3">Data Orang Tua / Wali</h6>

                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label class="text-muted font-weight-bold">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah" value="{{ $student->nama_ayah }}">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label class="text-muted font-weight-bold">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu" value="{{ $student->nama_ibu }}">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label class="text-muted font-weight-bold">Nama Wali</label>
                                <input type="text" class="form-control" name="nama_wali" value="{{ $student->nama_wali }}">
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-success px-4" id="btn-save" style="border-radius: 8px;">
                                <i class="fa fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#form-update-profile').on('submit', function(e) {
        e.preventDefault();
        
        let btn = $('#btn-save');
        let originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);
        
        let formData = new FormData(this);

        $.ajax({
            url: '{{ route("siswa.profile.update") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'Terjadi kesalahan pada server. Silakan coba lagi.', 'error');
            },
            complete: function() {
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
});
</script>
@endsection
