@extends('dashboard.app')

@section('title', 'Data Diri Donator')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_bph', 'active')

@section('contents')
        <!-- konten modal-->
        <div class="modal-content ">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #f3c11d;"><strong> Data Diri BPH </strong></h4>
            </div>
                <!-- body modal --> 
                <div class="modal-body">
                        <table class="table table-borderless text-gray-900">
                            <tr></tr>
                                <td width="200"> Nama BPH </td>
                                <td width="20"> : </td>
                                <td> {{ $bph->name}} </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td> Tempat/Tanggal Lahir </td>
                                <td> : </td>
                                <td>
                                    @if ($bph->date_of_birth)
                                        {{ $bph->place_of_birth }}/{{ \DateTime::createFromFormat('Y-m-d', $bph->date_of_birth)->format('j F Y') }}
                                    @else
                                    @endif
                                </td>
                            </tr>                            
                            <tr>
                                <td> Jenis Kelamin </td>
                                <td> : </td>
                                <td> {{ $bph->gender }} </td>
                            </tr>
                            <tr>
                                <td> Agama </td>
                                <td> : </td>
                                <td> {{ $bph->religion }} </td>
                            </tr>
                            <tr>
                                <td> Alamat </td>
                                <td> : </td>
                                <td> {{ $bph->address }} </td>
                            </tr>
                            <tr>
                                <td> Nomor Handphone </td>
                                <td> : </td>
                                <td>{{ substr_replace(substr_replace($bph->phone_number, '-', 4, 0), '-', 9, 0) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <a href='/bph' type="button" class="btn btn-warning"> Back </a>
                </div>
            </div>
        </div>
    </div>
@endsection