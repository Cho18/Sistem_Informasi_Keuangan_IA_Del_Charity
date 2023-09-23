@extends('dashboard.app')

@section('title', 'Daftar Ajuan Beasiswa Awardee')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('daftar_ajuan_beasiswa', 'active')

@section('contents')

    @if (session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Begin Page Content -->
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Ajuan Beasiswa Awardee</h3>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_daftar_ajuan_beasiswa">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead style="text-align:center;">
                        <tr>
                            <th> No </th>
                            <th> Nama Mahasiswa </th>
                            <th> Total Bursar </th>
                            <th> Semester </th>
                            <th> Deskripsi </th>
                            <th> Status </th>
                            {{-- <th> Bukti </th> --}}
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ajuan_beasiswa as $index => $ab)
                        <tr>
                            <td style="text-align:center;"> {{ $loop->iteration }} </td>
                            <td> {{ $ab->name_awarde }} </td>
                            <td> Rp {{ number_format($ab->total_bursar,2,',','.') }} </td>
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
                            <td>
                                <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                            </td>
                            @include('layanan_administratif.daftar_ajuan_beasiswa.edit')
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th colspan="2"> Total Ajuan Beasiswa </th>
                        <th id="total2"></th>
                        <th colspan="5">  </th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection