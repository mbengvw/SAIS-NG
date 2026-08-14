$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });

    // Initialize DataTables
    var table = $('#hukdis-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: route_index,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'poin', name: 'poin'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Handle Tambah Button Click
    $('#btn-tambah').click(function () {
        $('#saveBtn').val("create-hukdis");
        $('#id_hukdis').val('');
        $('#hukdisForm').trigger("reset");
        $('#hukdisModalLabel').html("Tambah Data Hukuman");
    });

    // Handle Edit Button Click
    $('body').on('click', '.editHukdis', function () {
        var id_hukdis = $(this).data('id');
        $.get(route_index + '/' + id_hukdis + '/edit', function (data) {
            $('#hukdisModalLabel').html("Edit Data Hukuman");
            $('#saveBtn').val("edit-hukdis");
            $('#hukdisModal').modal('show');
            $('#id_hukdis').val(data.id_hukdis);
            $('#deskripsi').val(data.deskripsi);
            $('#poin').val(data.poin);
        })
    });

    // Handle Save Button
    $('#hukdisForm').submit(function (e) {
        e.preventDefault();
        $('#saveBtn').html('Menyimpan...');

        $.ajax({
            data: $('#hukdisForm').serialize(),
            url: route_store,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#hukdisForm').trigger("reset");
                $('#hukdisModal').modal('hide');
                $('#saveBtn').html('Simpan');
                table.draw();
                // Optional: show a toast or alert
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Simpan');
                alert("Terjadi kesalahan. Pastikan data terisi dengan benar.");
            }
        });
    });

    // Handle Delete Button Click
    $('body').on('click', '.deleteHukdis', function () {
        var id_hukdis = $(this).data("id");
        if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            $.ajax({
                type: "DELETE",
                url: route_index + '/' + id_hukdis,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    alert("Gagal menghapus data.");
                }
            });
        }
    });
});
