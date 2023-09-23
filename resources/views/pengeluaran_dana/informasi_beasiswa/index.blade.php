@extends('dashboard.app2')

@section('title', 'Informasi Beasiswa Awardee')

@section('pengeluaran_dana', 'active')
@section('pengeluaran', 'show')
@section('informasi_beasiswa', 'active')

@section('contents')
    @php
        $year = request()->input('year');
    @endphp
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            @if (isset($year))
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Beasiswa Awardee - {{ $year }}</h3>
            @else
                <h3 class="m-0 font-weight-bold text-primary text-center">Informasi Beasiswa Awardee</h3>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/filter_informasi_beasiswa" method="get" id="filterForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">                                               
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
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="container">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 35px;"> Filter </button>
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
                            <th>No</th>
                            <th>Nama Awardee</th>
                            <th>Jumlah Pengeluaran</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @php
                            $awardees = []; 
                        @endphp
                        @foreach ($results as $result)
                        @php
                            $awardeeId = $result->penerima_beasiswa_id;
                            if (!isset($awardees[$awardeeId])) {
                                $awardees[$awardeeId] = [
                                    'name' => $result->name_awarde,
                                    'total_expenditure' => 0,
                                ];
                            }
                            $awardees[$awardeeId]['total_expenditure'] += $result->total_expenditure;
                        @endphp
                        @endforeach
                        @foreach ($awardees as $awardeeId => $awardee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $awardee['name'] }}</td>
                            <td>Rp {{ number_format($awardee['total_expenditure'], 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                    <tfoot>
                        <th colspan="2"> Total Pengeluaran </th>
                        <th id="total2"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
