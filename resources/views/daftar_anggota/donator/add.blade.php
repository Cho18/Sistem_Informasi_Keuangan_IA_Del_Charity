@extends('dashboard.app')

@section('title', 'Tambah Donator')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_donator', 'active')

@section('contents')

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show col-md-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form class="form-group" action="add_donator" method="post">
    @csrf
        <!-- konten modal-->
        <div class="modal-content ">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1949e6;"><strong> Tambah Donator </strong></h4>
            </div>
                <!-- body modal --> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label text-gray-800 d-block"><strong> Kode Nama Donator</strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="code_name" placeholder="kode nama donator" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label text-gray-800 d-block"><strong> Nama Donator</strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name" placeholder="nama lengkap donator" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="bph_id" class="col-form-label text-gray-800"><strong> PIC </strong></label>
                                <div class="col-md-12">
                                    <select class="form-control text-gray-900" name="bph_id" data-live-search="true">
                                        <option disabled selected> -- Pilih PIC -- </option>
                                        @foreach ($bph->sortBy('nama') as $pg)
                                            <option value="{{ $pg->id }}"> {{ $pg->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="alumni" class="col-form-label text-gray-800"><strong> Alumni </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="alumni" placeholder="alumni">
                                        <option disabled selected> -- Pilih Alumni -- </option>
                                        <option> IAD </option>
                                        <option> NIAD </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="study_program" class="col-form-label text-gray-800"><strong> Program Studi </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="study_program" placeholder="program studi" data-live-search="true">
                                        <option disabled selected> -- Pilih Program Studi -- </option>
                                        <option> D3 Teknologi Informasi </option>
                                        <option> D3 Teknologi Komputer </option>
                                        <option> D4 Teknologi Rekayasa Perangkat Lunak </option>
                                        <option> S1 Informatika </option>
                                        <option> S1 Manajemen Rekayasa </option>
                                        <option> S1 Sistem Informasi </option>
                                        <option> S1 Teknik Bioproses </option>
                                        <option> S1 Teknik Elektro </option>
                                    </select>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="faculty" class="col-form-label text-gray-800"><strong> Fakultas </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="faculty" placeholder="fakultas" data-live-search="true">
                                        <option disabled selected> -- Pilih Fakultas -- </option>
                                        <option> Fakultas Bioteknologi </option>
                                        <option> Fakultas Informatika &amp; Teknik Elektro </option>
                                        <option> Fakultas Teknologi Industri </option>
                                        <option> Fakultas Vokasi </option>
                                    </select>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="generation" class="col-form-label text-gray-800"><strong> Angkatan </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="generation" placeholder="angkatan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-800"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" placeholder="tempat lahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_of_birth" class="col-form-label text-gray-800"><strong> Tanggal Lahir </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_birth" placeholder="tanggal lahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="gender" class="col-form-label text-gray-800"><strong> Jenis Kelamin </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="gender" placeholder="jenis kelamin">
                                        <option disabled selected> -- Pilih Jenis Kelamin -- </option>
                                        <option> Female </option>
                                        <option> Male </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="religion" class="col-form-label text-gray-800"><strong> Agama </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="religion" placeholder="agama" data-live-search="true">
                                        <option disabled selected> -- Pilih Agama -- </option>
                                        <option> Buddha </option>
                                        <option> Hindu </option>
                                        <option> Islam </option>
                                        <option> Katholik </option>
                                        <option> Konghucu </option>
                                        <option> Kristen </option>
                                    </select>                        
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address" class="col-md-3col-form-label text-gray-800"><strong> Alamat </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address" placeholder="alamat tempat tinggal">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="phone_number" class="col-form-label text-gray-800"><strong> No Handphone </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="phone_number" placeholder="08080808080808">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_of_joining" class="col-form-label text-gray-800"><strong> Tanggal Bergabung </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_joining" placeholder="tanggal bergabung" id="dateInput" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email" class="col-form-label text-gray-800"><strong> Email Donator </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="email" placeholder="email donator">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="struktur_donator" class="col-form-label text-gray-800"><strong> Struktur Donator :</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="struktur_donator" placeholder="struktur donator" required>
                                        <option disabled selected> -- Pilih Struktur Donator -- </option>
                                        <option> Donator tetap </option>
                                        <option> Donator tidak tetap </option>
                                    </select>                        
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description" class="col-form-label text-gray-800"><strong> Deskripsi </strong></label>
                                    <div class="container">
                                        <input type="hidden" class="form-control text-gray-900" name="description" id="x">
                                        <trix-editor input="x" class="text-gray-900"></trix-editor>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='/donator' type="button" class="btn btn-warning"> Back </a>
                    <button type="submit" class="btn btn-primary"> Add </button>
                </div>
            </div>
        </div>
    </div> 
</form>
@endsection