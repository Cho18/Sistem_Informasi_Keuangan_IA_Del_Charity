@extends('dashboard.app')

@section('title', 'Unggah Berkas Awardee')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('unggah_berkas', 'active')

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

    <!-- konten modal-->
    {{-- <div class="modal-content mb-3">
        <!-- body modal --> 
        <div class="modal-body">
            <div class="mb-2 row">
                <h2 class="card-title text-gray-900"> File Beasiswa </h2>
                @foreach ($dokumen as $index =>$dok)
                <div class="col-md-12 mt-2">
                    <a href="{{ asset('storage/' . $dok->dokumen) }}" target="_blank" class="card-link">{{ $loop->iteration }}. {{ $dok->name }}</a>
                </div>
                @endforeach
            </div>                
        </div>        
    </div> --}}
    <!-- Begin Page Content -->
    <div class="card mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Unggah Berkas Awardee </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Send
                    </a>
                    @include('layanan_administratif.unggah_berkas.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_file_beasiswa">
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
                            <th> Judul Dokumen </th>
                            <th> Dokumen </th>
                            <th> Tanggal Upload </th>
                            <th> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logfile_beasiswa as $la)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $la->name }} </td>
                            {{-- <td> {{ $aj->penerima_beasiswa->name_awarde }} </td> --}}
                            <td> 
                                @php
                                    $extension = pathinfo($la->file_beasiswa, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv']))
                                    <a href="{{ asset('storage/' . $la->file_beasiswa) }}" type="button" class="btn btn-success" download>
                                        <i class="fas fa-download"></i> Download 
                                    </a>
                                @endif
                            </td>   
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $la->tanggal_upload)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $la->tanggal_upload)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $la->tanggal_upload)->format(' Y') }}</td>
                            <td>
                                @if ($la->status == 'Sudah diproses')
                                    <span class="badge badge-success"> Sudah Diproses </span>
                                @else
                                    <span class="badge badge-danger"> Belum Diproses </span>
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