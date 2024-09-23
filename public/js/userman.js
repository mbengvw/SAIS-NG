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
            { data: "admin", name: "admin" },
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
});
