@extends('dashboard.app')

@section('title', 'Daftar Anggota BPH')

@section('daftar_anggota', 'active')
@section('anggota', 'show')
@section('anggota_bph', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Anggota BPH </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('daftar_anggota.bph.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_bph">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                    <a href="#" type="button" class="btn btn-info">
                        <i class="fas fa-file-import"></i> Import
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead style="text-align:center;">
                        <tr style="text-align:center;">
                            <th><b> No </b></th>
                            <th><b> Nama </b></th>
                            <th><b> Angkatan </b></th>
                            <th><b> Jabatan </b></th>
                            <th><b> Divisi </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bph as $index => $b)
                            <tr>
                                <td style="text-align:center;"> {{ $loop->iteration }} </td>
                                <td> {{ $b->nama }} </td>
                                <td> {{ $b->angkatan }} </td>
                                <td> {{ $b->status }} </td>
                                <td> {{ $b->divisi }} </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- <a type="button" href="/show_bph/{{ $b->id }}" class="btn btn-info btn-sm mt-1 ml-1">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a> --}}
                                        <a type="button" href="#" class="btn btn-success btn-sm mt-1 ml-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        @include('daftar_anggota.bph.edit')
                                        <a type="button" href="#" class="btn btn-danger btn-sm mt-1 ml-1" data-toggle="modal" data-target="#ModalDelete">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                        @include('daftar_anggota.bph.delete')
                                    </div>
                                </td>                                                       
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection