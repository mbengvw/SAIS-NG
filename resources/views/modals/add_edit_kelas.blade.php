<div class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_add_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_heading"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="form_kelas" name="form_kelas" class="form-horizontal"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id_kelas" name="id_kelas">
                    <input type="hidden" class="form-control" id="id_tahun" name="id_tahun"
                        value="{{ $id_tahun }}">

                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Jurusan : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="jurusan" name="jurusan">
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Tingkat : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">

                            <select class="form-control select2" name="tingkat" id="tingkat">
                                <option value="" selected>Pilih</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Paralel : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">

                            <select class="form-control select2" name="paralel" id="paralel">
                                <option value="" selected>Pilih</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Nama Kelas : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
                        </div>
                    </div>


                    {{-- bagian pesan kesalahan validasi --}}
                    <div class="alert alert-danger print-error-msg" style="display:none;margin-top: 20px;">
                        <ul>---</ul>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
