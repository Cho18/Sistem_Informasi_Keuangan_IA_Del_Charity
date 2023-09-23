@extends('dashboard.app')

@section('title', 'Data Diri Saya')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_donator', 'active')

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
            <h4 style="color: #f3c11d;"><strong> Data Diri Saya </strong></h4>
        </div>
        <div class="container">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1" class="text-gray-900"> Data Akademis </label>

            <input id="tab2" type="radio" name="tabs" checked>
            <label for="tab2" class="text-gray-900"> Data Pribadi </label>
                
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" class="text-gray-900"> Data Donator </label>
            
            <section id="content1">
                <table class="table table-borderless text-gray-900">
                    <tr>
                        <td width="200"> Program Studi </td>
                        <td width="20"> : </td>
                        <td> {{ Auth::user()->donor->study_program }} </td>
                    </tr>
                    <tr>
                        <td> Fakultas </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->faculty }} </td>
                    </tr>
                    <tr>
                        <td> Angkatan </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->generation }} </td>
                    </tr>
                    <tr>
                        <td> Alumni </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->alumni }} </td>
                    </tr>
                </table>
            </section>
            
                    <section id="content2">
                <table class="table table-borderless text-gray-900">
                    <tr>
                        <td width="200"> Nama Donator </td>
                        <td width="20"> : </td>
                        <td> {{ Auth::user()->donor->name }} </td>
                    </tr>
                    <tr>
                        <td> Tempat/Tanggal Lahir </td>
                        <td> : </td>
                        <td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            @if (!empty(Auth::user()->donor->place_of_birth) && !empty(Auth::user()->donor->date_of_birth))
                                {{ Auth::user()->donor->place_of_birth }}/{{ \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format(' Y') }}
                            @else
                                {{ Auth::user()->donor->place_of_birth ?: '-' }}/{{ Auth::user()->donor->date_of_birth ? \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_birth)->format(' Y') : '-' }}
                            @endif
                        </td>                                                                                        
                    </tr>                    
                    <tr>
                        <td> Jenis Kelamin </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->gender }} </td>
                    </tr>
                    <tr>
                        <td> Agama </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->religion }} </td>
                    </tr>
                    <tr>
                        <td> Alamat </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->address }} </td>
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->email }} </td>
                    </tr>
                    <tr>
                        <td> Nomor Handphone </td>
                        <td> : </td>
                        <td> {{ substr_replace(substr_replace(Auth::user()->donor->phone_number, '-', 4, 0), '-', 9, 0) }} </td>
                    </tr>
                </table>
            </section>
            <section id="content3">
                <table class="table table-borderless text-gray-900">
                    <tr>
                        <td width="200"> Kode Donator </td>
                        <td width="20"> : </td>
                        <td> {{ Auth::user()->donor->code_name }} </td>
                    </tr>
                    <tr>
                        <td> PIC </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->bph->nama }} </td>
                    </tr>
                    <tr>
                        <td> Tanggal Bergabung </td>
                        <td> : </td>
                        <?php
                        $bulanIndonesia = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        ?>
                        <td>{{ \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_joining)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_joining)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', Auth::user()->donor->date_of_joining)->format(' Y') }}</td>
                    </tr>
                    <tr>
                        <td> Struktur Donator </td>
                        <td> : </td>
                        <td>
                            @if (Auth::user()->donor->struktur_donator == 'Donator tetap')
                                <span class="badge badge-success">Donator Tetap</span>
                            @else
                                <span class="badge badge-danger">Donator Tidak Tetap</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td> Status </td>
                        <td> : </td>
                        <td> {{ Auth::user()->donor->description }} </td>
                    </tr>
                </table>
            </section>
        </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <a href="/edit_pd/{{ Auth::user()->donor->id }}" type="button" class="btn btn-warning"> Edit Data Diri </a>
            </div>
        </div>
    </div>
@endsection