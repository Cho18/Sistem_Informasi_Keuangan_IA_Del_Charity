@extends('dashboard.app')

@section('title', 'Jenis Pengeluaran')

@section('pengeluaran_dana', 'active')
@section('pengeluaran', 'show')
@section('jenis_pengeluaran', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Jenis Pengeluaran </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('pengeluaran_dana.jenis_pengeluaran.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_jenis_pengeluaran">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
            </div>
        </div>           

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead>
                        <tr style="text-align:center;">
                            <th><b> No </b></th>
                            <th><b> Jenis Pengeluaran </b></th>
                            <th><b> Deskripsi Jenis Pengeluaran </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis_pengeluaran as $index => $jp)
                            <tr>
                                <td style="text-align:center;">  {{ $loop->iteration }} </td>
                                <td>  {{ $jp->name_of_type_expenditure }} </td>
                                <td align="justify">  {!! $jp->description_of_type_expenditure !!} </td>
                                <td>
                                    <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete{{ $index }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                    @include('pengeluaran_dana.jenis_pengeluaran.delete')
                                </td>
                            </tr>
                            @include('pengeluaran_dana.jenis_pengeluaran.edit')
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
