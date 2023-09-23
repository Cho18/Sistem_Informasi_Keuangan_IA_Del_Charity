@extends('dashboard.app')

@section('title', 'Daftar Dokumen Awardee')

@section('arsip_dokumen', 'active')
@section('dokumen', 'show')
@section('dokumen_awardee', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Dokumen Awardee</h3>
            <div class="modal-footer clearfix">
                @if (Auth::user()->role_id == 1)
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('arsip_dokumen.dokumen_awardee.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_dokumen_awardee">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead style="text-align:center;">
                        <tr>
                            <th> No </th>
                            <th> Judul Dokumen </th>
                            <th> Dokumen </th>
                            @if (Auth::user()->role_id == 1)
                            <th> Aksi </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $index =>$dok)
                        <tr>
                            <td style="text-align:center;"> {{ $loop->iteration }}</td>
                            <td> {{ $dok->name }} </td>
                            <td> 
                                @php
                                    $extension = pathinfo($dok->dokumen, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv']))
                                    <a href="{{ asset('storage/' . $dok->dokumen) }}" type="button" class="btn btn-success" download>
                                        <i class="fas fa-download"></i> Download 
                                    </a>
                                @endif
                            </td>
                            @if (Auth::user()->role_id == 1)
                            <td>
                                <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                                <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete{{ $index }}">
                                    <i class="fas fa-trash-alt"></i> Delete 
                                </a>
                                @include('arsip_dokumen.dokumen_awardee.delete')
                            </td>
                            @include('arsip_dokumen.dokumen_awardee.edit')
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection