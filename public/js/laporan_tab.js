$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const commonColumns = [
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
                return `<span class="badge badge-warning">${row.sakit || 0}</span>`;
            }
        },
        {
            data: 'izin',
            render: function (data, type, row) {
                return `<span class="badge badge-info">${row.izin || 0}</span>`;
            }
        },
        {
            data: 'alfa',
            render: function (data, type, row) {
                return `<span class="badge badge-danger">${row.alfa || 0}</span>`;
            }
        }
    ];

    // --- HARIAN ---
    $("#form-harian").on("submit", function(e) {
        e.preventDefault();
        let kelas = $("#form-harian select[name='kelas']").val();
        let tanggal = $("#form-harian input[name='tanggal']").val();
        let nama = $("#form-harian input[name='nama']").val();

        if(!kelas || !tanggal) {
            alert("Harap pilih kelas dan tanggal"); return;
        }

        $("#tbl_kehadiran").DataTable({
            processing: true,
            serverSide: false,
            bDestroy: true,
            ajax: {
                url: app_path.harian,
                data: { id_kelas: kelas, tanggal: tanggal, nama: nama },
                dataSrc: "students"
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nama', name: 'nama' },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        if (row.status == "H") return '<span class="badge badge-success">Hadir</span>';
                        else if (row.status == "S") return '<span class="badge badge-warning">Sakit</span>';
                        else if (row.status == "I") return '<span class="badge badge-info">Izin</span>';
                        else if (row.status == "A") return '<span class="badge badge-danger">Alfa</span>';
                        else return '<span class="badge badge-secondary">Belum Diabsen</span>';
                    }
                },
                { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                { data: 'tanggal', name: 'tanggal' }
            ],
        });
    });

    // --- BULANAN ---
    $("#form-bulanan").on("submit", function(e) {
        e.preventDefault();
        let kelas = $("#form-bulanan select[name='kelas']").val();
        let bulan = $("#form-bulanan select[name='bulan']").val();

        if(!kelas || !bulan) {
            alert("Harap pilih kelas dan bulan"); return;
        }

        $("#tbl_bulanan").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.ajax + "/rekap_presensi_bulanan",
                data: { id_kelas: kelas, bulan: bulan }
            },
            columns: commonColumns
        });
    });

    // --- RENTANG WAKTU ---
    $("#form-rentang").on("submit", function(e) {
        e.preventDefault();
        let kelas = $("#form-rentang select[name='kelas']").val();
        let start_date = $("#form-rentang input[name='start_date']").val();
        let end_date = $("#form-rentang input[name='end_date']").val();

        if(!kelas || !start_date || !end_date) {
            alert("Harap isi semua filter rentang waktu"); return;
        }

        $("#tbl_rentang").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.ajax + "/rekap_rentang_waktu",
                data: { id_kelas: kelas, start_date: start_date, end_date: end_date }
            },
            columns: commonColumns
        });
    });

    // --- SEMESTER ---
    $("#form-semester").on("submit", function(e) {
        e.preventDefault();
        let kelas = $("#form-semester select[name='kelas']").val();
        let tahun = $("#form-semester select[name='tahun']").val();
        let semester = $("#form-semester select[name='semester']").val();

        if(!kelas || !tahun || !semester) {
            alert("Harap isi semua filter semester"); return;
        }

        $("#tbl_semester").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.ajax + "/rekap_presensi",
                data: { id_kelas: kelas, tahun: tahun, semester: semester }
            },
            columns: commonColumns
        });
    });

    // --- TAHUNAN ---
    $("#form-tahunan").on("submit", function(e) {
        e.preventDefault();
        let kelas = $("#form-tahunan select[name='kelas']").val();
        let tahun = $("#form-tahunan select[name='tahun']").val();

        if(!kelas || !tahun) {
            alert("Harap isi semua filter tahun"); return;
        }

        $("#tbl_tahunan").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.ajax + "/rekap_tahunan",
                data: { id_kelas: kelas, tahun: tahun }
            },
            columns: commonColumns
        });
    });

    // --- PER SISWA ---
    $("#form-siswa").on("submit", function(e) {
        e.preventDefault();
        let nama = $("#form-siswa input[name='nama']").val();
        let nisn = $("#form-siswa input[name='nisn']").val();

        if(!nama && !nisn) {
            alert("Harap isi Nama atau NISN Siswa untuk mencari"); return;
        }

        $("#tbl_siswa").DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: app_path.siswa,
                data: { nama: nama, nisn: nisn }
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'nama_siswa', name: 'nama_siswa' },
                { data: 'nisn_siswa', name: 'nisn_siswa' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        if (row.status == "Hadir") return '<span class="badge badge-success">Hadir</span>';
                        else if (row.status == "Sakit") return '<span class="badge badge-warning">Sakit</span>';
                        else if (row.status == "Izin") return '<span class="badge badge-info">Izin</span>';
                        else if (row.status == "Alfa") return '<span class="badge badge-danger">Alfa</span>';
                        else return `<span class="badge badge-secondary">${row.status}</span>`;
                    }
                },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
            ]
        });
    });

    // Handle Edit Button Click
    $(document).on('click', '.btn-edit-presensi', function() {
        let id = $(this).data('id');
        let status = $(this).data('status');
        let keterangan = $(this).data('keterangan');
        
        $('#edit_id_kehadiran').val(id);
        $('#edit_status').val(status);
        $('#edit_keterangan').val(keterangan);
        
        $('#modalEditPresensi').modal('show');
    });

    // Handle Edit Form Submission
    $('#formEditPresensi').on('submit', function(e) {
        e.preventDefault();
        let id = $('#edit_id_kehadiran').val();
        
        $.ajax({
            url: app_path.base_url + '/presensi/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    $('#modalEditPresensi').modal('hide');
                    alert(response.message);
                    $('#tbl_siswa').DataTable().ajax.reload(null, false);
                } else {
                    alert('Gagal mengupdate data.');
                }
            },
            error: function(xhr) {
                let res = xhr.responseJSON;
                alert(res && res.message ? res.message : 'Terjadi kesalahan saat mengupdate.');
            }
        });
    });

    // Handle Delete Button Click
    $(document).on('click', '.btn-delete-presensi', function() {
        let id = $(this).data('id');
        
        if(confirm("Apakah Anda yakin ingin menghapus data absensi ini?")) {
            $.ajax({
                url: app_path.base_url + '/presensi/' + id,
                type: 'DELETE',
                success: function(response) {
                    if(response.success) {
                        alert(response.message);
                        $('#tbl_siswa').DataTable().ajax.reload(null, false);
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    alert(res && res.message ? res.message : 'Terjadi kesalahan saat menghapus.');
                }
            });
        }
    });

    // Default trigger first class for initial load (optional, or just wait for user to select)
    let initialKelas = $("select[name='kelas']").first().find('option:nth-child(2)').val();
    if(initialKelas) {
        // If walas, it probably has only 1 class in options. Let's auto-select it.
        $("select[name='kelas']").val(initialKelas);
    }
});
