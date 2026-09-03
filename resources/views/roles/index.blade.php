@extends('main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Data Role</h6>
                <button type="button" class="btn btn-primary btn-sm" id="btnTambahRole">
                    <i class="fa fa-plus"></i> Tambah Role
                </button>
            </div>
            <div class="card-body px-4 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="rolesTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Role</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Permissions</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Role -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="roleForm">
                @csrf
                <input type="hidden" id="role_id" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: kepsek, admin, dll">
                    </div>
                    
                    <div class="form-group mt-3">
                        <label>Pilih Hak Akses (Permissions)</label>
                        <div class="row">
                            @forelse($permissions as $perm)
                            <div class="col-md-4 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input perm-checkbox" id="perm_{{ $perm->id }}" name="permissions[]" value="{{ $perm->name }}">
                                    <label class="custom-control-label" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-muted">Belum ada permission di sistem.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var table = $('#rolesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('roles.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'permissions', name: 'permissions'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#btnTambahRole').click(function() {
            $('#role_id').val('');
            $('#roleForm')[0].reset();
            $('.perm-checkbox').prop('checked', false);
            $('#modalTitle').text('Tambah Role');
            $('#roleModal').modal('show');
        });

        $('body').on('click', '.editRoleBtn', function () {
            var role_id = $(this).data('id');
            $.get("{{ url('roles') }}" +'/' + role_id +'/edit', function (data) {
                $('#modalTitle').text('Edit Role');
                $('#roleForm')[0].reset();
                $('.perm-checkbox').prop('checked', false);
                $('#role_id').val(data.role.id);
                $('#name').val(data.role.name);
                
                // Centang permission yang dimiliki role
                $.each(data.rolePermissions, function(index, val) {
                    $('input[value="'+val+'"]').prop('checked', true);
                });
                
                $('#roleModal').modal('show');
            })
        });

        $('#roleForm').submit(function(e) {
            e.preventDefault();
            var id = $('#role_id').val();
            var url = id ? "{{ url('roles') }}/" + id : "{{ route('roles.store') }}";
            var type = id ? "PUT" : "POST";
            
            var formData = $(this).serialize();

            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    $('#roleModal').modal('hide');
                    table.draw();
                    alert(data.success);
                },
                error: function (data) {
                    console.log('Error:', data);
                    alert(data.responseJSON.error || 'Terjadi kesalahan.');
                }
            });
        });

        $('body').on('click', '.deleteRoleBtn', function () {
            var role_id = $(this).data("id");
            if(confirm("Apakah Anda yakin ingin menghapus role ini?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('roles') }}"+'/'+role_id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        table.draw();
                        alert(data.success);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        alert(data.responseJSON.error || 'Gagal menghapus data.');
                    }
                });
            }
        });
    });
</script>
@endsection
