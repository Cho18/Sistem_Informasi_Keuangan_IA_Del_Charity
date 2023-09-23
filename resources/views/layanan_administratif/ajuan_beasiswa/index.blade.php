@extends('dashboard.app')

@section('title', 'Ajuan Beasiswa')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('ajuan_beasiswa', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center">Daftar Ajuan Beasiswa Anda</h3>
            
            <div class="modal-footer clearfix">
                {{-- <div class="float-left">
                    @php
                        $sortedAjuanBeasiswa = $ajuan_beasiswa->sortByDesc('created_at');
                        $lastAjuanBeasiswa = $sortedAjuanBeasiswa->first();
                        $sixMonthsAgo = now()->subMonths(6);
                    @endphp
                    @if (!$lastAjuanBeasiswa || Carbon\Carbon::parse($lastAjuanBeasiswa->created_at)->diffInMonths($sixMonthsAgo) >= 6)
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('layanan_administratif.ajuan_beasiswa.add')
                    @else
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd" disabled>
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @endif
                </div>                 --}}
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('layanan_administratif.ajuan_beasiswa.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_ajuan_beasiswa">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Total_Bursar </th>
                            <th> Semester </th>
                            <th> Deskripsi </th>
                            <th> Status </th>
                            {{-- <th> Bukti </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ajuan_beasiswa as $ab)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> Rp. {{ number_format($ab->total_bursar,2,',','.') }} </td>
                            <td> {{ $ab->semester }} </td>
                            <td> {!! $ab->deskripsi !!} </td>
                            <td>
                                @if ($ab->status == 'Sudah diproses')
                                    <span class="badge badge-success"> Sudah Diproses </span>
                                @else
                                    <span class="badge badge-danger"> Belum Diproses </span>
                                @endif
                            </td>
                            {{-- <td>
                                @if ($ab->bukti)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $fileExtension = pathinfo($ab->bukti, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                        <a href="{{ asset('storage/'.$ab->bukti) }}" download="{{ basename($ab->bukti) }}">
                                            <img src="{{ asset('storage/' . $ab->bukti) }}" width="150px" height="150px">
                                        </a>
                                    @else
                                        No Image
                                    @endif
                                @else
                                    No Image
                                @endif
                            </td> --}}
                            {{-- @include('s') --}}
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th> Total </th>
                        <th id="total1"></th>
                        <th colspan="4"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection