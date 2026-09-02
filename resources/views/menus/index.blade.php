@extends('main')

@section('content')
<style>
    /* Specific Card Colors to match Dashboard */
    .card-siswa { --card-rgb: 59, 130, 246; --card-color-1: #60a5fa; --card-color-2: #3b82f6; } /* Blue */
    .card-kelas { --card-rgb: 16, 185, 129; --card-color-1: #34d399; --card-color-2: #10b981; } /* Green */
    .card-grouping { --card-rgb: 236, 72, 153; --card-color-1: #f472b6; --card-color-2: #ec4899; } /* Pink */
    .card-tahun { --card-rgb: 245, 158, 11; --card-color-1: #fbbf24; --card-color-2: #f59e0b; } /* Yellow */
    .card-hukdis { --card-rgb: 239, 68, 68; --card-color-1: #f87171; --card-color-2: #ef4444; } /* Red */
    .card-user { --card-rgb: 139, 92, 246; --card-color-1: #a78bfa; --card-color-2: #8b5cf6; } /* Purple */
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold text-dark mb-0">Manajemen Menu</h4>
        <button class="btn btn-primary rounded-pill px-4" onclick="addMenu()">
            <i class="fa fa-plus mr-2"></i>Tambah Menu
        </button>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">Order</th>
                            <th width="10%" class="text-center">Ikon</th>
                            <th width="15%">Grup</th>
                            <th width="20%">Judul Menu</th>
                            <th width="15%">Route</th>
                            <th width="25%">Akses Role</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $m)
                        <tr>
                            <td class="align-middle text-center font-weight-bold">{{ $m->order }}</td>
                            <td class="align-middle text-center">
                                <div class="d-inline-flex align-items-center justify-content-center text-white rounded {{ $m->color_class }}" style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--card-color-1), var(--card-color-2));">
                                    <i class="fa {{ $m->icon }}"></i>
                                </div>
                            </td>
                            <td class="align-middle text-muted">{{ $m->group_name ?? '-' }}</td>
                            <td class="align-middle font-weight-bold text-dark">{{ $m->title }}</td>
                            <td class="align-middle"><code>{{ $m->route_name }}</code></td>
                            <td class="align-middle">
                                @foreach($m->roles as $role)
                                    <span class="badge badge-info px-2 py-1 mb-1">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="align-middle">
                                @if($m->is_active)
                                    <span class="badge badge-success px-2 py-1">Aktif</span>
                                @else
                                    <span class="badge badge-secondary px-2 py-1">Nonaktif</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-sm btn-outline-primary" onclick='editMenu(@json($m), @json($m->roles->pluck("id")))' title="Edit Menu"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteMenu({{ $m->id }})" title="Hapus Menu"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa fa-folder-open-o fa-3x mb-3"></i>
                                <h5>Belum ada menu yang ditambahkan.</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header border-bottom-0 pb-0 mt-2 mx-2">
                <h5 class="modal-title font-weight-bold text-dark" id="modalTitle">Form Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <form id="menuForm">
                    @csrf
                    <input type="hidden" id="menu_id" name="menu_id">
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Judul Menu</label>
                            <input type="text" class="form-control bg-light border-0 py-4" id="title" name="title" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Grup Menu</label>
                            <input type="text" class="form-control bg-light border-0 py-4" id="group_name" name="group_name" placeholder="cth: MASTER DATA">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Route Name</label>
                            <input type="text" class="form-control bg-light border-0" style="height: 45px" id="route_name" name="route_name" placeholder="cth: siswa.index" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Order (Urutan)</label>
                            <input type="number" class="form-control bg-light border-0" style="height: 45px" id="order" name="order" value="1" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Ikon (FontAwesome)</label>
                            <input type="text" class="form-control bg-light border-0" style="height: 45px" id="icon" name="icon" placeholder="cth: fa-users" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold text-muted small text-uppercase">Warna Card</label>
                            <select class="form-control bg-light border-0" style="height: 45px" id="color_class" name="color_class">
                                <option value="card-siswa">Biru (card-siswa)</option>
                                <option value="card-kelas">Hijau (card-kelas)</option>
                                <option value="card-tahun">Kuning (card-tahun)</option>
                                <option value="card-hukdis">Merah (card-hukdis)</option>
                                <option value="card-user">Ungu (card-user)</option>
                                <option value="card-grouping">Pink (card-grouping)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label class="font-weight-bold text-muted small text-uppercase">Hak Akses Role</label>
                        <div class="row px-3 mt-2">
                            @foreach($roles as $role)
                            <div class="custom-control custom-checkbox col-md-6 mb-2">
                                <input type="checkbox" class="custom-control-input role-checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                                <label class="custom-control-label" style="padding-top:2px" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                            <label class="custom-control-label font-weight-bold text-dark" style="padding-top:3px" for="is_active">Menu Aktif</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 mb-2 mx-2">
                <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary rounded-pill px-4" id="btnSave" onclick="saveMenu()">Simpan Menu</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function addMenu() {
        $('#menuForm')[0].reset();
        $('#menu_id').val('');
        $('#modalTitle').text('Tambah Menu Baru');
        $('.role-checkbox').prop('checked', false);
        $('#menuModal').modal('show');
    }

    function editMenu(menu, roleIds) {
        $('#menuForm')[0].reset();
        $('#menu_id').val(menu.id);
        $('#title').val(menu.title);
        $('#group_name').val(menu.group_name);
        $('#route_name').val(menu.route_name);
        $('#order').val(menu.order);
        $('#icon').val(menu.icon);
        $('#color_class').val(menu.color_class);
        $('#is_active').prop('checked', menu.is_active == 1);
        
        $('.role-checkbox').prop('checked', false);
        if(roleIds && roleIds.length > 0) {
            roleIds.forEach(id => {
                $('#role_' + id).prop('checked', true);
            });
        }
        
        $('#modalTitle').text('Edit Menu');
        $('#menuModal').modal('show');
    }

    function saveMenu() {
        let id = $('#menu_id').val();
        let url = id ? `/menus/${id}` : `/menus`;
        let method = id ? 'PUT' : 'POST';
        
        let formData = $('#menuForm').serialize();
        
        $('#btnSave').prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(res) {
                if(res.success) {
                    $('#menuModal').modal('hide');
                    Swal.fire('Berhasil!', res.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    let errStr = '';
                    for(let key in res.errors) { errStr += res.errors[key][0] + '<br>'; }
                    Swal.fire('Error Validasi', errStr, 'error');
                    $('#btnSave').prop('disabled', false).text('Simpan Menu');
                }
            },
            error: function(err) {
                Swal.fire('Error Sistem', 'Terjadi kesalahan sistem.', 'error');
                $('#btnSave').prop('disabled', false).text('Simpan Menu');
            }
        });
    }

    function deleteMenu(id) {
        Swal.fire({
            title: 'Hapus Menu?',
            text: "Data menu ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/menus/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if(res.success) {
                            Swal.fire('Terhapus!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }
</script>
@endsection
