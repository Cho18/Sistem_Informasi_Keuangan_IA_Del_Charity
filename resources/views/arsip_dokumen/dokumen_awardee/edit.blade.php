<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit{{ $index }}">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Donasi Donator </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form role="form" action="/edit_dokumen_awardee/{{ $dok->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-4 row">
                    <label for="name_of_type_expenditure" class="col-form-label text-gray-800"><strong> Judul Dokumen </strong></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control text-gray-900" name="name" value="{{ $dok->name }}" required>
                    </div>
                </div>
                <div class="row">
                    <label for="dokumen" class="col-form-label text-gray-800"><strong> File Dokumen </strong></label>
                    <div class="col-md-12">
                        <input type="file" class="form-control text-gray-900 mb-2" name="dokumen" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv">
                        @if ($dok->dokumen)
                            <p>File dokumen saat ini: <a href="{{ asset('storage/' . $dok->dokumen) }}" target="_blank">{{ basename($dok->dokumen) }}</a></p>
                        @endif
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