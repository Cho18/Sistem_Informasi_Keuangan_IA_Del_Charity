<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit{{ $index }}">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Donasi Donator </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form role="form" action="/edit_dd/{{ $dd->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-4 row">
                    <label for="pengeluaran" class="col-form-label text-gray-900"><strong>Jenis Pemasukan:</strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="jenis_pemasukan_id" data-live-search="true" required>
                            <option value="{{ $dd->jenis_pemasukan->id }}">{{ $dd->jenis_pemasukan->name_of_type_income }}</option>
                            @foreach ($jenis_pemasukan->sortBy('name_of_type_income') as $jp)
                                @if ($jp->id !== $dd->jenis_pemasukan->id)
                                    <option value="{{ $jp->id }}">{{ $jp->name_of_type_income }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="mb-4 row">
                    <label for="donor_id" class="col-form-label text-gray-900"><strong>Nama Donator:</strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="donor_id" data-live-search="true" required>
                            @if ($dd->donator)
                                <option value="{{ $dd->donator->id }}">{{ $dd->donator->name }}</option>
                            @else
                                <option disabled selected>-- Pilih Donator --</option>
                            @endif
                            @foreach ($donator->sortBy('name') as $p)
                                @if (!$dd->donator || $p->id !== $dd->donator->id)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> 
                </div>
                
                {{-- <div class="mb-4 row">
                    <label for="donor_id" class="col-form-label text-gray-900"><strong>Nama Donator</strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="donor_id" data-live-search="true" required>
                            <option value="{{ $dd->donor_id }}">{{ $dd->name }}</option> <!-- Use $dd->donor_id and $dd->name -->
                            @foreach ($donator->sortBy('name') as $dn)
                                @if ($dn->id !== $dd->donor_id)
                                    <option value="{{ $dn->id }}">{{ $dn->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="mb-4 row">
                    <label for="donation_amount" class="col-form-label text-gray-900"><strong> Jumlah Donasi </strong></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control text-gray-900" name="donation_amount" value="{{ $dd->donation_amount }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="donation_date" class="col-form-label text-gray-900"><strong> Tanggal Donasi </strong></label>
                    <div class="col-md-12">
                        <input type="date" class="form-control text-gray-900" name="donation_date" value="{{ $dd->donation_date }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="type_account" class="col-form-label text-gray-900"><strong> Tipe Akun </strong></label>
                    <div class="col-md-12">
                        <select class="form-control text-gray-900" name="type_account" required>
                            @foreach(['Bank BCA', 'Bank Mandiri', 'Bank BNI', 'Bank Permata', 'Bank BRI', 'Bank SUMUT', 'Bank Syariah Indonesia', 'DANA'] as $option)
                            <option {{ $dd->type_account == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="description" class="col-form-label text-gray-900"><strong> Deskripsi </strong></label>
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="description" id="x{{ $index }}" value="{{ $dd->description }}">
                        <trix-editor input="x{{ $index }}" class="text-gray-900"></trix-editor>
                    </div>
                </div>
                <!-- HTML code for file input and image preview -->
                <div class="mb-4 row">
                    <label for="bukti_transaksi" class="col-form-label text-gray-900"><strong> Bukti Transaksi </strong></label>
                    <div class="col-md-12">
                        <input type="hidden" name="oldImage" value="{{ $dd->bukti_transaksi }}">
                        @if ($dd->bukti_transaksi)
                        <img src="{{ asset('storage/'.$dd->bukti_transaksi) }}" class="img-preview img-fluid mb-2 col-sm-6" id="imgPreview{{ $index }}">
                        @else
                        <img class="img-preview img-fluid mb-2 col-sm-4" id="imgPreview{{ $index }}" style="display: none;">
                        @endif
                        <input type="file" class="form-control text-gray-900" id="images{{ $index }}" name="bukti_transaksi" onchange="previewImage({{ $index }})"> 
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