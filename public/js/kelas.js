$(document).ready(function () {
    fetchKelas();

    $("#create_record").click(function () {
        $("#id_kelas").val("");
        $("#form_kelas").trigger("reset");
        $("#modal_heading").text("Tambah Data Kelas Baru");

        $("#modal_add_edit").modal("show");
    });

    $("#form_kelas").on("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        // console.log(formData);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: app_path.base_path,
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $("#simpan").attr("disabled", true).html("Processing...");
            },
            success: function (data) {
                $("#form_kelas").trigger("reset");
                $("#simpan").attr("disabled", false).html("Simpan Data");

                $("#modal_add_edit").modal("hide");
                fetchKelas();
            },
            error: function (data) {
                // var errors = data.responseJSON.errors;
                console.log(data.responseText);
                $("#simpan").attr("disabled", false).html("Simpan Data");
            },
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html("");
            $(".print-error-msg").css("display", "block");
            $.each(msg, function (key, value) {
                $(".print-error-msg")
                    .find("ul")
                    .append("<li>" + value + "</li>");
            });
        }
    });

    $("body").on("click", ".edit", function () {
        let id_kelas = this.id;
        $("#id_kelas").val(id_kelas);
        $("#modal_heading").text("Edit Data Kelas");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/show",
            data: { id: id_kelas },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $("#jurusan").val(data.jurusan);
                $("#tingkat").val(data.tingkat);
                $("#paralel").val(data.paralel);
                $("#nama_kelas").val(data.nama_kelas);
                $("#modal_add_edit").modal("show");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    // Ajax delete single record
    $("body").on("click", ".delete", function () {
        let id_kelas = this.id;
        // alert(id_kelas);
        let confirmed = confirm("Apakah anda yaki data akan dihapus ?");
        if (confirmed) {
            $.ajax({
                type: "DELETE",
                url: app_path.base_path,
                data: { id: id_kelas },
                success: function (data) {
                    alert(data.message);
                    fetchKelas();
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }
    });

    function fetchKelas() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let table = $(".kelas_datatable").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: app_path.base_path,
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "jurusan", name: "jurusan" },
                { data: "tingkat", name: "tingkat" },
                { data: "paralel", name: "paralel" },
                { data: "nama_kelas", name: "nama_kelas" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    $("body").on("click", ".exit", function () {
        window.location.replace(app_path.dashboard_path);
    });
});
