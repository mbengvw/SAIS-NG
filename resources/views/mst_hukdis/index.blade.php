@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <h2>Master Data Hukuman Disiplin</h2>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <div class="col-12">
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Data Hukuman Disiplin</span>
                        <div>
                            <button type="button" class="btn btn-success" id="btn-tambah" data-toggle="modal" data-target="#hukdisModal">
                                + Tambah Data
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">
                                ⬆ Upload CSV
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped" id="hukdis-table" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Deskripsi Pelanggaran</th>
                                    <th width="15%">Poin</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal CRUD -->
    <div class="modal fade" id="hukdisModal" tabindex="-1" role="dialog" aria-labelledby="hukdisModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="hukdisForm" name="hukdisForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hukdisModalLabel">Tambah Data Hukuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_hukdis" id="id_hukdis">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Pelanggaran</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="poin">Poin</label>
                            <input type="number" class="form-control" id="poin" name="poin" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Upload CSV -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mst_hukdis.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Data via CSV</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Download Template CSV</label>
                            <br>
                            <a href="{{ route('mst_hukdis.template') }}" class="btn btn-sm btn-outline-success">⬇ Download Template</a>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="csv_file">Pilih File CSV</label>
                            <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv, .txt" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const route_index = "{{ route('mst_hukdis.index') }}";
        const route_store = "{{ route('mst_hukdis.store') }}";
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/mst_hukdis.js') }}" defer></script>
@endsection
