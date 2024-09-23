$(document).ready(function () {
    $("#frm_bulanan").on("submit", function (event) {
        event.preventDefault();
        let id_kelas=$("#select_kelas").val();
        let bulan=$("#select_bulan").val();
        // let formData = new FormData();
        // formData.append("id_kelas",id_kelas);
        // formData.append("bulan",bulan);
        // console.log(formData);
        fetchRekap(id_kelas,bulan);
    });

    function fetchRekap(id_kelas,bulan) {

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
                url: app_path.ajax + "/rekap_presensi_bulanan",
                data: {
                    id_kelas: id_kelas,
                    bulan: bulan,
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
