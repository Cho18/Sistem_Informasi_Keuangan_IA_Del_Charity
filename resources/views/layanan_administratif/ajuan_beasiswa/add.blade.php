<form class="form-group" action="add_ajuan_beasiswa" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Ajukan Beasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="total_bursar" class="col-sm-3 col-form-label text-gray-800"><strong> Total Bursar </strong></label>
                        <div class="col-md-12">
                            <input type="number" class="form-control text-gray-900" name="total_bursar" placeholder="1234567890" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="semester" class="col-sm-3 col-form-label text-gray-800"><strong> Semester </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="semester" required>
                                <option> Semester 1 </option>
                                <option> Semester 2 </option>
                                <option> Semester 3 </option>
                                <option> Semester 4 </option>
                                <option> Semester 5 </option>
                                <option> Semester 6 </option>
                                <option> Semester 7 </option>
                                <option> Semester 8 </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="deskripsi" class="col-md-3 col-form-label text-gray-800"><strong> Deskripsi </strong></label>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control text-gray-900" name="deskripsi" id="x">
                            <trix-editor input="x" class="text-gray-900" placeholder="deskripsi mengenai ajuan beasiswa anda"></trix-editor>
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