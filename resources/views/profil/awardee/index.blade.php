@extends('dashboard.app')

@section('title', 'Data Diri Saya')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_awardee', 'active')

@section('contents')

    @if (session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- konten modal-->
    <div class="modal-content ">
        <!-- heading modal -->
        <div class="modal-header justify-content-center">
            <h4 class="text-primary"><strong> Data Diri Saya </strong></h4>
        </div>
        <div class="container">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1" class="text-gray-900"> Data Akademis </label>
                
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2" class="text-gray-900"> Data Pribadi </label>
                
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" class="text-gray-900"> Data Orang-tua </label>

            <input id="tab4" type="radio" name="tabs">
            <label for="tab4" class="text-gray-900"> Data Beasiswa </label>
            
            <section id="content1">
                <table class="table table-borderless text-gray-900">
                    <tr></tr>
                        <td width="250"> Nama </td>
                        <td width="20"> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->name_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> NIM </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->nim_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Program Studi </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->study_program }} </td>
                    </tr>
                    <tr></tr>
                        <td> Fakultas </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->faculty }} </td>
                    </tr>
                    <tr></tr>
                        <td> Angkatan </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->generation }} </td>
                    </tr>
                    <tr></tr>
                        <td> Email Akademik </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->email_academics_awarde }} </td>
                    </tr>                   
                    <tr></tr>
                        <td> Total SPP </td>
                        <td> : </td>
                        <td> Rp {{ number_format(Auth::user()->penerima_beasiswa->total_spp_awarde ,2,',','.') }} </td>
                    </tr>
                </table>
            </section>
            <section id="content2">
                <table class="table table-borderless text-gray-900">
                    <tr>
                        <td width="250"> Tempat/Tanggal Lahir </td>
                        <td width="20"> : </td>
                        <td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            @if (!empty(Auth::user()->place_of_birth) && !empty(Auth::user()->donor->date_of_birth))
                                {{ Auth::user()->place_of_birth }}/{{ \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format(' Y') }}
                            @else
                                {{ Auth::user()->place_of_birth ?: '-' }}/{{ Auth::user()->date_of_birth ? \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format(' Y') : '-' }}
                            @endif
                        </td>
                    </tr>                  
                    <tr></tr>
                        <td> Jenis Kelamin </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->gender }} </td>
                    </tr>
                    <tr></tr>
                        <td> Agama </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->religion }} </td>
                    </tr>
                    <tr></tr>
                        <td> Alamat </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->address }} </td>
                    </tr>
                    <tr></tr>
                        <td> Email Pribadi </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->email_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Nomor Handphone </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace(Auth::user()->penerima_beasiswa->phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr>
                        <td> Anak Ke/Dari </td>
                        <td> : </td>
                        <td> 
                            {{ !empty(Auth::user()->child_of_awarde) ? Auth::user()->child_of_awarde : '-' }}/
                            {{ !empty(Auth::user()->number_of_siblings_awarde) ? Auth::user()->number_of_siblings_awarde : '-' }} Bersaudara
                        </td>
                    </tr> 
                    <tr></tr>
                        <td> Tipe Akun </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->account_type_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Nomor Akun </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace(substr_replace(Auth::user()->penerima_beasiswa->account_number_awarde, '-', 4, 0), '-', 9, 0), '-', 14, 0) }}</td>
                    </tr>
                    <tr></tr>
                        <td> Nama Pemilik Akun </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->name_owner_of_account }} </td>
                    </tr>
                    <tr></tr>
                        <td> Akun Instagram </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->instagram_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Akun Facebook </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->facebook_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Hobby </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->hobby }} </td>
                    </tr>
                </table>
            </section>
            <section id="content3">
                <table class="table table-borderless text-gray-900">
                    <tr></tr>
                        <td width="250"> Nama Ayah </td>
                        <td width="20"> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->name_of_father_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Pekerjaan Ayah </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->father_occupation_of_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Pendapatan Ayah </td>
                        <td> : </td>
                        <td> Rp {{ number_format(Auth::user()->penerima_beasiswa->father_income_of_awarde,2,',','.') }} </td>
                    </tr>
                    <tr></tr>
                        <td> Nomor HP Ayah </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace(Auth::user()->penerima_beasiswa->father_phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr></tr>
                        <td> Nama Ibu </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->name_of_mother_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Pekerjaan Ibu </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->mother_occupation_of_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Pendapatan Ibu </td>
                        <td> : </td>
                        <td> Rp {{ number_format(Auth::user()->penerima_beasiswa->mother_income_of_awarde,2,',','.') }} </td>
                    </tr>
                    <tr></tr>
                        <td> Nomor HP Ibu </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace(Auth::user()->penerima_beasiswa->mother_phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr></tr>
                        <td> Alamat Orang-tua </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->address_of_parents_awarde }} </td>
                    </tr>
                    <tr></tr>
                        <td> Jumlah Tanggungan Orang-tua </td>
                        <td> : </td>
                        <td> {{ Auth::user()->penerima_beasiswa->dependents_of_parents_awarde }} </td>
                    </tr>
                </table>
            </section>
            <section id="content4">
                <table class="table table-borderless text-gray-900">                     
                    <tr>
                        <td width="250"> Tanggal Diberikan Beasiswa </td>
                        <td width="20"> : </td>
                        <?php
                        $bulanIndonesia = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        ?>
                        <td>{{ \DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->date_set_as_awardee)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->date_set_as_awardee)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->date_set_as_awardee)->format(' Y') }}</td>
                    </tr>
                    <tr>
                        <td> Tanggal Berakhir Beasiswa </td>
                        <td> : </td>
                        <?php
                        $bulanIndonesia = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        ?>
                        <td>
                            @if (isset(Auth::user()->penerima_beasiswa->end_date_as_awardee))
                                {{ \DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->end_date_as_awardee)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->end_date_as_awardee)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->penerima_beasiswa->end_date_as_awardee)->format(' Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>      
                    <tr>
                        <td width="250"> Status Beasiswa </td>
                        <td width="20"> : </td>
                        <td>
                            @if (Auth::user()->penerima_beasiswa->status == 'Masih aktif')
                            <span class="badge badge-success">Masih Aktif</span>
                            @else
                            <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>               
                    <tr></tr>
                        <td> Alasan Menerima Beasiswa </td>
                        <td> : </td>
                        <td> {!! Auth::user()->penerima_beasiswa->description !!} </td>
                    </tr>
                </table>
            </section>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href="/edit_pa/{{ Auth::user()->penerima_beasiswa->id }}" type="button" class="btn btn-warning"> Edit Data Diri </a>
            </div>
        </div>
    </div>
@endsection