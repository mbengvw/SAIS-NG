@extends('main')

@section('content')
    <div class="container-fluid" style="width: 80%">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>
                Pengelolaan User Sistem
            </h2>
        </div>
        <div align="right">
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
                            <select id="level" name="level" class="form-control">
                                <option value="0">User Reguler</option>
                                <option value="1">User Admin</option>
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
@endsection

@section('script')
    <script>
        const app_path = {
            base_path: "{{ route('userman.index') }}",
        };
    </script>
    <script src="{{ asset('js/userman.js') }}" defer></script>
@endsection
