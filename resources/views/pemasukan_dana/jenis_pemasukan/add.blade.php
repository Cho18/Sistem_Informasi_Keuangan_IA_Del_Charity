<form class="form-group" action="add_jenis_pemasukan" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Tambah Jenis Pemasukan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="name_of_type_income" class="col-form-label text-gray-800"><strong> Jenis Pemasukan </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="name_of_type_income" placeholder="nama jenis pengeluaran" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="description_of_type_income" class="col-form-label text-gray-800"><strong> Deskripsi Jenis Pemasukan </strong></label>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" name="description_of_type_income" id="x">
                            <trix-editor input="x" class="text-gray-900" placeholder="deskripsi jenis pengeluaran"></trix-editor>
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