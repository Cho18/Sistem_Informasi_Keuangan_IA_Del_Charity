@extends('dashboard.app')

@section('title', 'Donasi Donator')

@section('pemasukan_dana', 'active')
@section('pemasukan', 'show')
@section('daftar_pemasukan', 'active')

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
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center">Daftar Pemasukan Dana</h3>
            {{-- <div class="modal-footer" data-toggle="modal" data-target="#ModalAdd">
                <a href="#" type="button" class="btn btn-primary">
                    <i class="fas fa-ddus"></i> Add Donasi Donator
                </a>
            </div> --}}
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('pemasukan_dana.daftar_pemasukan.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_pemasukan">
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
                            <th><b> Jenis Pemasukan </b></th>
                            <th><b> Nama Donator </b></th>
                            <th><b> Jumlah Pemasukan </b></th>
                            <th><b> Tanggal Pemasukan </b></th>
                            <th><b> Tipe Akun </b></th>
                            <th><b> Deskripsi </b></th>
                            <th><b> Bukti Transaksi </b></th>
                            <th><b> Aksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemasukan as $index => $dd)
                            <tr>
                                <td style="text-align:center;">  {{ $loop->iteration }} </td>
                                <td> {{ $dd->jenis_pemasukan->name_of_type_income }} </td>
                                <td> 
                                    @if ($dd->donor)
                                        {{ $dd->donor->name }}
                                    @else
                                        -
                                    @endif 
                                </td>
                                <td>  Rp {{ number_format($dd->donation_amount,2,',','.') }} </td>
                                <?php
                                $bulanIndonesia = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                ?>
                                <td>{{ \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format(' Y') }}</td>
                                <td>  {{ $dd->type_account }} </td>
                                <td>  {!! $dd->description !!} </td>
                                <td>
                                    @if ($dd->bukti_transaksi)
                                        @php
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                            $fileExtension = pathinfo($dd->bukti_transaksi, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (in_array(strtolower($fileExtension), $imageExtensions))
                                            <a href="{{ asset('storage/'.$dd->bukti_transaksi) }}" download="{{ $dd->donor_id . '_' . basename($dd->bukti_transaksi) }}">
                                                <img src="{{ asset('storage/'.$dd->bukti_transaksi) }}" width="150px" height="150px">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>                                                           
                                <td>
                                    <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                        <i class="fas fa-edit"></i> Edit 
                                    </a>
                                    <a type="button" href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#ModalDelete{{ $index }}">
                                        <i class="fas fa-trash-alt"></i> Delete 
                                    </a>
                                    @include('pemasukan_dana.daftar_pemasukan.delete')
                                </td>
                                @include('pemasukan_dana.daftar_pemasukan.edit')
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="text-align:center;">
                        <th colspan="3"> Total Pemasukan </th>
                        <th id="total3"></th>
                        <th colspan="5">  </th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection