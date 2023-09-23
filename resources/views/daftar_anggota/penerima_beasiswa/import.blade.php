<!-- Modal Edit -->
<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Anggota Awardee</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form class="form-group" action="/import_penerima_beasiswa" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-4 row">
                    <label for="file" class="col-form-label text-gray-900"><strong> Anggota Awardee </strong></label>
                    <div class="col-md-12">
                        <input type="file" class="form-control text-gray-900" name="file" required>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href='#' type="button" class="btn btn-warning" data-dismiss="modal"> Back </a>
                <button type="submit" class="btn btn-success"> Import </button>
            </div>
            </form>
        </div>
    </div>
</div>