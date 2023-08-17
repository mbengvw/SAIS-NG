$(document).ready(function () {
    // fetchDataTable();

    $("#showbtn").click(function (e) {
        e.preventDefault();
        fetchstudent();
    });

    function fetchstudent() {
        let id_kelas = $("#select_kelas").val();
        let tahun = $("#select_tahun").val();
        let semester = $("#select_semester").val();
        let tanggal = $("#tanggal").val();
        let nama = $("#nama").val();
        // console.log(tanggal);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/ajax_list_by",
            data: {
                id_kelas: id_kelas,
                tahun: tahun,
                semester: semester,
                tanggal: tanggal,
                nama: nama,
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
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
                        item.nama_lengkap +
                        "</td>\
                    <td>" +
                        item.jk +
                        "</td>\
                    <td>" +
                        item.tanggal +
                        "</td>\
                    <td>" +
                        item.nama_kelas +
                        "</td>\
                    <td>" +
                        item.status +
                        "</td></tr>";
                });
                $("#tbl_kehadiran > tbody").append(content);
            },
            error: function (data) {
                console.log(data);
            },
        });
    }
});
