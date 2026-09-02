@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>Master Data Mata Pelajaran</h2>
        </div>
        
        <div align="right">
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record" class="btn btn-success">Tambah Mapel</button>
            <a href="{{ route('admin.dashboard') }}" style="margin-bottom: 10px;" class="exit btn btn-primary">Close</a>
        </div>
        
        <div class="table-wrapper" style="overflow-x:auto;">
            <table class="table table-striped table-bordered mapel_datatable" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Mata Pelajaran</th>
                        <th width="15%">Tingkat</th>
                        <th width="15%">Jurusan</th>
                        <th width="15%">Deskripsi</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah/Edit Mapel --}}
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Mapel</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Nama Mapel : </label>
                            <div class="col-md-12">
                                <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Tingkat : </label>
                            <div class="col-md-12">
                                <select name="tingkat" id="tingkat" class="form-control">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Jurusan : </label>
                            <div class="col-md-12">
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="BAHASA">BAHASA</option>
                                    <option value="KEAGAMAAN">KEAGAMAAN</option>
                                    <option value="Umum">Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label col-md-12">Deskripsi : </label>
                            <div class="col-md-12">
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
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
<script>
    $(document).ready(function() {
        var table = $('.mapel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.mapel.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_mapel', name: 'nama_mapel' },
                { data: 'tingkat', name: 'tingkat' },
                { data: 'jurusan', name: 'jurusan' },
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#create_record').click(function() {
            $('.modal-title').text("Tambah Data Mapel");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('master.mapel.add') }}",
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
                url: "{{ url('master/mapel/show') }}",
                method: "GET",
                data: { id: id },
                dataType: "json",
                success: function(data) {
                    $('#nama_mapel').val(data.nama_mapel);
                    $('#tingkat').val(data.tingkat);
                    $('#jurusan').val(data.jurusan);
                    $('#deskripsi').val(data.deskripsi);
                    $('#id').val(id);
                    $('.modal-title').text("Edit Data Mapel");
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
                url: "{{ route('master.mapel.destroy') }}",
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
