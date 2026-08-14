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
                            item.nama +
                            "|" +
                            item.id_grouping +
                            "'>" +
                            item.nama +
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
                let container = $("#history_container");
                container.html("");
                
                if (response.length === 0) {
                    container.html('<div class="text-center text-muted" style="padding: 20px;">Belum ada riwayat pelanggaran.</div>');
                    return;
                }

                let content = "";
                $.each(response, function (key, item) {
                    content += `
                    <div class="card student-card" style="margin-bottom: 12px; border-left: 5px solid #e74c3c; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div class="card-body" style="padding: 15px; display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div style="font-weight: 800; font-size: 1.1rem; color: #2c3e50; line-height: 1.3;">${item.deskripsi}</div>
                                <div style="font-size: 0.9rem; color: #e74c3c; font-weight: bold; margin-top: 6px;">
                                    💯 -${item.poin} Poin
                                </div>
                                <div style="font-size: 0.85rem; color: #7f8c8d; margin-top: 4px;">
                                    📅 ${item.tanggal} <br>
                                    👤 ${item.nama} (${item.nama_kelas})
                                </div>
                            </div>
                            <div>
                                <button type="button" name="delete" value="${item.id_pelanggaran}" class="delete btn btn-danger btn-sm" style="border-radius: 8px; padding: 6px 12px;">Hapus</button>
                            </div>
                        </div>
                    </div>`;
                });

                container.append(content);
            },
            error: function (data) {
                // var errors = data.responseJSON.errors;
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
