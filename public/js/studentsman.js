$(document).ready(function () {
    // fetchDataTable();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    let table = $(".students_datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: path.base_path,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        },
        columns: [
            { data: "id" },
            { data: "nama" },
            { data: "nisn" },
            { data: "tahun_masuk" },
            { data: "tempat_lahir" },
            { data: "tanggal_lahir" },
            { data: "status" },
            { data: "jenis_kelamin" },
            { data: "alamat" },

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

    $(document).on("click", "#bulk_delete", function () {
        let id = [];
        if (confirm("Are you sure you want to Delete this data?")) {
            $(".users_checkbox:checked").each(function () {
                id.push($(this).val());
            });
            if (id.length > 0) {
                $.ajax({
                    url: path.removeall_path,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    method: "get",
                    data: { id: id },
                    success: function (data) {
                        console.log(data);
                        alert(data);
                        window.location.assign("siswa");
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    },
                });
            } else {
                alert("Please select atleast one checkbox");
            }
        }
    });

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
            $("#nama_siswa").val(data.nama);
            $("#nik").val(data.nik);
            $("#nisn").val(data.nisn);
            $("#tahun_masuk").val(data.tahun_masuk);
            $("#tempat_lahir").val(data.tempat_lahir);
            $("#tanggal_lahir").val(data.tanggal_lahir);
            $("#alamat").val(data.alamat);
            $("#jenis_kelamin").val(data.jenis_kelamin);
            $("#nama_ayah").val(data.nama_ayah);
            $("#nama_ibu").val(data.nama_ibu);
            $("#nama_wali").val(data.nama_wali);
        });
        // $("#student_form").trigger("reset");
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
                alert("Data berhasil disimpan");
                $("#student_form").trigger("reset");
                $("#ajaxModal").modal("hide");
                table.draw();
            },
            error: function (data) {
                alert("Data gagal disimpan");
                console.log(data);
            },
        });
    });
});
