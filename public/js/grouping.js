$(document).ready(function () {
    fetchDataTable();

    $("#select_kelas").change(function () {
        fetchstudent();
    });

    function fetchstudent() {
        let id_kelas = $("#select_kelas").val();
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/ajaxbykelas",
            data: { id_kelas: id_kelas },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $("#tbl_grouping > tbody").html("");
                let no = 0;
                $.each(response.students, function (key, item) {
                    no = no + 1;
                    $("#tbl_grouping > tbody").append(
                        "<tr>\
                        <td>" +
                            no +
                            "</td>\
                        <td>" +
                            item.id +
                            "</td>\
                        <td>" +
                            item.nama +
                            "</td>\
                        <td>" +
                            item.jenis_kelamin +
                            "</td>\
                        <td>" +
                            item.tahun_masuk +
                            "</td>\
                        <td>" +
                            item.nama_kelas +
                            '</td>\
                        <td><button type="button" value="' +
                            item.id_grouping +
                            '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                    </tr>'
                    );
                });
            },
        });
    }

    function fetchDataTable() {
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
        let table = $(".students_datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: app_path.base_path,
            columns: [
                { data: "id"},
                { data: "nisn" },
                { data: "nama"},
                { data: "jenis_kelamin"},
                { data: "tahun_masuk"},
                {
                    data: "checkbox",
                    name: "checkbox",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    $(document).on("click", "#bulk_pilih", function () {
        let id_kelas = $("#select_kelas").val();
        let id = [];
        $(".users_checkbox:checked").each(function () {
            id.push($(this).val());
        });
        if (id.length > 0) {
            $.ajax({
                url: app_path.base_path + "/createall",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                method: "get",
                data: { list_id: id, id_kelas: id_kelas },
                beforeSend: function () {
                    $("#bulk_pilih")
                        .attr("disabled", true)
                        .html("Processing...");
                },
                success: function (data) {
                    // console.log(data);
                    $("#bulk_pilih").attr("disabled", false).html("Kelaskan");
                    fetchstudent();
                    $(".students_datatable").DataTable().ajax.reload();
                },
                error: function (data) {
                    console.log(data);
                    $("#bulk_pilih").attr("disabled", false).html("Kelaskan");
                },
            });
        } else {
            alert("Please select atleast one checkbox");
        }
    });

    $(document).on("click", ".deletebtn", function (e) {
        e.preventDefault();
        let id = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // console.log(id);
        $.ajax({
            type: "POST",
            url: app_path.base_path + "/ajaxdestroy",
            dataType: "json",
            data: { id: id },
            success: function (response) {
                alert(response.message);
                fetchstudent();
                $(".students_datatable").DataTable().ajax.reload();
            },
        });
    });
});
