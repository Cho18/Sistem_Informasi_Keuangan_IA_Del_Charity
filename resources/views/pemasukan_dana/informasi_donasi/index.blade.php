@extends('dashboard.app2')

@section('title', 'Informasi Pemasukan Donasi' . (isset($year) ? ' Tahun ' . $year : ''))

@section('pemasukan_dana', 'active')
@section('pemasukan', 'show')
@section('informasi_donasi', 'active')

@section('contents')
    @php
        $year = request()->input('year');
    @endphp
    @php
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];
    @endphp
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            @if (isset($year) && isset($month))
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Pemasukan Donasi - {{ $months[$month] }}  {{ $year }}</h3>
            @elseif (isset($month))
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Pemasukan Donasi - {{ $months[$month] }}</h3>
            @elseif (isset($year))
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Pemasukan Donasi - {{ $year }}</h3>
            @else
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Pemasukan Donasi </h3>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/filter_informasi_donasi" method="get" id="filterForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- ... -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="month" class="col-form-label text-gray-900"><strong>Bulan</strong></label>
                                    <div class="container">
                                        <select class="form-control text-gray-900" name="month" data-live-search="true">
                                            <option disabled selected>Pilih Bulan</option>
                                            <option value="">Semua Bulan</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                                                 
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="year" class="col-form-label text-gray-900"><strong>Tahun</strong></label>
                                    <div class="container">
                                        <select class="form-control text-gray-900" name="year" data-live-search="true">
                                            <option disabled selected>Pilih Tahun</option>
                                            <option value="">Semua Tahun</option>
                                            @php
                                                $currentYear = date('Y');
                                                $oldestYear = 2000;
                                            @endphp
                                            @for ($year = $currentYear; $year >= $oldestYear; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="container">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
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
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Nama Donator </th>
                            <th> Jumlah Donasi Donator </th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @foreach ($results as $ex)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ex->name }}</td>
                                <td>Rp {{ number_format($ex->total_donation_amount, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>  
                    <tfoot >
                        <th colspan="2"> Total Donasi Donator </th>
                        <th id="total2"></th>
                    </tfoot>   
                </table>
            </div>
        </div>
    </div>
@endsection