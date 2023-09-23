@extends('dashboard.app')

@section('title', 'Data Diri Awardee')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_awardee', 'active')

@section('contents')
    <!-- konten modal-->
    <div class="modal-content ">
        <!-- heading modal -->
        <div class="modal-header justify-content-center">
            <h4 style="color: #f3c11d;"><strong> Data Diri Awardee </strong></h4>
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
                    <tr>
                        <td width="220"> Nama </td>
                        <td width="20"> : </td>
                        <td> {{ $penerima_beasiswa->name_awarde }} </td>
                    </tr>
                    <tr>
                        <td> NIM </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->nim_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Program Studi </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->study_program }} </td>
                    </tr>
                    <tr>
                        <td> Fakultas </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->faculty }} </td>
                    </tr>
                    <tr>
                        <td> Angkatan </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->generation }} </td>
                    </tr>
                    <tr>
                        <td> Email Akademik </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->email_academics_awarde }} </td>
                    </tr>           
                    <tr>
                        <td> Total SPP </td>
                        <td> : </td>
                        <td> Rp. {{ number_format($penerima_beasiswa->total_spp_awarde ,2,',','.') }} </td>
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
                            @if (!empty($penerima_beasiswa->place_of_birth) && !empty($penerima_beasiswa->date_of_birth))
                                {{ $penerima_beasiswa->place_of_birth }}/{{ \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format(' Y') }}
                            @else
                                {{ $penerima_beasiswa->place_of_birth ?: '-' }}/{{ $penerima_beasiswa->date_of_birth ? \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_of_birth)->format(' Y') : '-' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td> Jenis Kelamin </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->gender }} </td>
                    </tr>
                    <tr>
                        <td> Agama </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->religion }} </td>
                    </tr>
                    <tr>
                        <td> Alamat </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->address }} </td>
                    </tr>
                    <tr>
                        <td> Email Pribadi </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->email_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Nomor Handphone </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace($penerima_beasiswa->phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr>
                        <td> Anak Ke/Dari </td>
                        <td> : </td>
                        <td> 
                            {{ !empty($penerima_beasiswa->child_of_awarde) ? $penerima_beasiswa->child_of_awarde : '-' }}/
                            {{ !empty($penerima_beasiswa->number_of_siblings_awarde) ? $penerima_beasiswa->number_of_siblings_awarde : '-' }} Bersaudara
                        </td>
                    </tr>                                       
                    <tr>
                        <td> Tipe Akun </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->account_type_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Nomor Akun </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace(substr_replace($penerima_beasiswa->account_number_awarde, '-', 4, 0), '-', 9, 0), '-', 14, 0) }}</td>
                    </tr>
                    <tr>
                        <td> Nama Pemilik Akun </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->name_owner_of_account }} </td>
                    </tr>
                    <tr>
                        <td> Akun Instagram </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->instagram_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Akun Facebook </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->facebook_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Hobby </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->hobby }} </td>
                    </tr>
                </table>
            </section>
            <section id="content3">
                <table class="table table-borderless text-gray-900">
                    <tr>
                        <td width="250"> Nama Ayah </td>
                        <td width="20"> : </td>
                        <td> {{ $penerima_beasiswa->name_of_father_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Pekerjaan Ayah </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->father_occupation_of_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Pendapatan Ayah </td>
                        <td> : </td>
                        <td> Rp. {{ number_format($penerima_beasiswa->father_income_of_awarde,2,',','.') }} </td>
                    </tr>
                    <tr>
                        <td> Nomor HP Ayah </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace($penerima_beasiswa->father_phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr>
                        <td> Nama Ibu </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->name_of_mother_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Pekerjaan Ibu </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->mother_occupation_of_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Pendapatan Ibu </td>
                        <td> : </td>
                        <td> Rp. {{ number_format($penerima_beasiswa->mother_income_of_awarde,2,',','.') }} </td>
                    </tr>
                    <tr>
                        <td> Nomor HP Ibu </td>
                        <td> : </td>
                        <td>{{ substr_replace(substr_replace($penerima_beasiswa->mother_phone_number_awarde, '-', 4, 0), '-', 9, 0) }}</td>
                    </tr>
                    <tr>
                        <td> Alamat Orang-tua </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->address_of_parents_awarde }} </td>
                    </tr>
                    <tr>
                        <td> Jumlah Tanggungan Orang-tua </td>
                        <td> : </td>
                        <td> {{ $penerima_beasiswa->dependents_of_parents_awarde }} </td>
                    </tr>
                </table>
            </section>
            <section id="content4">
                <table class="table table-borderless text-gray-900">                  
                    <tr>
                        <td width="250"> Tanggal Diberikan Beasiswa </td>
                        <td width="20"> : </td>
                        <td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            {{ \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_set_as_awardee)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_set_as_awardee)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $penerima_beasiswa->date_set_as_awardee)->format(' Y') }}
                        </td>          
                    </tr>
                    <tr>
                        <td> Tanggal Berakhir Beasiswa </td>
                        <td> : </td>
                        <td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            $end_date_as_awardee = $penerima_beasiswa->end_date_as_awardee;
                            if ($end_date_as_awardee) {
                                $dateTime = \DateTime::createFromFormat('Y-m-d', $end_date_as_awardee);
                                if ($dateTime) {
                                    $bulan = $bulanIndonesia[(int)$dateTime->format('m') - 1];
                                    echo $dateTime->format('j ') . $bulan . $dateTime->format(' Y');
                                } else {
                                    echo "-";
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                    </tr>     
                    <tr>
                        <td> Status Beasiswa </td>
                        <td> : </td>
                        <td>
                            @if ($penerima_beasiswa->status == 'Masih aktif')
                            <span class="badge badge-success">Masih Aktif</span>
                            @else
                            <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>                          
                    <tr>
                        <td> Alasan Menerima Beasiswa </td>
                        <td> : </td>
                        <td> {!! $penerima_beasiswa->description !!} </td>
                    </tr>
                </table>
            </section>
        </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href='/anggota_awardee' type="button" class="btn btn-warning"> Back </a>
            </div>
        </div>
    </div>
@endsection