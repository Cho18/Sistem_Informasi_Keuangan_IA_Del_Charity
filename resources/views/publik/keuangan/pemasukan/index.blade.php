@extends('publik.app')

@section('title', 'Pemasukan Keuangan')

@section('contents')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Arus Keuangan IA Del Charity</h6>
                <h2 class="mt-2">Pemasukan Keuangan</h2>
            </div>
        </div>
        <div class="card shadow mb-4 mt-2 wow fadeInUp">
            <div class="card-body wow fadeInUp">
                <div class="table-responsive">
                    <form action="/filter_pemasukan_keuangan" method="get">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="code_name" class="col-form-label text-gray-900"><strong> Tanggal Awal </strong></label>
                                        <div class="container">
                                            <input type="date" class="form-control text-gray-900" name="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-gray-900"><strong> Tanggal Akhir </strong></label>
                                        <div class="container">
                                            <input type="date" class="form-control text-gray-900" name="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="container">
                                            <button type="submit" class="btn btn-primary" style="margin-top: 35px;"> Filter </button>
                                            <button type="submit" class="btn btn-danger" style="margin-top: 35px;" onclick="resetForm()"> Reset </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body wow zoomIn">
                <div class="table-responsive">
                    <table class="table table-hover text-gray-900"  style="text-align:center;" id="dataTable">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection