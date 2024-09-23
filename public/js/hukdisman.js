$(document).ready(function () {
    $("#showbtn").click(function (e) {
        e.preventDefault();
        fetchHukdis();
    });

    function fetchHukdis() {
        let id_kelas = $("#select_kelas").val();
        // alert(id_kelas);
        let tahun = $("#select_tahun").val();
        let semester = $("#select_semester").val();
        let tgl = null;
        let nama = $("#nama").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: app_path.base_path + "/list_by",
            data: {
                id_kelas: id_kelas,
                tahun: tahun,
                semester: semester,
                tanggal: tgl,
                nama: nama,
            },
            dataType: "json",

            success: function (response) {
                console.log(response);
                $("#tbl_hukdis > tbody").html("");
                let no = 0;
                let content = "";
                $.each(response, function (key, item) {
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
                        item.nama_kelas +
                        "</td>\
                <td>" +
                        item.tahun_akademik +
                        "</td>\
                <td>" +
                        item.semester +
                        "</td>\
                <td>" +
                        item.tanggal +
                        "</td>\
                <td>" +
                        item.deskripsi +
                        "</td>\
                <td>" +
                        item.poin +
                        "</td>";
                });

                $("#tbl_hukdis > tbody").append(content);
            },
            error: function (data) {
                // var errors = data.responseJSON.errors;
                console.log(data);
                // printErrorMsg(errors);
            },
        });
    }
});
