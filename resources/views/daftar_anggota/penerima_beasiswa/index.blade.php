@extends('dashboard.app')

@section('title', 'Daftar Anggota Awardee')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_awardee', 'active')

@section('contents')

    @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show col-md-6" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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

    <!-- Begin Page Content -->
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Anggota Awardee </h3>
            <div class="modal-footer clearfix">
                @if (Auth::user()->role_id != 3)
                <div class="float-left">
                    <a href="add_awarde" type="button" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                @endif
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_penerima_beasiswa">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                    {{-- @if (Auth::user()->role_id != 3)
                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalImport">
                        <i class="fas fa-file-import"></i> Import
                    </a>
                    @include('daftar_anggota.penerima_beasiswa.import')
                    @endif --}}
                </div>
            </div>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable" >
                    <thead>
                        <tr style="text-align:center;">
                            <th><b> No </b></th>
                            <th><b> Nama </b></th>
                            <th><b> NIM </b></th>
                            <th><b> Prodi </b></th>
                            <th><b> Fakultas </b></th>
                            <th><b> Angkatan </b></th>
                            <th><b> Tanggal Diberikan Beasiswa </b></th>
                            <th><b> Status Beasiswa </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima_beasiswa as $pb)
                        <tr style="text-align:center;">
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $pb->name_awarde }} </td>
                            <td> {{ $pb->nim_awarde }} </td>
                            <td> {{ $pb->study_program }} </td>
                            <td> {{ $pb->faculty }} </td>
                            <td> {{ $pb->generation }} </td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $pb->date_set_as_awardee)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $pb->date_set_as_awardee)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $pb->date_set_as_awardee)->format(' Y') }}</td>
                            {{-- <td> {{ $pb->status }}</td>   --}}
                            <td>
                                @if ($pb->status == 'Masih aktif')
                                <span class="badge badge-success">Masih Aktif</span>
                                @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>                           
                            <td>
                                <a type="button" href="/penerima_beasiswa/{{ $pb->id }}/detail_pribadi" class="btn btn-info btn-sm mt-1">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                @if (Auth::user()->role_id != 3)
                                <a type="button" href="edit_pb/{{ $pb->id }}" class="btn btn-success btn-sm mt-1">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                                <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete">
                                    <i class="fas fa-trash-alt"></i> Delete 
                                </a>
                                @include('daftar_anggota.penerima_beasiswa.delete')
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
