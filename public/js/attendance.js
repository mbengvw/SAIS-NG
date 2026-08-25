$(document).ready(function () {
    fetchstudent();

    $("#select_kelas").change(function () {
        fetchstudent();
    });

    function fetchstudent() {
        let id_kelas = $("#select_kelas").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: app_path.base_path + "/ajaxkelastanggal",
            data: { id_kelas: id_kelas },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $("#attendance_container").html("");
                let content = "";
                $.each(response.students, function (key, item) {
                    
                    let s_active = item.status == 'S' ? 'active' : '';
                    let i_active = item.status == 'I' ? 'active' : '';
                    let a_active = item.status == 'A' ? 'active' : '';
                    
                    let borderColor = '#ccc';
                    if(item.status == 'S') borderColor = '#ffc107';
                    if(item.status == 'I') borderColor = '#17a2b8';
                    if(item.status == 'A') borderColor = '#dc3545';

                    let ket = item.keterangan != null ? item.keterangan : '';

                    content += `
                    <div class="card student-card" style="border-left-color: ${borderColor}" id="card-${item.id_grouping}">
                        <div class="card-body">
                            <div class="student-name">${item.nama}</div>
                            <div class="student-gender">JK: ${item.jenis_kelamin}</div>
                            
                            <div class="btn-group-presensi">
                                <button type="button" class="btn btn-presensi status-S radio-presensi ${s_active}" data-status="S" data-id="${item.id_grouping}">Sakit</button>
                                <button type="button" class="btn btn-presensi status-I radio-presensi ${i_active}" data-status="I" data-id="${item.id_grouping}">Izin</button>
                                <button type="button" class="btn btn-presensi status-A radio-presensi ${a_active}" data-status="A" data-id="${item.id_grouping}">Alfa</button>
                            </div>
                            
                            <div class="action-row">
                                <input type="text" class="form-control ket-input" id="ket-${item.id_grouping}" value="${ket}" placeholder="Keterangan (opsional)..." data-id="${item.id_grouping}">
                                <button type="button" class="btn btn-outline-secondary deletebtn" value="delete-${item.id_kehadiran}">Hadir (Clear)</button>
                            </div>
                        </div>
                    </div>`;
                });
                $("#attendance_container").append(content);
                
                if (response.students.length > 0) {
                    $("#selesai_absen_wrapper").show();
                    
                    if (response.sudah_diabsen) {
                        $("#status_absen_badge").html('<span class="badge" style="background-color: #d4edda; color: #155724; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">✅ Kelas ini sudah diabsen hari ini</span>').show();
                    } else {
                        $("#status_absen_badge").html('<span class="badge" style="background-color: #f8d7da; color: #721c24; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">❌ Belum dikonfirmasi selesai</span>').show();
                    }
                } else {
                    $("#selesai_absen_wrapper").hide();
                    $("#status_absen_badge").hide();
                }
            },
        });
    }

    $("#btn_selesai_absen").click(function () {
        let id_kelas = $("#select_kelas").val();
        if (!id_kelas) return;

        let btn = $(this);
        let originalText = btn.html();
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: app_path.base_path + "/selesai",
            data: { id_kelas: id_kelas },
            dataType: "json",
            success: function (response) {
                alert(response.message);
                window.location.href = app_path.dashboard_path; // Redirect ke dashboard masing-masing role
            },
            error: function () {
                alert('Terjadi kesalahan sistem.');
                btn.prop('disabled', false).html(originalText);
            }
        });
    });

    $(document).on("click", ".deletebtn", function (e) {
        e.preventDefault();
        let mydata = $(this).val();
        // console.log(mydata);
        let array_data = mydata.split("-");
        let id_kehadiran = array_data[1];
        if (id_kehadiran != "null") {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "DELETE",
                url: app_path.base_path,
                dataType: "json",
                data: { id_kehadiran: id_kehadiran },
                success: function (response) {
                    // Update UI manually instead of fetchstudent to prevent scroll jump
                    let array_data = mydata.split("-");
                    let id_grouping_from_btn = $(e.target).closest('.card').attr('id').replace('card-', '');
                    
                    $(`#card-${id_grouping_from_btn} .btn-presensi`).removeClass('active');
                    $(`#card-${id_grouping_from_btn}`).css('border-left-color', '#ccc');
                    $(`#ket-${id_grouping_from_btn}`).val("");
                    $(e.target).val('delete-null');
                },
            });
        }
    });

    $(document).on("click", ".radio-presensi", function () {
        let status = $(this).data("status");
        let id_grouping = $(this).data("id");
        let keterangan = $("#ket-" + id_grouping).val();
        
        let isActive = $(this).hasClass('active');

        // Setup AJAX headers globally for this block
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // If clicking an already active button, we interpret this as "Clear / Hadir"
        if (isActive) {
            $(this).removeClass('active');
            $(`#card-${id_grouping}`).css('border-left-color', '#ccc');
            
            // We need to delete the attendance record
            let deleteBtnVal = $(`#card-${id_grouping} .deletebtn`).val();
            let id_kehadiran = deleteBtnVal.split("-")[1];
            
            if (id_kehadiran && id_kehadiran !== "undefined" && id_kehadiran !== "null") {
                $.ajax({
                    type: "DELETE",
                    url: app_path.base_path,
                    dataType: "json",
                    data: { id_kehadiran: id_kehadiran },
                    success: function (response) {
                        // Clear the delete button value since it's deleted
                        $(`#card-${id_grouping} .deletebtn`).val(`delete-null`);
                        $(`#ket-${id_grouping}`).val(""); // Clear keterangan too
                    },
                });
            }
            return; // Stop further execution
        }

        // Update UI immediately for better UX
        $(`#card-${id_grouping} .btn-presensi`).removeClass('active');
        $(this).addClass('active');
        
        let borderColor = '#ccc';
        if(status == 'S') borderColor = '#ffc107';
        if(status == 'I') borderColor = '#17a2b8';
        if(status == 'A') borderColor = '#dc3545';
        $(`#card-${id_grouping}`).css('border-left-color', borderColor);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: app_path.base_path,
            dataType: "json",
            data: {
                status: status,
                id_grouping: id_grouping,
                keterangan: keterangan,
            },
            success: function (response) {
                // Update the delete button value with the newly created attendance ID
                if (response.id_kehadiran) {
                    $(`#card-${id_grouping} .deletebtn`).val(`delete-${response.id_kehadiran}`);
                }
            },
        });
    });

    // Also save when typing in keterangan
    $(document).on("change", ".ket-input", function () {
        let id_grouping = $(this).data("id");
        let activeBtn = $(`#card-${id_grouping} .btn-presensi.active`);
        if (activeBtn.length > 0) {
            // Trigger the active button to save the new keterangan
            activeBtn.trigger('click');
        }
    });

    // Search student functionality
    $("#search_student").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#attendance_container .student-card").filter(function() {
            let name = $(this).find(".student-name").text().toLowerCase();
            $(this).toggle(name.indexOf(value) > -1);
        });
    });
});
