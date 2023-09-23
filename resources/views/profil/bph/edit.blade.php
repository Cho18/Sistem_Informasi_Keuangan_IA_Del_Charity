@extends('dashboard.app')

@section('title', 'Edit Data Diri')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_bph', 'active')

@section('contents')
    <form class="form-group" action="/edit_bph2/{{ $bph->id }}" method="POST">
    @csrf
    @method('PUT')
        <!-- konten modal-->
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1b8112;"><strong> Edit Data Diri Saya </strong></h4>
            </div>
            <!-- body modal --> 
            <div class="modal-body">
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $bph->id }}">
                    <div class="mb-4 row">
                        <label for="nama" class="col-sm-3 col-form-label text-gray-900"><strong> Nama BPH </strong></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control text-gray-900" name="nama" value="{{ $bph->nama }}" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="angkatan" class="col-sm-3 col-form-label text-gray-900"><strong>Angkatan</strong></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control text-gray-900" name="angkatan" value="{{ $bph->angkatan }}" required>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="status" class="col-sm-3 col-form-label text-gray-900"><strong>Jabatan</strong></label>
                        <div class="col-md-9">
                            <select class="form-control text-gray-900" name="status" required>
                                <option disabled selected> --Pilih Jabatan-- </option>
                                @foreach(['Anggota', 'Bendahara', 'Ketua', 'Sekretaris',] as $option)
                                    <option {{ $bph->status == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="divisi" class="col-sm-3 col-form-label text-gray-900"><strong>Divisi</strong></label>
                        <div class="col-md-9">
                            <select class="form-control text-gray-900" name="divisi" required>
                                <option disabled selected> --Pilih Jenis Kelamin-- </option>
                                @foreach(['Media Sosial', 'Recruiter', 'Remainder'] as $option)
                                    <option {{ $bph->divisi == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href='/profil_bph' type="button" class="btn btn-warning"> Back </a>
                <button type="submit" class="btn btn-success"> Update </button>
            </div>
        </div>
    </form>
@endsection