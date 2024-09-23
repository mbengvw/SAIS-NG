@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card" style="margin-top: 50px;">
                    <div class="card-header">
                        Profile User
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl_kehadiran">
                            <tbody>
                                <tr>
                                    <td>ID User</td>
                                    <td>{{ $id }} <input type="text" value="{{ $id }}" id="my_id"
                                            hidden>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td>Email/Username</td>
                                    <td>{{ $email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" style="margin-top: 20px;" id="btn_change_password">Ganti
                        Password</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ajaxModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_heading"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="pass_form" name="pass_form" class="form-horizontal"
                            method="POST">
                            <div class="form-group">
                                Password Baru:<br>
                                <input type="text" class="form-control" id="new_pass" name="new_pass">
                            </div>

                            <input type="submit" class="btn btn-primary" id="btn_simpan" name="btn_simpan" value="Simpan">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $("#btn_change_password").click(function() {
            $("#ajaxModal").modal("show");
        });

        $("#btn_simpan").click(function() {
            let id = $("#my_id").val();
            let new_pass = $("#new_pass").val();
            if (confirm("Yakin mau menyimpan data?")) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.change_pass') }}",
                    data: {
                        id: id,
                        new_pass: new_pass,
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#pass_form").trigger("reset");
                        $("#ajaxModal").modal("hide");
                        // console.log(data);
                        alert("Password berhasil dirubah !")
                    },

                    error: function(data) {
                        alert("Password harus diisi minimal 4 karakter !")
                        console.log(data);
                    },
                });
            }
        });
    </script>
@endsection
