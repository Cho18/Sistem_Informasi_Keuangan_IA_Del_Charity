<form class="form-group" action="add_pengeluaran" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Tambah Jenis Pengeluaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="pengeluaran" class="col-form-label text-gray-800"><strong> Jenis Pengeluaran </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="jenis_pengeluaran_id" data-live-search="true" required id="jenis_pengeluaran">
                                <option disabled selected> -- Pilih Jenis Pengeluaran -- </option>
                                @foreach ($jenis_pengeluaran->sortBy('name_of_type_expenditure') as $pg)
                                    <option value="{{ $pg->id }}"> {{ $pg->name_of_type_expenditure }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="penerima_beasiswa_id" class="col-form-label text-gray-800"><strong> Nama Awardee </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="penerima_beasiswa_id" data-live-search="true">
                                <option disabled selected> -- Pilih Awardee -- </option>
                                @foreach ($penerima_beasiswa->sortBy('name_awarde') as $pb)
                                    <option value="{{ $pb->id }}"> {{ $pb->name_awarde }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="total_expenditure" class="col-form-label text-gray-800"><strong> Total Pengeluaran </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="total_expenditure" placeholder="1234567890" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="expenditure_description" class="col-form-label text-gray-800"><strong> Deskripsi Pengeluaran </strong></label>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control text-gray-900" name="expenditure_description" id="x">
                            <trix-editor input="x" class="text-gray-900" placeholder="deskripsi pengeluaran"></trix-editor>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="expenditure_date" class="col-form-label text-gray-800"><strong> Tanggal Pengeluaran </strong></label>
                        <div class="col-md-12">
                            <input type="date" class="form-control text-gray-900" name="expenditure_date" id="dateInput" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="proof_of_expenditure" class="col-form-label text-gray-800"><strong> Bukti Pengeluaran </strong></label>
                        <div class="col-md-12">
                            <img class="img-preview img-fluid mb-2 col-sm-5">
                            <input type="file" class="form-control text-gray-900" id="images" name="proof_of_expenditure" onchange="previewImage()"> 
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