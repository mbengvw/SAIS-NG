$(document).ready(function () {
    fetchTahun();

    $("#create_record").click(function () {
        let confirmed = confirm("Tambah tahun akademik baru ?");
        if (confirmed) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "post",
                url: app_path.base_path + "/ajaxAdd",
                success: function (data) {
                    fetchTahun();
                    // table.draw();
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }
    });

    $("body").on("click", ".set", function () {
        id = this.id;
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "post",
            url: app_path.base_path + "/ajaxSetActive",
            data: { id: id },
            success: function (data) {
                fetchTahun();
                // table.draw();
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    function fetchTahun() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let table = $(".tahun_datatable").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: app_path.base_path,
            columns: [
                { data: "id", name: "id" },
                { data: "tahun", name: "tahun" },
                { data: "semester", name: "semester" },
                { data: "alias_tahun", name: "alias_tahun" },
                { data: "is_active", name: "is_active" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    $("body").on("click", ".exit", function () {
        window.location.replace(app_path.dashboard_path);
    });
});
