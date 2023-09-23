<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit{{ $index }}">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Donasi Donator </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form role="form" action="/edit_dokumentasi/{{ $g->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-4 row">
                    <label for="images" class="col-form-label text-gray-900"><strong> Gambar </strong></label>
                    <div class="col-md-12">
                        <input type="hidden" name="oldImage" value="{{ $g->images }}">
                        @if ($g->images)
                            <img src="{{ asset('storage/'.$g->images) }}" class="img-preview img-fluid mb-2 col-sm-6" id="imgPreview{{ $index }}">
                        @else
                            <img class="img-preview img-fluid mb-2 col-sm-4">
                        @endif
                        <input type="file" class="form-control text-gray-900" id="images{{ $index }}" name="images" onchange="previewImage({{ $index }})"> 
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="description" class="col-md-3 col-form-label text-gray-900"><strong> Deskripsi Gallery </strong></label>
                    <div class="col-md-12">
                        <input type="hidden" class="form-control text-gray-900" name="description" id="x{{ $index }}" value="{{ $g->description }}">
                        <trix-editor input="x{{ $index }}"></trix-editor>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="date" class="col-form-label text-gray-900"><strong> Tanggal </strong></label>
                    <div class="col-md-12">
                        <input type="date" class="form-control text-gray-900" name="date" value="{{ $g->date }}" required>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-success"> Update </button>
            </div>
            </form>
        </div>
    </div>
</div>