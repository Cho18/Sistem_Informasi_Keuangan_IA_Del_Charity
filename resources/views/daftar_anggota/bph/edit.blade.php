<form class="form-group" action="/edit_bph/{{ $b->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="ModalEdit{{ $index }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Edit Data BPH</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="mb-4 row">
                        <label for="nama" class="col-form-label text-gray-900"><strong> Nama BPH </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="nama" value="{{ $b->nama }}">
                        </div>
                        
                    </div> 
                    <div class="mb-4 row">
                        <label for="angkatan" class="col-form-label text-gray-900"><strong> Angkatan </strong></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control text-gray-900" name="angkatan" value="{{ $b->angkatan }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="status" class="col-form-label text-gray-900"><strong>Jabatan</strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="status">
                                <option disabled selected> --Pilih Jabatan-- </option>
                                @foreach(['Anggota', 'Bendahara', 'Ketua', 'Sekretaris'] as $option)
                                    <option {{ $b->status == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="divisi" class="col-form-label text-gray-900"><strong>Divisi</strong></label>
                        <div class="col-md-12">
                            <select class="form-control text-gray-900" name="divisi">
                                <option disabled selected> --Pilih Divisi-- </option>
                                @foreach(['Media Sosial', 'Recruiter', 'Remainder'] as $option)
                                    <option {{ $b->divisi == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href='#' type="button" class="btn btn-warning" data-dismiss="modal">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>