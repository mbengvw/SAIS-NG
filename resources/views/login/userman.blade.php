@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Pengelolaan User Sistem
            </h2>
        </div>
        <div align="right">
            <a href="{{ route('userman.download_template') }}" style="margin-bottom: 10px;" class="btn btn-secondary">
                <i class="bi bi-download"></i> Download Template</a>
            <button style="margin-bottom: 10px;" type="button" name="upload_csv" id="upload_csv_btn" class="btn btn-info text-white">
                <i class="bi bi-upload"></i> Upload CSV</button>
            <button style="margin-bottom: 10px;" type="button" name="create_record" id="create_record" class="btn btn-success">
                <i class="bi bi-plus-square"></i> Tambah User</button>
        </div>
        <table class="table table-striped table-bordered user_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th width="180px">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    </div>

    {{-- Modal tambah user --}}
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_heading"></h4>
                </div>
                <div class="modal-body">

                    <form action="javascript:void(0)" id="user_form" name="user_form" class="form-horizontal"
                        method="POST">
                        <input type="hidden" name="id_user" id="id_user">
                        <input type="hidden" name="action" id="action" value="Add" />

                        <div class="form-group mb-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Email Address" />
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <select id="role" name="role" class="form-control">
                                <option value="">-- Pilih Role (Opsional) --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Register</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    {{-- Modal Upload CSV --}}
    <div class="modal fade" id="uploadCsvModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload User (CSV)</h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="csv_form" name="csv_form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="csv_file">File CSV</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv, text/csv" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="upload_role">Default Role (Opsional)</label>
                            <select id="upload_role" name="role" class="form-control">
                                <option value="">-- Pilih Role (Tanpa Role) --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Role ini akan diberikan ke seluruh user dalam file CSV.</small>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block" id="btn_upload_csv">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    {{-- Modal Assign Role --}}
    <div class="modal fade" id="assignRoleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="assignRoleModalHeading">Assign Role</h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="assign_roles_form" name="assign_roles_form" class="form-horizontal" method="POST">
                        <input type="hidden" name="assign_id_user" id="assign_id_user">
                        
                        <div class="form-group mb-3">
                            <label for="assign_roles_select">Pilih Role (Bisa lebih dari satu)</label>
                            <select id="assign_roles_select" name="roles[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block" id="btn_save_roles">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('userman.index') }}",
        };
    </script>
    <script src="{{ asset('js/userman.js') }}" defer></script>
@endsection
