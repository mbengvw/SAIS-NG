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
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama',
                    render: function (data, type, row) {
                        return `<span class="font-weight-bold">${row.nama}</span><br><small class="text-muted">NISN: ${row.nisn}</small>`;
                    }
                },
                {
                    data: 'sakit',
                    render: function (data, type, row) {
                        return `<span class="badge badge-warning">${row.sakit}</span>`;
                    }
                },
                {
                    data: 'izin',
                    render: function (data, type, row) {
                        return `<span class="badge badge-info">${row.izin}</span>`;
                    }
                },
                {
                    data: 'alfa',
                    render: function (data, type, row) {
                        return `<span class="badge badge-danger">${row.alfa}</span>`;
                    }
                }
            ],
        });
    }
});
