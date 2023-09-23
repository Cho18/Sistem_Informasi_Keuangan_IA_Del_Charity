@extends('dashboard.app')

@section('title', 'Daftar Peran Awardee')

@section('pengguna_dan_peran', 'active')
@section('pengguna', 'show')
@section('daftar_peran_awardee', 'active')

@section('contents')

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Begin Page Content -->
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Peran Awardee </h3>        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead>
                        <tr style="text-align:center;">
                            <th><b> No </b></th>
                            <th><b> Foto Profile </b></th>
                            <th><b> Username </b></th>
                            <th><b> Email </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awardee as $a)
                        <tr style="text-align:center;">
                            <td>  {{ $loop->iteration }} </td>
                            <td>
                                @if ($a->profile)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $fileExtension = pathinfo($a->profile, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                        <a href="{{ asset('storage/'.$a->profile) }}" download="{{ basename($a->profile) }}">
                                            <img src="{{ asset('storage/'.$a->profile) }}" width="100px" height="100px" class="rounded-circle">
                                        </a>
                                    @else
                                        No Image
                                    @endif
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>  {{ $a->name }} </td>
                            <td>  {{ $a->email }} </td>
                            <td>
                                {{-- <a type="button" href="edit_jp/{{ $bph->id }}" class="btn btn-success btn-sm mt-1">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>  --}}
                                <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete">
                                    <i class="fas fa-trash-alt"></i> Delete 
                                </a>
                                @include('pengguna_dan_peran.user_awardee.delete')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection