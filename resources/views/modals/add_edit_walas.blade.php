<div class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_add_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_heading"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="form_walikelas" name="form_walikelas" class="form-horizontal"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id_walas" name="id_walas">
                    <input type="hidden" id="id_tahun" name="id_tahun" value="{{ $id_tahun }}">
                    <input type="hidden" class="form-control" id="tahun" name="tahun" value="{{ $tahun }}">

                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Nama Guru : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">

                            <select class="form-control select2" name="id_user" id="id_user">
                                <option value="" selected>Pilih</option>

                                @foreach ($list_guru as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Kelas : </label>
                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">

                            <select class="form-control select2" name="id_kelas" id="id_kelas">
                                <option value="" selected>Pilih</option>

                                @foreach ($list_kelas as $kelas)
                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- bagian pesan kesalahan validasi --}}
                    <div class="alert alert-danger print-error-msg" style="display:none;margin-top: 20px;">
                        <ul>---</ul>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="simpan">Simpan data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
