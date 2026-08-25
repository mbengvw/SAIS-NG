$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let table = $(".user_datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: app_path.base_path,
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "roles_list", name: "roles_list" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("body").on("click", ".delete", function () {
        let id = this.id;
        // alert(id);
        let confirmed = confirm("Anda yakin mau menghapus data ?");
        if (confirmed) {
            $.ajax({
                type: "POST",
                url: app_path.base_path + "/destroy/" + id,
                success: function (data) {
                    console.log(data);
                    table.draw();
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }
    });

    $("#create_record").click(function () {
        $("#id_user").val("");
        $("#user_form").trigger("reset");
        $("#action").val("Add");
        $("#ajaxModal").modal("show");
        $("#modal_heading").html("Tambah User");
    });

    $("body").on("click", ".edit", function () {
        let id = this.id;

        let confirmed = confirm("Anda yakin mau mereset password ?");
        if (confirmed) {
            $.ajax({
                type: "POST",
                url: app_path.base_path + "/reset/" + id,
                success: function (data) {
                    console.log(data);
                    table.draw();
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }
    });

    $("#user_form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            type: "post",
            url: app_path.base_path + "/store",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                $("#user_form").trigger("reset");
                $("#ajaxModal").modal("hide");
                table.draw();
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    $("#upload_csv_btn").click(function () {
        $("#csv_form").trigger("reset");
        $("#uploadCsvModal").modal("show");
    });

    $("#csv_form").on("submit", function (event) {
        event.preventDefault();
        
        let formData = new FormData(this);
        let btn = $("#btn_upload_csv");
        btn.prop('disabled', true).text('Uploading...');

        $.ajax({
            type: "POST",
            url: app_path.base_path + "/upload-csv",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#csv_form").trigger("reset");
                $("#uploadCsvModal").modal("hide");
                table.draw();
                alert(data.success || 'Upload berhasil');
            },
            error: function (data) {
                console.log(data);
                alert('Terjadi kesalahan saat upload');
            },
            complete: function() {
                btn.prop('disabled', false).text('Upload');
            }
        });
    });

    $("body").on("click", ".assign-role", function () {
        let id = this.id;
        let name = $(this).data("name");

        $("#assign_id_user").val(id);
        $("#assignRoleModalHeading").html("Assign Role: " + name);
        $("#assign_roles_select").val(null).trigger("change"); // clear select2

        // Fetch user roles
        $.get(app_path.base_path + "/roles/" + id, function (data) {
            $("#assign_roles_select").val(data).trigger("change"); // update select2
            $("#assignRoleModal").modal("show");
        });
    });

    $("#assign_roles_form").on("submit", function (event) {
        event.preventDefault();
        
        let id = $("#assign_id_user").val();
        let btn = $("#btn_save_roles");
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            type: "POST",
            url: app_path.base_path + "/assign-roles/" + id,
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                $("#assignRoleModal").modal("hide");
                table.draw();
                alert(data.success || 'Role berhasil diperbarui');
            },
            error: function (data) {
                console.log(data);
                alert('Terjadi kesalahan saat menyimpan role');
            },
            complete: function() {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });
});
