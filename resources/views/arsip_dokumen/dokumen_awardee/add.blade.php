<form class="form-group" action="add_dokumen_awardee" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Tambah Dokumen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="name_of_type_expenditure" class="col-form-label text-gray-800"><strong> Judul Dokumen </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="name" placeholder="judul dokumen" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="dokumen" class="col-form-label text-gray-800"><strong> File Dokumen </strong></label>
                        <div class="col-md-12">
                            <input type="file" class="form-control text-gray-900" name="dokumen" required>
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