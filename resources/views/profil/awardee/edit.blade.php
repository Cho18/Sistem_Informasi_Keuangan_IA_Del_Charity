@extends('dashboard.app')

@section('title', 'Edit Data Diri')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_awardee', 'active')

@section('contents')
    <form class="form-group" action="/edit_pa/{{ $awardee->id }}" method="POST">
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
                    <input type="hidden" name="id" value="{{ $awardee->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label text-gray-900"><strong> Nama Anda </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_awarde" value="{{ $awardee->name_awarde }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nim_awarde" class=" col-form-label text-gray-900"><strong> NIM </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="nim_awarde" placeholder="nomor induk mahasiswa" value="{{ $awardee->nim_awarde }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="study_program" class=" col-form-label text-gray-900"><strong>Program Studi</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="study_program" required>
                                        <option disabled selected> -- Pilih Program Studi -- </option>
                                        @foreach(['S1 Informatika', 'S1 Manajemen Rekayasa', 'S1 Sistem Informasi', 'S1 Teknik Bioproses', 'S1 Teknik Elektro', 'D4 Teknologi Rekayasa Perangkat Lunak', 'D3 Teknologi Informasi', 'D3 Teknologi Komputer'] as $option)
                                            <option {{ $awardee->study_program == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="faculty" class=" col-form-label text-gray-900"><strong>Fakultas</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="faculty" required>
                                        <option disabled selected> -- Pilih Fakultas -- </option>
                                        @foreach(['Fakultas Bioteknologi', 'Fakultas Informatika & Teknik Elektro', 'Fakultas Teknologi Industri', 'Fakultas Vokasi'] as $option)
                                            <option {{ $awardee->faculty == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="generation" class=" col-form-label text-gray-900"><strong> Angkatan </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="generation" placeholder="angkatan" value="{{ $awardee->generation }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email_academics_awarde" class="col-form-label text-gray-900"><strong> Email Akdemik </strong></label>
                                <div class="container">
                                    <input type="email" class="form-control text-gray-900" name="email_academics_awarde" placeholder="email akademik" value="{{ $awardee->email_academics_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-900"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" placeholder="tempat lahir" value="{{ $awardee->place_of_birth }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_of_birth" class=" col-form-label text-gray-900"><strong> Tanggal Lahir </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_birth" placeholder="tanggal lahir" value="{{ $awardee->date_of_birth }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="gender" class=" col-form-label text-gray-900"><strong> Jenis Kelamin </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="gender">
                                        <option disabled selected> -- Pilih Jenis Kelamin -- </option>
                                        @foreach(['Female', 'Male'] as $option)
                                            <option {{ $awardee->gender == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="religion" class=" col-form-label text-gray-900"><strong> Agama </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="religion" data-live-search="true">
                                        <option disabled selected> -- Pilih Agama -- </option>
                                        @foreach(['Buddha', 'Hindu', 'Islam', 'Katholik', 'Konghucu', 'Kristen'] as $option)
                                            <option {{ $awardee->religion == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="row">     
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address" class="col-form-label text-gray-900"><strong> Alamat </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address" placeholder="alamat tinggal" value="{{ $awardee->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email_awarde" class="col-form-label text-gray-900"><strong> Email Pribadi </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="email_awarde" placeholder="email pribadi" value="{{ $awardee->email_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="phone_number_awarde" class=" col-form-label text-gray-900"><strong> No Handphone </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="phone_number_awarde" placeholder="nomor handphone" value="{{ $awardee->phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="child_of_awarde" class="col-form-label text-gray-900"><strong> Anak Ke </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="child_of_awarde" placeholder="anak keberapa" value="{{ $awardee->child_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="number_of_siblings_awarde" class="col-form-label text-gray-900"><strong> Jumlah Saudara </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="number_of_siblings_awarde" placeholder="jumlah saudara" value="{{ $awardee->number_of_siblings_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account_type_awarde" class=" col-form-label text-gray-900"><strong>Tipe Akun</strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="account_type_awarde" required>
                                        <option disabled selected> -- Pilih Tipe Akun -- </option>
                                        @foreach(['Bank BNI', 'Bank BRI', 'Bank BCA', 'Bank Mandiri', 'Bank Permata', 'Bank SUMUT', 'Bank Syariah Indonesia', 'DANA'] as $option)
                                            <option {{ $awardee->account_type_awarde == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>   
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account_number_awarde" class="col-form-label text-gray-900"><strong> Nomor Akun </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="account_number_awarde" placeholder="nomor akun" value="{{ $awardee->account_number_awarde }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_owner_of_account" class="col-form-label text-gray-900"><strong> Nama Pemilik Akun </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_owner_of_account" placeholder="nama pemilik akun" value="{{ $awardee->name_owner_of_account }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="instagram_awarde" class="col-form-label text-gray-900"><strong> Akun Instagram </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="instagram_awarde" placeholder="nama akun instagram" value="{{ $awardee->instagram_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="facebook_awarde" class="col-form-label text-gray-900"><strong> Akun Facebook </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="facebook_awarde" placeholder="nama akun facebook" value="{{ $awardee->facebook_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="hobby" class="col-form-label text-gray-900"><strong> Hobby </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="hobby" placeholder="hobby" value="{{ $awardee->hobby }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_father_awarde" class="col-form-label text-gray-900"><strong> Nama Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_father_awarde" placeholder="nama ayah" value="{{ $awardee->name_of_father_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_occupation_of_awarde" class=" col-form-label text-gray-900"><strong> Pekerjaan Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="father_occupation_of_awarde" placeholder="pekerjaan ayah" value="{{ $awardee->father_occupation_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_income_of_awarde" class="col-form-label text-gray-900"><strong> Pendapatan Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_income_of_awarde" placeholder="rentang pendapatan ayah" value="{{ $awardee->father_income_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_phone_number_awarde" class="col-form-label text-gray-900"><strong> No HP Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_phone_number_awarde" placeholder="nomor handphone ayah" value="{{ $awardee->father_phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_mother_awarde" class="col-form-label text-gray-900"><strong> Nama Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_mother_awarde" placeholder="nama ibu" value="{{ $awardee->name_of_mother_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_occupation_of_awarde" class="col-form-label text-gray-900"><strong> Pekerjaan Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="mother_occupation_of_awarde" placeholder="pekerjaan ibu" value="{{ $awardee->mother_occupation_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_income_of_awarde" class="col-form-label text-gray-900"><strong> Pendapatan Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_income_of_awarde" placeholder="rentang pendapatan ibu" value="{{ $awardee->mother_income_of_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_phone_number_awarde" class="col-form-label text-gray-900"><strong> No HP Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_phone_number_awarde" placeholder="nomor handphone ibu" value="{{ $awardee->mother_phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address_of_parents_awarde" class="col-form-label text-gray-900"><strong> Alamat Orang-tua </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address_of_parents_awarde" placeholder="alamat tinggal orang-tua" value="{{ $awardee->address_of_parents_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="dependents_of_parents_awarde" class="col-form-label text-gray-900"><strong> Jumlah Tanggungan Orang-tua </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="dependents_of_parents_awarde" placeholder="jumlah tanggungan orang-tua" value="{{ $awardee->dependents_of_parents_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"> Update </button>
                <a href='/profil_awardee' type="button" class="btn btn-warning"> Back </a>
            </div>
        </div>
    </form>
@endsection