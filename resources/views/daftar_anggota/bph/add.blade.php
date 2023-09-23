<form class="form-group" action="add_bph" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Tambah BPH</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="nama" class="col-form-label text-gray-800 d-block"><strong> Nama BPH </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="nama" placeholder="nama lengkap bph">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="angkatan" class="col-form-label text-gray-800"><strong> Angkatan </strong></label>
                        <div class="col-md-12">
                            <input type="number" class="form-control text-gray-900" name="angkatan" placeholder="angkatan">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="status" class="col-form-label text-gray-800"><strong> Jabatan </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="status" placeholder="jabatan">
                                <option disabled selected> -- Pilih Jabatan -- </option>
                                <option> Anggota </option>
                                <option> Bendahara </option>
                                <option> Ketua </option>
                                <option> Sekretaris </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="divisi" class="col-form-label text-gray-800"><strong> Divisi </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="divisi" placeholder="divisi">
                                <option disabled selected> -- Pilih Divisi -- </option>
                                <option> Media Sosial </option>
                                <option> Recruiter </option>
                                <option> Remainder </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='#' type="button" class="btn btn-warning" data-dismiss="modal"> Back </a>
                    <button type="submit" class="btn btn-primary"> Add </button>
                </div>
            </div>
        </div>
    </div>
</form>