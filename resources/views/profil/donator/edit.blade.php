@extends('dashboard.app')

@section('title', 'Edit Data Diri')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_donator', 'active')

@section('contents')
    <form class="form-group" action="/edit_pd/{{ $donatur->id }}" method="POST">
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
                    <input type="hidden" name="id" value="{{ $donatur->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label text-gray-900"><strong> Nama Donator </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name" value="{{ $donatur->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="study_program" class="col-form-label text-gray-900"><strong>Program Studi</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="study_program" required>
                                        <option disabled selected> --Pilih Program Studi-- </option>
                                        @foreach(['S1 Informatika', 'S1 Manajemen Rekayasa', 'S1 Sistem Informasi', 'S1 Teknik Bioproses', 'S1 Teknik Elektro', 'D4 Teknologi Rekayasa Perangkat Lunak', 'D3 Teknologi Informasi', 'D3 Teknologi Komputer'] as $option)
                                            <option {{ $donatur->study_program == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="faculty" class="col-form-label text-gray-900"><strong>Fakultas</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="faculty" required>
                                        <option disabled selected> --Pilih Fakultas-- </option>
                                        @foreach(['Fakultas Bioteknologi', 'Fakultas Informatika & Teknik Elektro', 'Fakultas Teknologi Industri', 'Fakultas Vokasi'] as $option)
                                            <option {{ $donatur->faculty == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>      
                        </div>       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="generation" class="col-form-label text-gray-900"><strong> Angkatan </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="generation" value="{{ $donatur->generation }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-900"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" value="{{ $donatur->place_of_birth }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date_of_birth" class="col-form-label text-gray-900"><strong> Tanggal Lahir </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_birth" value="{{ $donatur->date_of_birth }}" required>
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
                                            <option {{ $donatur->gender == $option ? 'selected' : '' }}>{{ $option }}</option>
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
                                            <option {{ $donatur->religion == $option ? 'selected' : '' }}>{{ $option }}</option>
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
                                    <input type="text" class="form-control text-gray-900" name="address" value="{{ $donatur->address }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_number" class="col-form-label text-gray-900"><strong> Nomor Handphone </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="phone_number" value="{{ $donatur->phone_number }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href='/profil_donator' type="button" class="btn btn-warning"> Back </a>
                <button type="submit" class="btn btn-success"> Update </button>
            </div>
        </div>
    </form>
@endsection