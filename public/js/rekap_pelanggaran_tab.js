$(document).ready(function () {
    // Setup CSRF
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const columnsConfig = [
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
        { data: "nisn", name: "nisn" },
        { data: "nama", name: "nama" },
        { data: "nama_kelas", name: "nama_kelas" },
        { data: "total_kasus", name: "total_kasus" },
        { data: "total_poin", name: "total_poin" }
    ];

    // HARIAN
    let tableHarian = $("#tbl_harian").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: path.ajax + "/rekap_pelanggaran_harian",
            data: function (d) {
                d.id_kelas = $("#harian_kelas").val();
                d.tanggal = $("#harian_tanggal").val();
            }
        },
        columns: columnsConfig,
    });

    $("#filter_harian").on("submit", function (e) {
        e.preventDefault();
        tableHarian.draw();
    });

    // RENTANG WAKTU
    let tableRentang = $("#tbl_rentang").DataTable({
        processing: true,
        serverSide: true,
        deferLoading: 0, // Wait for tab click
        ajax: {
            url: path.ajax + "/rekap_pelanggaran_rentang",
            data: function (d) {
                d.id_kelas = $("#rentang_kelas").val();
                d.start_date = $("#rentang_start").val();
                d.end_date = $("#rentang_end").val();
            }
        },
        columns: columnsConfig,
    });

    $("#filter_rentang").on("submit", function (e) {
        e.preventDefault();
        tableRentang.draw();
    });

    // SEMESTER
    let tableSemester = $("#tbl_semester").DataTable({
        processing: true,
        serverSide: true,
        deferLoading: 0,
        ajax: {
            url: path.ajax + "/rekap_pelanggaran_semester",
            data: function (d) {
                d.id_kelas = $("#semester_kelas").val();
                d.semester = $("#semester_val").val();
            }
        },
        columns: columnsConfig,
    });

    $("#filter_semester").on("submit", function (e) {
        e.preventDefault();
        tableSemester.draw();
    });

    // TAHUNAN
    let tableTahunan = $("#tbl_tahunan").DataTable({
        processing: true,
        serverSide: true,
        deferLoading: 0,
        ajax: {
            url: path.ajax + "/rekap_pelanggaran_tahunan",
            data: function (d) {
                d.id_kelas = $("#tahunan_kelas").val();
            }
        },
        columns: columnsConfig,
    });

    $("#filter_tahunan").on("submit", function (e) {
        e.preventDefault();
        tableTahunan.draw();
    });

    // INDIVIDU
    let tableIndividu = $("#tbl_individu").DataTable({
        processing: true,
        serverSide: true,
        deferLoading: 0,
        ajax: {
            url: "", // will be set dynamically
            type: "GET",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'semester', name: 'semester' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'poin', name: 'poin' },
            { data: 'petugas', name: 'petugas', defaultContent: '-' },
        ]
    });

    $("#individu_kelas").on("change", function () {
        let id_kelas = $(this).val();
        let selectSiswa = $("#individu_siswa");
        selectSiswa.empty().append('<option value="">-- Pilih Siswa --</option>');
        $("#btn_filter_individu").prop("disabled", true);

        if (id_kelas) {
            $.ajax({
                url: path.ajax_siswa,
                type: "GET",
                data: {
                    tahun: path.tahun,
                    id_kelas: id_kelas
                },
                success: function (res) {
                    if (res.students) {
                        $.each(res.students, function (key, value) {
                            selectSiswa.append('<option value="' + value.id_siswa + '">' + value.nama + '</option>');
                        });
                    }
                }
            });
        }
    });

    $("#individu_siswa").on("change", function () {
        if ($(this).val()) {
            $("#btn_filter_individu").prop("disabled", false);
        } else {
            $("#btn_filter_individu").prop("disabled", true);
        }
    });

    $("#filter_individu").on("submit", function (e) {
        e.preventDefault();
        let id_siswa = $("#individu_siswa").val();
        if (id_siswa) {
            let url = path.riwayat_pelanggaran_base + "/" + id_siswa + "/pelanggaran";
            tableIndividu.ajax.url(url).load();
        }
    });

    // Lazy load datatables when tab is clicked
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href"); // activated tab
        if (target === '#content-rentang') {
            tableRentang.draw();
        } else if (target === '#content-semester') {
            tableSemester.draw();
        } else if (target === '#content-tahunan') {
            tableTahunan.draw();
        }
    });
});
