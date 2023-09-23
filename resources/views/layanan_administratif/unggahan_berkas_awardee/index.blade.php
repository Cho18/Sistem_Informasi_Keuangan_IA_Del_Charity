@extends('dashboard.app')

@section('title', 'Unggahan Berkas Awardee')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('unggahan_berkas', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Unggahan Berkas Awardee </h3>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_daftar_file_beasiswa">
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
                            <th> Nama Awardee </th>
                            <th> Judul Dokumen </th>
                            <th> Dokumen </th>
                            <th> Tanggal Upload </th>
                            <th> Status </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($file_beasiswa as $index => $fb)
                        <tr>
                            <td style="text-align:center;"> {{ $loop->iteration }} </td>
                            <td> {{ $fb->name_awarde }} </td>
                            <td> {{ $fb->dokumen_name }} </td>
                            <td>
                                @php
                                    $extension = pathinfo($fb->file_beasiswa, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv']))
                                    <a href="{{ asset('storage/' . $fb->file_beasiswa) }}" type="button" class="btn btn-success" download>
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
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $fb->tanggal_upload)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $fb->tanggal_upload)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $fb->tanggal_upload)->format(' Y') }}</td>
                            <td>
                                @if ($fb->status == 'Sudah diproses')
                                    <span class="badge badge-success"> Sudah Diproses </span>
                                @else
                                    <span class="badge badge-danger"> Belum Diproses </span>
                                @endif
                            </td>
                            <td> 
                                {{-- <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                                @include('daftar.sk.edit', ['aj' => $fb]) --}}
                                <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                            </td>
                            @include('layanan_administratif.unggahan_berkas_awardee.edit')
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection