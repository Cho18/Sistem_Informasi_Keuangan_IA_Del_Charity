@extends('dashboard.app')

@section('title', 'Daftar Anggota Donator')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_donator', 'active')

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
    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
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
    <div class="alert alert-warning alert-dismissible fade show col-md-6" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Begin Page Content -->
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Anggota Donator </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="add_donator" type="button" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_donator">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                    {{-- <a href="#" type="button" class="btn btn-info">
                        <i class="fas fa-file-import"></i> Import
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th><b> No </b></th>
                            <th><b> Kode Nama </b></th>
                            <th><b> Nama </b></th>
                            <th><b> PIC </b></th>
                            <th><b> Alumni </b></th>
                            <th><b> Tanggal Bergabung </b></th>
                            <th><b> Struktur Donator </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donator as $index => $dn)
                        <tr style="text-align:center;">
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $dn->code_name }} </td>
                            <td> {{ $dn->name }} </td>
                            <td> {{ $dn->nama }} </td>
                            <td> {{ $dn->alumni }} </td>
                            <?php
                                $bulanIndonesia = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $dn->date_of_joining)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $dn->date_of_joining)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $dn->date_of_joining)->format(' Y') }}</td>
                            <td>
                                @if ($dn->struktur_donator == 'Donator tetap')
                                <span class="badge badge-success"> Donator Tetap </span>
                                @else
                                <span class="badge badge-danger"> Donator Tidak Tetap </span>
                                @endif
                            </td>
                            <td>
                                <a type="button" href="/donator/{{ $dn->id }}/detail_pribadi" class="btn btn-info btn-sm mt-1">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                <a type="button" href="edit_donator/{{ $dn->id }}" class="btn btn-success btn-sm mt-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete{{ $index }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                                @include('daftar_anggota.donator.delete')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
