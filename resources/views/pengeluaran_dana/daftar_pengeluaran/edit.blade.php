<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit{{ $index }}">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Donasi Donator </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form role="form" action="/edit_pg/{{ $pl->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-4 row">
                    <label for="pengeluaran" class="col-form-label text-gray-900"><strong>Jenis Pengeluaran:</strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="jenis_pengeluaran_id" data-live-search="true" required>
                            <option value="{{ $pl->jenis_pengeluaran->id }}">{{ $pl->jenis_pengeluaran->name_of_type_expenditure }}</option>
                            @foreach ($jenis_pengeluaran->sortBy('name_of_type_expenditure') as $jp)
                                @if ($jp->id !== $pl->jenis_pengeluaran->id)
                                    <option value="{{ $jp->id }}">{{ $jp->name_of_type_expenditure }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="mb-4 row">
                    <label for="pengeluaran" class="col-form-label text-gray-900"><strong>Nama Awardee:</strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="penerima_beasiswa_id" data-live-search="true" required>
                            @if ($pl->penerima_beasiswa)
                                <option value="{{ $pl->penerima_beasiswa->id }}">{{ $pl->penerima_beasiswa->name_awarde }}</option>
                            @else
                                <option disabled selected>-- Pilih Awardee --</option>
                            @endif
                            @foreach ($penerima_beasiswa->sortBy('name_awarde') as $p)
                                @if (!$pl->penerima_beasiswa || $p->id !== $pl->penerima_beasiswa->id)
                                    <option value="{{ $p->id }}">{{ $p->name_awarde }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> 
                </div> 
                <div class="mb-4 row">
                    <label for="total_expenditure" class="col-form-label text-gray-900"><strong> Total Pengeluaran :</strong></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control text-gray-900" name="total_expenditure" value="{{ $pl->total_expenditure }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="expenditure_description" class="col-form-label text-gray-900"><strong> Deskripsi Pengeluaran :</strong></label>
                    <div class="col-md-12">
                        <input type="hidden" class="form-control text-gray-900" name="expenditure_description" id="x{{ $index }}" value="{{ $pl->expenditure_description }}">
                        <trix-editor input="x{{ $index }}" class="text-gray-900"></trix-editor>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="expenditure_date" class="col-form-label text-gray-900"><strong> Tanggal Pengeluaran :</strong></label>
                    <div class="col-md-12">
                        <input type="date" class="form-control text-gray-900" name="expenditure_date" value="{{ $pl->expenditure_date }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="proof_of_expenditure" class="col-form-label text-gray-900"><strong> Bukti Pengeluaran </strong></label>
                    <div class="col-md-12">
                        <input type="hidden" name="oldImage" value="{{ $pl->proof_of_expenditure }}">
                        @if ($pl->proof_of_expenditure)
                            <img src="{{ asset('storage/'.$pl->proof_of_expenditure) }}" class="img-preview img-fluid mb-2 col-sm-6" id="imgPreview{{ $index }}">
                        @else
                            <img class="img-preview img-fluid mb-2 col-sm-4" id="imgPreview{{ $index }}" style="display: none;">
                        @endif
                        <input type="file" class="form-control text-gray-900" id="images{{ $index }}" name="proof_of_expenditure" onchange="previewImage({{ $index }})"> 
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