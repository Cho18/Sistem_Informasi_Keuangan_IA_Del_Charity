@extends('dashboard.app')

@section('title', 'Catatan Donasi')

@section('catatan_kontribusi', 'active')
@section('catatan', 'show')
@section('catatan_donasi', 'active')

@section('contents')
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Catatan Donasi Anda </h3>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_catatan_donasi">
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
                            <th><b> No </b></th>
                            <th><b> Jumlah Donasi </b></th>
                            <th><b> Tanggal Donasi </b></th>
                            <th><b> Tipe Akun </b></th>
                            <th><b> Deskripsi </b></th>
                            <th><b> Bukti Transaksi </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donorDonations as $dd)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> Rp {{ number_format($dd->donation_amount,2,',','.') }} </td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format(' Y') }}</td>
                            <td> {{ $dd->type_account }} </td>
                            <td> {!! $dd->description !!} </td>
                            <td>
                                @if ($dd->bukti_transaksi)
                                    <a href="{{ asset('storage/'.$dd->bukti_transaksi) }}" download="{{ basename($dd->bukti_transaksi) }}">
                                    <img src="{{ asset('/storage/'.$dd->bukti_transaksi) }}" width="150px" height="150px" alt="">                                
                                @else
                                    No Image
                                @endif                                      
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th> Total Donasi </th>
                        <th id="total1"></th>
                        <th colspan="4">  </th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection