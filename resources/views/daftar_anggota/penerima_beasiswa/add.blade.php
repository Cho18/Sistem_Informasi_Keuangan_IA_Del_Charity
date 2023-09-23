@extends('dashboard.app')

@section('title', 'Tambah Awardee')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_awardee', 'active')

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

    <form class="form-group" action="add_awarde" method="post">
    @csrf
        <!-- konten modal-->
        <div class="modal-content ">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1949e6;"><strong> Tambah Awardee </strong></h4>
            </div>
                <!-- body modal --> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_awarde" class="col-form-label text-gray-800"><strong> Nama Awardee </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_awarde" placeholder="nama lengkap awardee" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nim_awarde" class="col-form-label text-gray-800"><strong> NIM </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="nim_awarde" placeholder="nim awardee">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="study_program" class="col-form-label text-gray-800"><strong> Program Studi </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="study_program" placeholder="program studi">
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
                                    <select class="form-control text-gray-900" name="faculty" placeholder="fakultas">
                                        <option disabled selected> -- Pilih Fakultas -- </option>
                                        <option> Fakultas Bioteknologi </option>
                                        <option> Fakultas Informatika & Teknik Elektro </option>
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
                                <label for="date_set_as_awardee" class="col-form-label text-gray-800"><strong> Tanggal Diberikan Beasiswa </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_set_as_awardee" placeholder="tanggal lahir" id="dateInput" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="end_date_as_awardee" class="col-form-label text-gray-800"><strong> Tanggal Berakhir Beasiswa </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="end_date_as_awardee" placeholder="tanggal lahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="status" class="col-form-label text-gray-800"><strong> Status Beasiswa </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="status" placeholder="status beasiswa" required>
                                        <option disabled selected> -- Pilih Status Beasiswa -- </option>
                                        <option> Masih Aktif </option>
                                        <option> Tidak Aktif </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email_academics_awarde" class="col-form-label text-gray-800"><strong> Email Akademik </strong></label>
                                <div class="container">
                                    <input type="email" class="form-control text-gray-900" name="email_academics_awarde" placeholder="email akademik">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="total_spp_awarde" class="col-form-label text-gray-800"><strong> Total SPP </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="total_spp_awarde" placeholder="1234567890" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-800"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" placeholder="tempat lahir">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="religion" class="col-form-label text-gray-800"><strong> Agama </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="religion" placeholder="agama">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address" class="col-form-label text-gray-800"><strong> Alamat </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address" placeholder="alamat tempat tinggal">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email_awarde" class="col-form-label text-gray-800"><strong> Email Pribadi </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="email_awarde" placeholder="email pribadi">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="phone_number_awarde" class="col-form-label text-gray-800"><strong> No Handphone </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="phone_number_awarde" placeholder="080808080808">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="child_of_awarde" class="col-form-label text-gray-800"><strong> Anak Ke </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="child_of_awarde" placeholder="anak ke">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="number_of_siblings_awarde" class="col-form-label text-gray-800"><strong> Jumlah Saudara </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="number_of_siblings_awarde" placeholder="jumlah saudara">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account_type_awarde" class="col-form-label text-gray-800"><strong> Tipe Akun </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="account_type_awarde" placeholder="tipe akun">
                                        <option disabled selected> -- Pilih Tipe Akun -- </option>
                                        <option> Bank BCA </option>
                                        <option> Bank BNI </option>
                                        <option> Bank BRI </option>
                                        <option> Bank Mandiri </option>
                                        <option> Bank Permata </option>
                                        <option> Bank SUMUT </option>
                                        <option> Bank Syariah Indonesia </option>
                                        <option> DANA </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account_number_awarde" class="col-form-label text-gray-800"><strong> Nomor Akun </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="account_number_awarde" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_owner_of_account" class="col-form-label text-gray-800"><strong> Nama Pemilik Akun </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_owner_of_account" placeholder="nama pemilik akun">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="instagram_awarde" class="col-form-label text-gray-800"><strong> Akun Instagram </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="instagram_awarde" placeholder="akun instagram" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="facebook_awarde" class="col-form-label text-gray-800"><strong> Akun Facebook </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="facebook_awarde" placeholder="akun facebook" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="hobby" class="col-form-label text-gray-800"><strong> Hobby </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="hobby" placeholder="hobby" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_father_awarde" class="col-form-label text-gray-800"><strong> Nama Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_father_awarde" placeholder="nama ayah awardee">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_occupation_of_awarde" class="col-form-label text-gray-800"><strong> Pekerjaan Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="father_occupation_of_awarde" placeholder="pekerjaan ayah awardee">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_income_of_awarde" class="col-form-label text-gray-800"><strong> Pendapatan Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_income_of_awarde" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_phone_number_awarde" class="col-form-label text-gray-800"><strong> No HP Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_phone_number_awarde" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_mother_awarde" class="col-form-label text-gray-800"><strong> Nama Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_mother_awarde" placeholder="nama ibu awardee">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_occupation_of_awarde" class="col-form-label text-gray-800"><strong> Pekerjaan Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="mother_occupation_of_awarde" placeholder="pekerjaan ibu awardee">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_income_of_awarde" class="col-form-label text-gray-800"><strong> Pendapatan Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_income_of_awarde" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_phone_number_awarde" class="col-form-label text-gray-800"><strong> No HP Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_phone_number_awarde" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address_of_parents_awarde" class="col-form-label text-gray-800"><strong> Alamat Orang-tua </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address_of_parents_awarde" placeholder="tempat tinggal orang-tua">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="dependents_of_parents_awarde" class="col-form-label text-gray-800"><strong> Jumlah Tanggungan Orang-tua </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="dependents_of_parents_awarde" placeholder="jumlah tanggungan orang-tua" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description" class="col-form-label text-gray-800"><strong> Deskripsi </strong></label>
                                <div class="container">
                                    <input type="hidden" class="form-control text-gray-900" name="description" id="x">
                                    <trix-editor input="x" class="text-gray-900" placeholder="Alasan Menerima Beasiswa"></trix-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='/anggota_awardee' type="button" class="btn btn-warning"> Back </a>
                    <button type="submit" class="btn btn-primary"> Add </button>
                </div>
            </div>
        </div>
    </div> 
</form>
@endsection