@extends('dashboard.app2')

@section('title', 'Rekapitulasi Pemasukan')

@section('pemasukan_dana', 'active')
@section('pemasukan', 'show')
@section('rekapitulasi_pemasukan', 'active')

@section('contents')
    <!-- Begin Page Content -->
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center">Rekapitulasi Pemasukan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Jenis Pemasukan</th>
                            <th>Jumlah Pemasukan</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result->year }}</td>
                            <td>{{ $result->name_of_type_income }}</td>
                            <td>Rp {{ number_format($result->donation_amount, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                    <tfoot>
                        <th colspan="3"> Total Pemasukan </th>
                        <th id="total3"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
