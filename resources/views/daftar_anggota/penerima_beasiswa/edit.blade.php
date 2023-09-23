@extends('dashboard.app')

@section('title', 'Edit Data Awardee')

@section('daftar_anggota', 'active')
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
    <form class="form-group" action="/edit_pb/{{ $pb->id }}" method="post">
    @csrf
    @method('put')
        <!-- konten modal-->
        <div class="modal-content ">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1b8112;"><strong> Edit Data Awardee </strong></h4>
            </div>
                <!-- body modal --> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_awarde" class="col-form-label text-gray-800"><strong> Nama Awardee </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_awarde" value="{{ $pb->name_awarde }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nim_awarde" class="col-form-label text-gray-800"><strong> NIM </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="nim_awarde" value="{{ $pb->nim_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="study_program" class="col-form-label text-gray-800"><strong> Program Studi </strong></label>
                                <div class="container">
                                    @php
                                        $studyPrograms = ['S1 Informatika', 'S1 Manajemen Rekayasa', 'S1 Sistem Informasi', 'S1 Teknik Bioproses', 'S1 Teknik Elektro', 'D4 Teknologi Rekayasa Perangkat Lunak', 'D3 Teknologi Informasi', 'D3 Teknologi Komputer'];
                                        sort($studyPrograms);
                                    @endphp
                                    <select class="form-control text-gray-900" name="study_program">
                                        <option disabled selected> -- Pilih Program Studi -- </option>
                                        @foreach ($studyPrograms as $option)
                                            <option {{ $pb->study_program == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="faculty" class="col-form-label text-gray-800"><strong> Fakultas </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="faculty">
                                        <option disabled selected> -- Pilih Fakultas -- </option>
                                        @foreach(['Fakultas Bioteknologi', 'Fakultas Informatika & Teknik Elektro', 'Fakultas Teknologi Industri', 'Fakultas Vokasi'] as $option)
                                            <option {{ $pb->faculty == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="generation" class="col-form-label text-gray-800"><strong> Angkatan </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="generation" value="{{ $pb->generation }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_set_as_awardee" class="col-form-label text-gray-800"><strong> Tanggal Diberikan Beasiswa </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_set_as_awardee" value="{{ $pb->date_set_as_awardee }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="end_date_as_awardee" class="col-form-label text-gray-800"><strong> Tanggal Berakhir Beasiswa </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="end_date_as_awardee" value="{{ $pb->end_date_as_awardee }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="status" class="col-form-label text-gray-800"><strong> Status Beasiswa </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="status">
                                        <option disabled selected> --Pilih Status Beasiswa-- </option>
                                        @foreach(['Masih aktif', 'Tidak aktif'] as $option)
                                            <option {{ $pb->status == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
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
                                    <input type="email" class="form-control text-gray-900" name="email_academics_awarde" value="{{ $pb->email_academics_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="total_spp_awarde" class="col-form-label text-gray-800"><strong> Total SPP </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="total_spp_awarde" value="{{ $pb->total_spp_awarde }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="place_of_birth" class="col-form-label text-gray-800"><strong> Tempat Lahir </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="place_of_birth" value="{{ $pb->place_of_birth }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_of_birth" class="col-form-label text-gray-800"><strong> Tanggal Lahir </strong></label>
                                <div class="container">
                                    <input type="date" class="form-control text-gray-900" name="date_of_birth" value="{{ $pb->date_of_birth }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="gender" class="col-form-label text-gray-800"><strong> Jenis Kelamin </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="gender">
                                        <option disabled selected> -- Pilih Jenis Kelamin -- </option>
                                        @foreach(['Female', 'Male'] as $option)
                                            <option {{ $pb->gender == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="religion" class="col-form-label text-gray-800"><strong> Agama </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="religion">
                                        <option disabled selected> -- Pilih Agama -- </option>
                                        @foreach(['Buddha', 'Hindu', 'Islam', 'Katholik', 'Konghucu', 'Kristen'] as $option)
                                            <option {{ $pb->religion == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
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
                                    <input type="text" class="form-control text-gray-900" name="address" value="{{ $pb->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email_awarde" class="col-form-label text-gray-800"><strong> Email Pribadi </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="email_awarde" value="{{ $pb->email_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="phone_number_awarde" class="col-form-label text-gray-800"><strong> No Handphone </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="phone_number_awarde" value="{{ $pb->phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="child_of_awarde" class="col-form-label text-gray-800"><strong> Anak Ke </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="child_of_awarde" value="{{ $pb->child_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="number_of_siblings_awarde" class="col-form-label text-gray-800"><strong> Jumlah Saudara </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="number_of_siblings_awarde" value="{{ $pb->number_of_siblings_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account_type_awarde" class="col-form-label text-gray-800"><strong> Tipe Akun </strong></label>
                                <div class="container">
                                    <select class="form-control text-gray-900" name="account_type_awarde">
                                        <option disabled selected> -- Pilih Tipe Akun -- </option>
                                        @foreach(['Bank BCA', 'Bank Mandiri', 'Bank BNI', 'Bank Permata', 'Bank BRI', 'Bank Syariah Indonesia', 'DANA'] as $option)
                                            <option {{ $pb->account_type_awarde == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
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
                                    <input type="number" class="form-control text-gray-900" name="account_number_awarde" value="{{ $pb->account_number_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_owner_of_account" class="col-form-label text-gray-800"><strong> Nama Pemilik Akun </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_owner_of_account" value="{{ $pb->name_owner_of_account }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="instagram_awarde" class="col-form-label text-gray-800"><strong> Akun Instagram </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="instagram_awarde" value="{{ $pb->instagram_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="facebook_awarde" class="col-form-label text-gray-800"><strong> Akun Facebook </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="facebook_awarde" value="{{ $pb->facebook_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="hobby" class="col-form-label text-gray-800"><strong> Hobby </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="hobby" value="{{ $pb->hobby }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_father_awarde" class="col-form-label text-gray-800"><strong> Nama Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_father_awarde" value="{{ $pb->name_of_father_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_occupation_of_awarde" class="col-form-label text-gray-800"><strong> Pekerjaan Ayah </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="father_occupation_of_awarde" value="{{ $pb->father_occupation_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_income_of_awarde" class="col-form-label text-gray-800"><strong> Pendapatan Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_income_of_awarde" value="{{ $pb->father_income_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="father_phone_number_awarde" class="col-form-label text-gray-800"><strong> No HP Ayah </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="father_phone_number_awarde" value="{{ $pb->father_phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name_of_mother_awarde" class="col-form-label text-gray-800"><strong> Nama Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="name_of_mother_awarde" value="{{ $pb->name_of_mother_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_occupation_of_awarde" class="col-form-label text-gray-800"><strong> Pekerjaan Ibu </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="mother_occupation_of_awarde" value="{{ $pb->mother_occupation_of_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_income_of_awarde" class="col-form-label text-gray-800"><strong> Pendapatan Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_income_of_awarde" value="{{ $pb->mother_income_of_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_phone_number_awarde" class="col-form-label text-gray-800"><strong> No HP Ibu </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="mother_phone_number_awarde" value="{{ $pb->mother_phone_number_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address_of_parents_awarde" class="col-form-label text-gray-800"><strong> Alamat Orang-tua </strong></label>
                                <div class="container">
                                    <input type="text" class="form-control text-gray-900" name="address_of_parents_awarde" value="{{ $pb->address_of_parents_awarde }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="dependents_of_parents_awarde" class="col-form-label text-gray-800"><strong> Jumlah Tanggungan Orang-tua </strong></label>
                                <div class="container">
                                    <input type="number" class="form-control text-gray-900" name="dependents_of_parents_awarde" value="{{ $pb->dependents_of_parents_awarde }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description" class="col-form-label text-gray-800"><strong> Deskripsi </strong></label>
                                <div class="container">
                                    <input type="hidden" class="form-control text-gray-900" name="description" id="x" value="{{ $pb->description }}">
                                    <trix-editor input="x" class="text-gray-900" placeholder="Alasan Menerima Beasiswa"></trix-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='/anggota_awardee' type="button" class="btn btn-warning"> Back </a>
                    <button type="submit" class="btn btn-success"> Update </button>
                </div>
            </div>
        </div>
    </div> 
</form>
@endsection