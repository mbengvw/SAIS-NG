<!DOCTYPE html>
<html>

<head>
    <title>Laravel Ajax CRUD Tutorial Example - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <br />
                <h3 align="center">Laravel 9 Delete Multiple Data using Checkbox with Datatables Yajra Server Side</h3>
                <br />
                <div align="right">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i
                            class="bi bi-plus-square"></i> Add</button>
                </div>
                <br />
                <table class="table table-striped table-bordered students_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nis</th>
                            <th>nisn</th>
                            <th>nama_lengkap</th>
                            <th>jalur_masuk</th>
                            <th>asal_sltp</th>
                            <th width="180px">Action</th>
                            <th width="50px"><button type="button" name="bulk_delete" id="bulk_delete"
                                    class="btn btn-danger btn-xs">Delete</button></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    const path = {
        base_path: "{{ route('students.index') }}",
        removeall_path: "{{ route('students.removeall') }}"
    };
</script>
<script src="{{ asset('js/studentsman.js') }}" defer></script>


</html>
