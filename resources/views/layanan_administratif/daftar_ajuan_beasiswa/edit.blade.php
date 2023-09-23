<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit{{ $index }}">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Donasi Donator </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form role="form" action="/edit_ajuan_beasiswa/{{ $ab->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-4 row">
                    <label for="status" class="col-form-label text-gray-900">Status</label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="status" required>
                            @foreach(['Sudah diproses', 'Belum diproses'] as $option)
                            <option {{ $ab->status == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
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