@extends('dashboard.app')

@section('title', 'Daftar Bukti Donasi Donator')

@section('layanan_administratif', 'active')
@section('layanan', 'show')
@section('daftar_bukti_donasi', 'active')

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
            <h3 class="m-0 font-weight-bold text-primary text-center">Daftar Bukti Donasi Donator</h3>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_daftar_bukti_donasi">
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
                            <th>No</th>
                            <th>Nama Donator</th>
                            <th>Jumlah Donasi</th>
                            <th>Tanggal Donasi</th>
                            <th>Tipe Akun</th>
                            <th>Bukti Transaksi</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi as $index => $d)
                        <tr>
                            <td style="text-align:center;">{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>Rp {{ number_format($d->donation_amount,2,',','.') }}</td>
                            <?php
                                $bulanIndonesia = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $d->donation_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $d->donation_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $d->donation_date)->format(' Y') }}</td>
                            <td>{{ $d->type_account }}</td>
                            <td>
                                @if ($d->bukti_transaksi)
                                @php
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Ekstensi file gambar yang diizinkan
                                $fileExtension = pathinfo($d->bukti_transaksi, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array(strtolower($fileExtension), $imageExtensions))
                                <a href="{{ asset('storage/'.$d->bukti_transaksi) }}" download="{{ basename($d->bukti_transaksi) }}">
                                    <img src="{{ asset('/storage/' . $d->bukti_transaksi) }}" width="150px%" height="150px" alt="">
                                </a>
                                @else
                                    -
                                @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>{!! $d->description !!}</td>
                            <td>
                                @if ($d->status == 'Sudah diproses')
                                <span class="badge badge-success">Sudah Diproses</span>
                                @else
                                <span class="badge badge-danger">Belum Diproses</span>
                                @endif
                            </td>
                            <td>
                                <a type="button" href="#" class="btn btn-success btn-sm mt-1" data-toggle="modal" data-target="#ModalEdit{{ $index }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                            @include('layanan_administratif.daftar_bukti_donasi.edit')
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="text-align:center;">
                        <th colspan="2">Total Donasi</th>
                        <th id="total2"></th>
                        <th colspan="4"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
