$(document).ready(function () {
    fetchDataTable();

    $("body").on("click", ".show", function () {
        let student_id = this.id;
        console.log(student_id);
        let show_path = path.ajax + "/siswa/detail/" + student_id;

        $("#id_siswa").val(student_id);
        $("#modal_heading").html("Rincian Data Siswa");

        //ambil data detail siswa pake jquery get()
        $.get(show_path, function (data) {
            console.log(data);
            // $("#action").val("Edit");
            $("#detail_nama").text(data[0].nama);
            $("#detail_tempat").text(data[0].tempat_lahir);
            $("#detail_tgl").text(data[0].tanggal_lahir);
            $("#detail_alamat").text(data[0].alamat);
            $("#detail_tahun_masuk").text(data[0].tahun_masuk);
            $("#detail_nisn").text(data[0].nisn);
            $("#detail_kelas").text(data[0].nama_kelas);

        });
        $("#student_form").trigger("reset");
        $("#ajaxModal").modal("show");
    });

    function fetchDataTable() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let table = $(".students_datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: path.ajax + "/list_siswa",
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            },
            columns: [
                { data: "id" },
                { data: "nama" },
                { data: "nisn" },
                { data: "tahun_masuk" },
                { data: "tempat_lahir" },
                { data: "tanggal_lahir" },
                { data: "status" },
                { data: "jenis_kelamin" },
                { data: "alamat" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});
