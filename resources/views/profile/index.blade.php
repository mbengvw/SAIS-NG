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
                                    <td>
                                        <span id="display_name">{{ $name }}</span>
                                        <button class="btn btn-sm btn-outline-primary ml-2" id="btn_edit_name">Edit</button>
                                    </td>
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
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modal_heading">Ubah Password</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="pass_form" name="pass_form" class="form-horizontal">
                            
                            <div class="form-group">
                                <label for="old_pass" class="font-weight-bold">Password Lama:</label>
                                <input type="password" class="form-control" id="old_pass" name="old_pass" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="new_pass" class="font-weight-bold">Password Baru:</label>
                                <input type="password" class="form-control" id="new_pass" name="new_pass" required minlength="6">
                            </div>

                            <div class="form-group">
                                <label for="new_pass_confirmation" class="font-weight-bold">Konfirmasi Password Baru:</label>
                                <input type="password" class="form-control" id="new_pass_confirmation" name="new_pass_confirmation" required minlength="6">
                            </div>

                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="nameModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Ubah Nama</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="name_form" class="form-horizontal">
                            <div class="form-group">
                                <label for="new_name" class="font-weight-bold">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="new_name" name="new_name" required value="{{ $name }}">
                            </div>
                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="btn_simpan_name">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#btn_change_password").click(function() {
            $("#pass_form").trigger("reset");
            $("#ajaxModal").modal("show");
        });

        $("#pass_form").submit(function(e) {
            e.preventDefault();
            
            let old_pass = $("#old_pass").val();
            let new_pass = $("#new_pass").val();
            let new_pass_confirmation = $("#new_pass_confirmation").val();

            if (new_pass !== new_pass_confirmation) {
                Swal.fire('Error', 'Konfirmasi password baru tidak cocok!', 'error');
                return;
            }

            let btn = $("#btn_simpan");
            let originalText = btn.html();
            btn.html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                type: "POST",
                url: "{{ route('profile.change_pass') }}",
                data: {
                    old_pass: old_pass,
                    new_pass: new_pass,
                    new_pass_confirmation: new_pass_confirmation
                },
                dataType: "json",
                success: function(data) {
                    $("#pass_form").trigger("reset");
                    $("#ajaxModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    let errorMessage = "Terjadi kesalahan.";
                    if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    Swal.fire('Gagal', errorMessage, 'error');
                },
                complete: function() {
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });

        $("#btn_edit_name").click(function() {
            $("#nameModal").modal("show");
        });

        $("#name_form").submit(function(e) {
            e.preventDefault();
            
            let new_name = $("#new_name").val();

            let btn = $("#btn_simpan_name");
            let originalText = btn.html();
            btn.html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                type: "POST",
                url: "{{ route('profile.update_name') }}",
                data: {
                    name: new_name,
                },
                dataType: "json",
                success: function(data) {
                    $("#nameModal").modal("hide");
                    $("#display_name").text(data.name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    let errorMessage = "Terjadi kesalahan.";
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    Swal.fire('Gagal', errorMessage, 'error');
                },
                complete: function() {
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    </script>
@endsection
