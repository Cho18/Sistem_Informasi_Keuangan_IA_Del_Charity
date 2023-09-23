@extends('dashboard.app')

@section('title', 'Daftar Pengeluaran')

@section('pengeluaran_dana', 'active')
@section('pengeluaran', 'show')
@section('daftar_pengeluaran', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Pengeluaran </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('pengeluaran_dana.daftar_pengeluaran.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_pengeluaran">
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
                <table class="table table-bordered table-hover border-secondary text-gray-900" id="dataTable">
                    <thead style="text-align:center;">
                        <tr>
                            <th><b> No </b></th>
                            <th><b> Jenis Pengeluaran </b></th>
                            <th><b> Nama Penerima Beasiswa </b></th>
                            <th><b> Jumlah Pengeluaran </b></th>
                            <th><b> Tanggal Pengeluaran </b></th>
                            <th><b> Bukti Pengeluaran </b></th>
                            <th><b> Deskripsi </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $index => $pl)
                        <tr>
                            <td style="text-align:center;"> {{ $loop->iteration }} </td>
                            <td> {{ $pl->jenis_pengeluaran->name_of_type_expenditure }} </td>
                            <td> 
                                @if ($pl->penerima_beasiswa)
                                    {{ $pl->penerima_beasiswa->name_awarde }}
                                @else
                                    -
                                @endif 
                            </td>
                            <td> Rp {{ number_format($pl['total_expenditure'],2,',','.') }} </td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format(' Y') }}</td>
                            <td>
                                @if ($pl->proof_of_expenditure)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $fileExtension = pathinfo($pl->proof_of_expenditure, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                        <a href="{{ asset('storage/'.$pl->proof_of_expenditure) }}" download="{{ basename($pl->proof_of_expenditure) }}">
                                            <img src="{{ asset('storage/'.$pl->proof_of_expenditure) }}" width="150px" height="150px">
                                        </a>
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td> {!! $pl->expenditure_description !!} </td>
                            <td>
                                <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                    <i class="fas fa-edit"></i> Edit 
                                </a>
                                <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete{{ $index }}">
                                    <i class="fas fa-trash-alt"></i> Delete 
                                </a>
                                @include('pengeluaran_dana.daftar_pengeluaran.delete')
                            </td>
                            @include('pengeluaran_dana.daftar_pengeluaran.edit')
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="text-align:center;">
                        <th colspan="3"> Total Pengeluaran </th>
                        <th id="total3"></th>
                        <th colspan="4">  </th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection