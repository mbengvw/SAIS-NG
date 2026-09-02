@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>Master Penetapan Guru Mapel</h2>
        </div>
        
        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record" class="btn btn-success">Tambah Penetapan</button>
            <a href="{{ route('admin.dashboard') }}" style="margin-bottom: 10px;" class="exit btn btn-primary">Close</a>
        </div>
        
        <div class="table-wrapper" style="overflow-x:auto;">
            <table class="table table-striped table-bordered penetapan_datatable" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Kelas</th>
                        <th width="25%">Mata Pelajaran</th>
                        <th width="25%">Guru</th>
                        <th width="15%">Tahun Ajaran</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah/Edit --}}
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Penetapan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Mata Pelajaran : </label>
                            <div class="col-md-12">
                                <select name="id_mapel" id="id_mapel" class="form-control" required>
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Kelas : </label>
                            <div class="col-md-12" id="kelas_container">
                                <span class="text-muted small">Pilih mata pelajaran terlebih dahulu</span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Guru : </label>
                            <div class="col-md-12">
                                <select name="id_guru" id="id_guru" class="form-control select2" style="width: 100%;" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <br />
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="id" id="id" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 align="center" style="margin:0;">Apakah anda yakin ingin menghapus data ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#id_guru').select2({
            dropdownParent: $('#formModal'),
            placeholder: '-- Pilih Guru --',
            allowClear: true,
            width: '100%'
        });

        var table = $('.penetapan_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.penetapan.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas' },
                { data: 'mapel.nama_mapel', name: 'mapel.nama_mapel' },
                { data: 'guru.name', name: 'guru.name' },
                { data: 'tahun.alias_tahun', name: 'tahun.alias_tahun' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#id_mapel').change(function() {
            var id_mapel = $(this).val();
            var action = $('#action').val();
            if(action == 'Add') {
                if (id_mapel) {
                    $('#kelas_container').html('<span class="text-muted small">Loading...</span>');
                    $.ajax({
                        url: "{{ route('master.penetapan.get_kelas') }}",
                        method: "GET",
                        data: { id_mapel: id_mapel },
                        dataType: "json",
                        success: function(data) {
                            var html = '<div class="row">';
                            if (data.length > 0) {
                                $.each(data, function(index, kelas) {
                                    html += '<div class="col-md-4 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="id_kelas[]" value="' + kelas.id_kelas + '" id="chk_' + kelas.id_kelas + '"><label class="form-check-label" for="chk_' + kelas.id_kelas + '">' + kelas.nama_kelas + '</label></div></div>';
                                });
                            } else {
                                html = '<div class="col-12"><span class="text-danger small">Tidak ada kelas yang cocok.</span></div>';
                            }
                            html += '</div>';
                            $('#kelas_container').html(html);
                        }
                    });
                } else {
                    $('#kelas_container').html('<span class="text-muted small">Pilih mata pelajaran terlebih dahulu</span>');
                }
            }
        });

        $('#create_record').click(function() {
            $('.modal-title').text("Tambah Penetapan");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#sample_form')[0].reset();
            $('#id_guru').val('').trigger('change');
            $('#id_mapel').prop('disabled', false);
            $('#kelas_container').html('<span class="text-muted small">Pilih mata pelajaran terlebih dahulu</span>');
            $('#hidden_mapel').remove();
            $('#form_result').html('');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('master.penetapan.add') }}",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        table.ajax.reload();
                        setTimeout(function(){
                            $('#formModal').modal('hide');
                        }, 1500);
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ url('master/penetapan-guru-mapel/show') }}",
                method: "GET",
                data: { id: id },
                dataType: "json",
                success: function(data) {
                    $('#id_mapel').val(data.id_mapel).prop('disabled', true);
                    if($('#hidden_mapel').length == 0) {
                        $('<input>').attr({type: 'hidden', id: 'hidden_mapel', name: 'id_mapel'}).appendTo('#sample_form');
                    }
                    $('#hidden_mapel').val(data.id_mapel);

                    $('#id_guru').val(data.id_guru).trigger('change');
                    $('#id').val(id);
                    
                    var kelasName = data.kelas ? data.kelas.nama_kelas : 'Kelas Terpilih';
                    var html = '<div class="form-check"><input class="form-check-input" type="checkbox" checked disabled><input type="hidden" name="id_kelas[]" value="' + data.id_kelas + '"><label class="form-check-label">' + kelasName + ' (Hanya edit guru)</label></div>';
                    $('#kelas_container').html(html);

                    $('.modal-title').text("Edit Penetapan");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            });
        });

        var id_delete;
        $(document).on('click', '.delete', function() {
            id_delete = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: "{{ route('master.penetapan.destroy') }}",
                method: "DELETE",
                data: {
                    id: id_delete,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        table.ajax.reload();
                    }, 500);
                }
            });
        });
    });
</script>
@endsection
