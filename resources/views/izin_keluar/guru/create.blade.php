@extends('main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold mb-1">Form Pengajuan Izin Keluar</h3>
            <h6 class="text-muted mb-0">Berikan izin keluar pada siswa yang Anda setujui</h6>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <form action="{{ route('guru.izin_keluar.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Pilih Siswa <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="id_siswa" name="id_siswa" required></select>
                            <input type="hidden" id="id_kelas" name="id_kelas">
                            <small class="text-muted">Ketik nama siswa untuk mencari.</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Alasan Keluar <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alasan" rows="3" required placeholder="Contoh: Mengambil barang yang tertinggal di rumah, acara keluarga, dll."></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_pulang" name="is_pulang" value="1">
                                <label class="custom-control-label text-danger font-weight-bold" for="is_pulang">
                                    Izin Pulang (Siswa sakit / izin pulang tidak akan kembali lagi ke sekolah hari ini)
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('guru.izin_keluar.index') }}" class="btn btn-secondary shadow-sm" style="border-radius: 10px;">Batal</a>
                            <button type="submit" class="btn btn-primary shadow-sm" style="border-radius: 10px;">
                                <i class="fa fa-paper-plane"></i> Ajukan Izin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_siswa').select2({
            placeholder: "Ketik nama siswa...",
            minimumInputLength: 2,
            ajax: {
                url: '{{ route("guru.izin_keluar.search") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });

        $('#id_siswa').on('select2:select', function (e) {
            var data = e.params.data;
            $('#id_kelas').val(data.id_kelas);
        });
    });
</script>
@endsection
