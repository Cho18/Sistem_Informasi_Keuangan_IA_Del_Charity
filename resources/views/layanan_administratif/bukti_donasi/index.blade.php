@extends('dashboard.app')

@section('title', 'Unggah Berkas Awardee')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('bukti_donasi', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center"> Unggah Berkas Awardee </h3>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="#" type="button" class="btn btn-primary me-md-2" style="margin-top: 15px;" data-toggle="modal" data-target="#ModalAdd">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    @include('layanan_administratif.bukti_donasi.add')
                </div>
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_ajuan_bukti_donasi">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900"  style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Jumlah Donasi </th>
                            <th> Tanggal Donasi </th>
                            <th> Tipe Akun </th>
                            <th> Deskripsi </th>
                            <th> Bukti Transaksi </th>
                            <th> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi as $d)
                        <tr>
                            <td>  {{ $loop->iteration }} </td>
                            <td>  Rp {{ number_format($d->donation_amount,2,',','.') }} </td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $d->donation_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $d->donation_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $d->donation_date)->format(' Y') }}</td>
                            <td>  {{ $d->type_account }} </td>
                            <td>  {!! $d->description !!} </td>
                            <td>
                                @if ($d->bukti_transaksi)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $fileExtension = pathinfo($d->bukti_transaksi, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                        <a href="{{ asset('storage/'.$d->bukti_transaksi) }}" download="{{ basename($d->bukti_transaksi) }}">
                                            <img src="{{ asset('storage/'.$d->bukti_transaksi) }}" width="150px%" height="150px">
                                        </a>
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($d->status == 'Sudah diproses')
                                    <span class="badge badge-success"> Sudah Diproses </span>
                                @else
                                    <span class="badge badge-danger"> Belum Diproses </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th> Total </th>
                        <th id="total1"></th>
                        <th colspan="5"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection