<form action="delete_dokumentasi/{{ $g->id }}" method="post" id="deleteForm{{ $index }}">
    @csrf
    @method('DELETE')
    <div id="ModalDelete{{ $index }}" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"> Hapus Album Dokumentasi </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5> Yakin Menghapus? </h5>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>
</form>
