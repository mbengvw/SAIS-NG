@extends('main')

@section('content')
<style>
    /* Mobile-friendly table (Card Style) */
    @media screen and (max-width: 768px) {
        table.students_datatable thead {
            display: none !important; /* Hide header on mobile */
        }
        table.students_datatable, table.students_datatable tbody, table.students_datatable tr, table.students_datatable td {
            display: block;
            width: 100%;
        }
        table.students_datatable tr {
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 10px 15px;
        }
        table.students_datatable td {
            text-align: right;
            padding: 10px 0;
            padding-left: 40%;
            position: relative;
            border-bottom: 1px solid #f0f0f0 !important;
            border-top: none !important;
        }
        table.students_datatable td:last-child {
            border-bottom: none !important;
            text-align: center; /* Center the action button */
            padding-left: 0;
        }
        table.students_datatable td::before {
            position: absolute;
            left: 0;
            width: 35%;
            text-align: left;
            font-weight: 600;
            color: #555;
            white-space: nowrap;
        }
        
        /* Hide unnecessary columns on mobile to keep cards compact */
        table.students_datatable td:nth-child(1), /* ID */
        table.students_datatable td:nth-child(4), /* Thn Masuk */
        table.students_datatable td:nth-child(5), /* Tmp Lahir */
        table.students_datatable td:nth-child(6), /* Tgl Lahir */
        table.students_datatable td:nth-child(7), /* Status */
        table.students_datatable td:nth-child(8), /* Gender */
        table.students_datatable td:nth-child(9)  /* Alamat */ {
            display: none !important;
        }
        
        /* Define column labels via CSS */
        table.students_datatable td:nth-child(1)::before { content: "ID"; }
        table.students_datatable td:nth-child(2)::before { content: "Nama"; }
        table.students_datatable td:nth-child(3)::before { content: "NISN"; }
        table.students_datatable td:nth-child(4)::before { content: "Thn Masuk"; }
        table.students_datatable td:nth-child(5)::before { content: "Tmp Lahir"; }
        table.students_datatable td:nth-child(6)::before { content: "Tgl Lahir"; }
        table.students_datatable td:nth-child(7)::before { content: "Status"; }
        table.students_datatable td:nth-child(8)::before { content: "Gender"; }
        table.students_datatable td:nth-child(9)::before { content: "Alamat"; }
        table.students_datatable td:nth-child(10)::before { content: ""; } /* No label for action button */
    }
</style>

    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 30px;margin-bottom: 20px;">
            <div class="col-12 text-center">
                <h3 class="font-weight-bold mb-1">Daftar Siswa</h3>
                <h6 class="text-muted mb-0">MAN 2 KUNINGAN</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm" style="border-radius: 15px; margin-bottom: 20px;">
                    <div class="card-header bg-white font-weight-bold d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                        <span>Data Siswa</span>
                        @if (auth()->user()->piket == 1)
                            <a href="{{ route('piket.index') }}" role="button" class="btn btn-sm btn-warning shadow-sm">
                                <i class="fa fa-home"></i> Home
                            </a>
                        @endif
                    </div>
                    <div class="card-body p-2 p-md-3">
                        <div class="table-responsive" style="border: none;">
                            <table class="table table-striped table-hover students_datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tgl. Lahir</th>
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Alamat</th>
                                        <th width="120px">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH/EDIT --}}
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title" id="modal_heading"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <img id="detail_foto" src="" alt="Foto Siswa" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; display: none; margin: 0 auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    </div>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-muted" width="40%">Nama</td>
                                <td id="detail_nama" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">NISN</td>
                                <td id="detail_nisn"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Kelas</td>
                                <td id="detail_kelas"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Tahun Masuk</td>
                                <td id="detail_tahun_masuk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Tempat Lahir</td>
                                <td id="detail_tempat"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Tgl. Lahir</td>
                                <td id="detail_tgl"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted">Alamat</td>
                                <td id="detail_alamat"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const path = {
            ajax: "{{ url('ajax') }}",
        };
    </script>
    <script src="{{ asset('js/students.js') }}" defer></script>
@endsection
