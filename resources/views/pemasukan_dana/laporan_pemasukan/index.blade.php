@extends('dashboard.app2')

@section('title', 'Laporan Pemasukan Dana')

@section('pemasukan_dana', 'active')
@section('pemasukan', 'show')
@section('laporan_pemasukan', 'active')

@section('contents')
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center">Laporan Pemasukan Dana</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/filter_pemasukan" method="get">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="code_name" class="col-form-label text-gray-900"><strong> Tanggal Awal </strong></label>
                                    <div class="container">
                                        <input type="date" class="form-control text-gray-900" name="start_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-gray-900"><strong> Tanggal Akhir </strong></label>
                                    <div class="container">
                                        <input type="date" class="form-control text-gray-900" name="end_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="container">
                                        <button type="submit" class="btn btn-primary"> Filter </button>
                                        <button type="submit" class="btn btn-danger" onclick="resetForm()"> Reset </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900"  style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th><b> No </b></th>
                            <th><b> Tanggal Pemasukan </b></th>
                            <th><b> Jumlah Pemasukan </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemasukan as $dd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <?php
                                $bulanIndonesia = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                ?>
                                <td>{{ \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $dd->donation_date)->format(' Y') }}</td>
                                <td>Rp {{ number_format($dd->total_donation, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>     
                    <tfoot style="text-align:center;">
                        <th colspan="2"> Total Pemasukan </th>
                        <th id="total2"></th>
                    </tfoot>                                  
                </table>
            </div>
        </div>
    </div>
@endsection
