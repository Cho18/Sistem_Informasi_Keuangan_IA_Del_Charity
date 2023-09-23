@extends('dashboard.app')

@section('title', 'Data Diri Saya')

@section('data_personal', 'active')
@section('data_diri', 'show')
@section('data_diri_bph', 'active')

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
        <!-- body modal --> 
        <div class="modal-body">
            <table class="table table-borderless text-gray-900">
                <tr></tr>
                    <td width="150"> Nama </td>
                    <td width="20"> : </td>
                    <td> {{ Auth::user()->bph->nama }} </td>
                </tr>
                <tr></tr>
                    <td> Angkatan </td>
                    <td> : </td>
                    <td> {{ Auth::user()->bph->angkatan }} </td>
                </tr>
                <tr></tr>
                    <td> Jabatan </td>
                    <td> : </td>
                    <td> {{ Auth::user()->bph->status }} </td>
                </tr>
                <tr></tr>
                    <td> Divisi </td>
                    <td> : </td>
                    <td> {{ Auth::user()->bph->divisi }} </td>
                </tr>
            </table>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
            <a href="/edit_bph2/{{ Auth::user()->bph->id }}" type="button" class="btn btn-warning"> Edit Data Diri </a>
        </div>
    </div>
@endsection