<form class="form-group" action="add_file_beasiswa" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Kirim File Beasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="dokumen_id" class="col-form-label text-gray-800"><strong> Judul Dokumen </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="dokumen_id" data-live-search="true" required>
                                <option disabled selected> -- Pilih Judul Dokumen -- </option>
                                @foreach ($dokumen->sortBy('name') as $jd)
                                    <option value="{{ $jd->id }}"> {{ $jd->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="file_beasiswa" class="col-form-label text-gray-800"><strong> File Dokumen </strong></label>
                        <div class="col-md-12">
                            <input type="file" class="form-control text-gray-900" name="file_beasiswa" required>
                        </div>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='#' type="button" class="btn btn-warning" data-dismiss="modal"> Back </a>
                    <button type="submit" class="btn btn-primary"> Send </button>
                </div>
            </div>
        </div>
    </div>
</form>