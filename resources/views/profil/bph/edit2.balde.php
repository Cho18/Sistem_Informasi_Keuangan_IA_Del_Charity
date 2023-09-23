@extends('dashboard.app')

@section('title', 'Edit Data Diri')

@section('bph', 'active')
@section('bpha', 'show')
@section('pbph', 'active')

@section('contents')
    <form class="form-group" action="/edit_bph2/{{ $bph->id }}" method="POST">
    @csrf
    @method('PUT')
        <!-- konten modal-->
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1b8112;"><strong> Edit Data Diri Anda </strong></h4>
            </div>
            <!-- body modal --> 
            <div class="modal-body">
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $bph->id }}">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label text-gray-900"><strong> Nama BPH </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name" value="{{ $bph->name }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-900"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" value="{{ $bph->place_of_birth }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date_of_birth" class="col-form-label text-gray-900"><strong> Tanggal Lahir </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_birth" value="{{ $bph->date_of_birth }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="gender" class="col-form-label text-gray-900"><strong>Jenis Kelamin</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="gender" required>
                                        <option disabled selected> --Pilih Jenis Kelamin-- </option>
                                        @foreach(['Female', 'Male'] as $option)
                                            <option {{ $bph->gender == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="religion" class="col-form-label text-gray-900"><strong>Agama</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="religion" required>
                                        <option disabled selected> --Pilih Agama-- </option>
                                        @foreach(['Buddha', 'Hindu', 'Islam', 'Katholik', 'Konghucu', 'Kristen'] as $option)
                                            <option {{ $bph->religion == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>             
                        </div>
                    </div>       
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address" class="col-form-label text-gray-900"><strong> Alamat </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address" value="{{ $bph->address }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_number" class="col-form-label text-gray-900"><strong> Nomor Handphone </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="phone_number" value="{{ $bph->phone_number }}" required>
                                </div>
                            </div>
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