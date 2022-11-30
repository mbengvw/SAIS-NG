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
                console.log(response);
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
                            item.nama_lengkap +
                            "</td>\
                        <td>" +
                            item.jk +
                            "</td>\
                        <td>" +
                            item.angkatan +
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
                { data: "id_siswa", name: "id_siswa" },
                { data: "nisn", name: "nisn" },
                { data: "nama_lengkap", name: "nama_lengkap" },
                { data: "jk", name: "jk" },
                { data: "angkatan", name: "angkatan" },
                {
                    data: "checkbox",
                    name: "checkbox",
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        /*------------------------------------------
        Delete Bulk Select Code
        --------------------------------------------*/
        $(document).on("click", "#bulk_pilih", function () {
            let id_kelas = $("#select_kelas").val();
            let id = [];
            if (confirm("Yakin mau dikelaskan?")) {
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
                        success: function (data) {
                            console.log(data);
                            fetchstudent();
                            $(".students_datatable").DataTable().ajax.reload();
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
    }

    $(document).on("click", ".deletebtn", function (e) {
        e.preventDefault();
        let id = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // console.log(id);
        if (confirm("Yakin mau dikeluarkan dari kelas?")) {
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
        }
    });
});
