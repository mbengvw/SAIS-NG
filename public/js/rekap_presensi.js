$(document).ready(function () {
    $("#select_kelas").change(function () {
        fetchRekap();
    });

    function fetchRekap() {
        let id_kelas = $("#select_kelas").val();
        // alert(id_kelas);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let table = $(".rekap_datatable").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.ajax + "/rekap_presensi",
                data: {
                    id_kelas: id_kelas,
                },
            },

            columns: [
                { data: "DT_RowIndex", className: "text-center" },
                { data: "nama" },
                { data: "nisn", className: "text-center" },
                { data: "tahun", className: "text-center" },
                { data: "sakit", className: "text-center" },
                { data: "izin", className: "text-center" },
                { data: "alfa", className: "text-center" },
                { data: "total", className: "text-center" },
            ],
        });
    }
});
