$(document).ready(function () {
    /*------------------------------------------
    Pass Header Token
    --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    /*------------------------------------------
    Render DataTable
    --------------------------------------------*/
    let table = $(".hukdis_datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: path.base_path,
        columns: [
            { data: "id_siswa", name: "id_siswa" },
            { data: "no_daftar", name: "no_daftar" },
            { data: "nis", name: "nis" },
            { data: "nisn", name: "nisn" },
            { data: "nama_lengkap", name: "nama_lengkap" },
            { data: "jk", name: "jk" },
            { data: "angkatan", name: "angkatan" },
            { data: "jalur", name: "jalur" },
            { data: "asal_sltp", name: "asal_sltp" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
            {
                data: "checkbox",
                name: "checkbox",
                orderable: false,
                searchable: false,
            },
        ],
    });

    /*------------------------------------------
    Delete Single Student Code
    --------------------------------------------*/
    $("body").on("click", ".delete", function () {
        let student_id = this.id;
        // alert(student_id);
        let confirmed = confirm("Are You sure want to delete !");
        if (confirmed) {
            $.ajax({
                type: "POST",
                url: path.base_path + "/destroy/" + student_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }
    });

    /*------------------------------------------
    Add/Eit student code
    --------------------------------------------*/

    $("#create_record").click(function () {
        $("#id_siswa").val("");
        $("#student_form").trigger("reset");
        $("#action").val("Add");
        $("#ajaxModal").modal("show");
        $("#modal_heading").html("Tambah Siswa");
    });

    $("body").on("click", ".edit", function () {
        let student_id = this.id;
        let show_path = path.base_path + "/" + student_id;

        $("#id_siswa").val(student_id);
        //ambil data detail siswa pake jquery get()
        $.get(show_path, function (data) {
            $("#modal_heading").html("Edit Siswa");
            $("#action").val("Edit");
            $("#no_daftar").val(data.no_daftar);
            $("#nis").val(data.nis);
            $("#nisn").val(data.nisn);
            $("#nama").val(data.nama_lengkap);
            $("#jk").val(data.jk);
            $("#angkatan").val(data.angkatan);
            $("#jalur").val(data.jalur);
            $("#asal_sltp").val(data.asal_sltp);
        });
        $("#student_form").trigger("reset");
        $("#ajaxModal").modal("show");
    });

    $("#student_form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            type: "post",
            url: path.base_path + "/store",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                $("#student_form").trigger("reset");
                $("#ajaxModal").modal("hide");
                table.draw();
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
            },
        });
    });
});
