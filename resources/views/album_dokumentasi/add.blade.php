<form class="form-group" action="add_dokumentasi" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Tambah Gallery</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="bukti_transaksi" class="col-form-label text-gray-800"><strong> Gambar </strong></label>
                        <div class="col-md-12">
                            <img class="img-preview img-fluid mb-2 col-sm-5">
                            <input type="file" class="form-control text-gray-900" id="images" name="images" onchange="previewImage()"> 
                        </div>
                    </div>
                    <div class="row">
                        <label for="description" class="col-form-label text-gray-800"><strong> Deskripsi Gambar </strong></label>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control text-gray-900" name="description" id="x" required>
                            <trix-editor input="x" class="text-gray-900"></trix-editor>
                        </div>
                    </div>
                    <div class="row">
                        <label for="date" class="col-form-label text-gray-800"><strong>Tanggal</strong></label>
                        <div class="col-md-12">
                            <input type="date" class="form-control text-gray-900" name="date" id="dateInput" required>
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