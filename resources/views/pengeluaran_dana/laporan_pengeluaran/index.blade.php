@extends('dashboard.app2')

@section('title', 'Laporan Pengeluaran')

@section('pengeluaran_dana', 'active')
@section('pengeluaran', 'show')
@section('laporan_pengeluaran', 'active')

@section('contents')
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary text-center"> Filter Laporan Pengeluaran </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/filter_pengeluaran" method="get">
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
                                    <label for="name" class="col-form-label text-gray-900"><strong> Jenis Pengeluaran </strong></label>
                                    <div class="col-md-12">
                                        <select id="jenis_pengeluaran_id" class="form-control text-gray-900" name="jenis_pengeluaran_id" data-live-search="true">
                                            <option disabled selected>Pilih Jenis Pengeluaran</option>
                                            <option value="">All</option>
                                            @foreach($jenis_pengeluaran as $jp)
                                                <option value="{{ $jp->id }}">{{ $jp->name_of_type_expenditure }}</option>
                                            @endforeach
                                        </select>
                                    </div>                  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
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
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;" id="dataTable">
                    <thead>
                        <tr style="text-align:center;">
                            <th><b> No </b></th>
                            <th><b> Jenis Pengeluaran </b></th>
                            @if (Auth::user()->role_id != 4)
                            <th><b> Nama Penerima Beasiswa </b></th>
                            @endif
                            <th><b> Deskripsi Pengeluaran </b></th>
                            <th><b> Tanggal Pengeluaran </b></th>
                            <th><b> Total Pengeluaran </b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $pl)
                        <tr style="text-align:center;">
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $pl->jenis_pengeluaran->name_of_type_expenditure }} </td>
                            @if (Auth::user()->role_id != 4)    
                            <td> 
                                @if ($pl->penerima_beasiswa)
                                    {{ $pl->penerima_beasiswa->name_awarde }}
                                @else
                                    -
                                @endif 
                            </td>
                            @endif
                            <td> {!! $pl->expenditure_description !!} </td>
                            <?php
                                $bulanIndonesia = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format(' Y') }}</td>
                            <td> Rp {{ number_format($pl['total_expenditure'],2,',','.') }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if (Auth::user()->role_id != 4)
                    <tfoot style="text-align:center;">
                        <th colspan="5"> Total Pengeluaran </th>
                        <th id="total5"></th>
                    </tfoot>
                    @else
                    <tfoot style="text-align:center;">
                        <th colspan="4"> Total Pengeluaran </th>
                        <th id="total4"></th>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection