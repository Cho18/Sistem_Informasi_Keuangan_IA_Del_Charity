<form class="form-group" action="add_donasi" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Kirim Bukti Donasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="donation_amount" class="col-form-label text-gray-800"><strong> Jumlah Donasi </strong></label>
                        <div class="col-md-12">
                            <input type="number" class="form-control text-gray-900" name="donation_amount" placeholder="1234567890" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="donation_date" class="col-form-label text-gray-800"><strong> Tanggal Donasi </strong></label>
                        <div class="col-md-12">
                            <input type="date" class="form-control text-gray-900" name="donation_date" id="dateInput" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="type_account" class="col-form-label text-gray-800"><strong> Tipe Akun </strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="type_account" data-live-search="true" required>
                                <option disabled selected> -- Pilih Tipe Akun -- </option>
                                <option> Bank BCA </option>
                                <option> Bank BNI </option>
                                <option> Bank BRI </option>
                                <option> Bank Mandiri </option>
                                <option> Bank Permata </option>
                                <option> Bank SUMUT </option>
                                <option> Bank Syariah Indonesia </option>
                                <option> DANA </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="description" class="col-md-3 col-form-label text-gray-800"><strong> Deskripsi </strong></label>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control text-gray-900" name="description" id="x">
                            <trix-editor input="x" class="text-gray-900" placeholder="deskripsi mengenai bukti donasi anda"></trix-editor>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="bukti_transaksi" class="col-form-label text-gray-800"><strong> Bukti Donasi </strong></label>
                        <div class="col-md-12">
                            <img class="img-preview img-fluid mb-2 col-sm-4">
                            <input type="file" class="form-control text-gray-900" id="images" name="bukti_transaksi" onchange="previewImage()" required> 
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