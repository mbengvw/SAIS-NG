$(document).ready(function () {
    fetchDataTable();

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

    function fetchDataTable() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let table = $(".students_datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: path.base_path,
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            },
            columns: [
                { data: "id" },
                { data: "nama" },
                { data: "nisn" },
                // { data: "nik" },
                { data: "tahun_masuk" },
                { data: "tempat_lahir" },
                { data: "tanggal_lahir" },
                { data: "status" },
                { data: "jenis_kelamin" },
                { data: "alamat" },
                // { data: "nama_ayah" },
                // { data: "nama_ibu" },
                // { data: "nama_wali" },
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
    }
});

