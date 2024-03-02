$(document).ready(function () {
    $("#select_kelas").change(function () {
        fetchstudent();
        // fetchPelanggaran();
    });

    $("#select_nama").change(function () {
        fetchPelanggaran();
    });

    function fetchstudent() {
        let id_kelas = $("#select_kelas").val();
        let tahun = $("#tahun_aktif").val();
        // console.log(tahun);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/ajax_list_siswa_by_tahun",
            data: { id_kelas: id_kelas, tahun: tahun },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $("#select_nama").empty();
                $("#select_nama").append(
                    "<option value=''selected>Pilih Siswa</option>"
                );
                $.each(response.students, function (key, item) {
                    $("#select_nama").append(
                        "<option value='" +
                            item.nama_lengkap +
                            "|" +
                            item.id_grouping +
                            "'>" +
                            item.nama_lengkap +
                            "</option>"
                    );
                });
            },
        });
    }

    function fetchPelanggaran() {
        let id_kelas = $("#select_kelas").val();
        let tahun = $("#tahun_aktif").val();
        let semester = null;
        let tgl = null;
        let raw = $("#select_nama").val();
        let arr = raw.split("|");
        let nama = arr[0];
        /*------------------------------------------
        Pass Header Token
        --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "get",
            url: app_path.base_path + "/ajax_list_by",
            data: {
                id_kelas: id_kelas,
                tahun: tahun,
                semester: semester,
                tanggal: tgl,
                nama: nama,
            },
            dataType: "json",

            success: function (response) {
                // console.log(response);
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
                        "</td>\
                <td> <button type='button' name='delete' value='" +
                        item.id_pelanggaran +
                        "' class='delete btn btn-danger btn-sm'>Delete</button></td>";
                });

                $("#tbl_hukdis > tbody").append(content);
            },
            error: function (data) {
                var errors = data.responseJSON.errors;
                console.log(data);
                // printErrorMsg(errors);
            },
        });
    }

    $("#hukdis_form").on("submit", function (event) {
        event.preventDefault();
        let semester = $("#semester").val();
        let id_hukdis = $("#select_hukdis").val();
        let raw = $("#select_nama").val();
        let arr = raw.split("|");
        let id_grouping = arr[1];
        if (id_hukdis == "" || id_grouping == "" || raw == "") {
            alert("Silahkan lengkapi data terlebih dahulu !");
        } else {
            if (confirm("Yakin mau menyimpan data?")) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: app_path.base_path + "/store",
                    data: {
                        id_hukdis: id_hukdis,
                        id_grouping: id_grouping,
                        semester: semester,
                    },
                    dataType: "json",
                    success: function (data) {
                        fetchPelanggaran();
                    },

                    error: function (data) {
                        // var errors = data.responseJSON.errors;
                        console.log(data);
                    },
                });
            }
        }
    });

    $(document).on("click", ".delete", function (e) {
        e.preventDefault();
        let id_pelanggaran = $(this).val();
        if (confirm("Yakin mau menghapus data?")) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "POST",
                url: app_path.base_path + "/ajaxdestroy",
                dataType: "json",
                data: { id_pelanggaran: id_pelanggaran },
                success: function (response) {
                    // console.log(response.status);
                    if (response.status == "0") {
                        alert("Maaf, hanya admin yang dapat menghapus data!");
                    }

                    fetchPelanggaran();
                },
                error: function (data) {
                    // var errors = data.responseJSON.errors;
                    console.log(data);
                    // printErrorMsg(errors);
                },
            });
        }
    });
});
