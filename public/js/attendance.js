$(document).ready(function () {
    fetchstudent();

    $("#select_kelas").change(function () {
        fetchstudent();
    });

    function fetchstudent() {
        let id_kelas = $("#select_kelas").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/ajaxkelastanggal",
            data: { id_kelas: id_kelas },
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#tbl_kehadiran > tbody").html("");
                let no = 0;
                let content = "";
                $.each(response.students, function (key, item) {
                    no = no + 1;
                    content +=
                        "<tr>\
                    <td>" +
                        no +
                        "</td>\
                    <td>" +
                        item.nama +
                        "</td>\
                    <td>" +
                        item.jenis_kelamin +
                        "</td>\
                    <td><input type='radio' id='S-" +
                        item.id_grouping +
                        "' name='status" +
                        item.id_grouping +
                        "' value='S-" +
                        item.id_grouping +
                        "' class='radio-presensi'";
                    if (item.status == "S") {
                        content += "checked>";
                    }else{
                        content += ">";
                    }

                    content +=
                        "</td>\
                    <td><input type='radio' id='I-" +
                        item.id_grouping +
                        "' name='status" +
                        item.id_grouping +
                        "' value='I-" +
                        item.id_grouping +
                        "' class='radio-presensi'";
                    if (item.status == "I") {
                        content += "checked>";
                    }else{
                        content += ">";
                    }
                    content +=
                        "</td>\
                    <td><input type='radio' id='A-" +
                        item.id_grouping +
                        "' name='status" +
                        item.id_grouping +
                        "' value='A-" +
                        item.id_grouping +
                        "' class='radio-presensi'";
                    if (item.status == "A") {
                        content += "checked>";
                    }else{
                        content += ">";
                    }
                    content += "</td>";
                    content +=
                        "<td><input type='text' id='ket-" +
                        item.id_grouping +
                        "' value='";
                    if (item.keterangan != null) {
                        content += item.keterangan;
                    }else{
                        content += "";
                    }

                    content += "'></td>";
                    content +=
                        "<td><button type='button' class='btn btn-danger deletebtn' value='delete-" +
                        item.id_kehadiran +
                        "'>Delete</button></td></tr>";
                });
                $("#tbl_kehadiran > tbody").append(content);
            },
        });
    }

    $(document).on("click", ".deletebtn", function (e) {
        e.preventDefault();
        let mydata = $(this).val();
        // console.log(mydata);
        let array_data = mydata.split("-");
        let id_kehadiran = array_data[1];
        if (id_kehadiran != "null") {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "DELETE",
                url: app_path.base_path,
                dataType: "json",
                data: { id_kehadiran: id_kehadiran },
                success: function (response) {
                    fetchstudent();
                },
            });
        }
    });

    $(document).on("click", ".radio-presensi", function () {
        // e.preventDefault();
        let mydata = $(this).val();
        let arr_data = mydata.split("-");
        let status = arr_data[0];
        let id_grouping = arr_data[1];
        let keterangan = $("#ket-" + id_grouping).val();
        // console.log(keterangan);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: app_path.base_path,
            dataType: "json",
            data: {
                status: status,
                id_grouping: id_grouping,
                keterangan: keterangan,
            },
            success: function (response) {
                fetchstudent();
            },
        });
    });
});
