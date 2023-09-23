@extends('dashboard.app')

@section('title', 'Catatan Beasiswa')

@section('catatan_kontribusi', 'active')
@section('catatan', 'show')
@section('catatan_donasi', 'active')

@section('contents')
    <!-- Begin Page Content -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center"> Daftar Catatan Beasiswa Saya </h3>
            <div class="modal-footer clearfix">
                <div class="float-right">
                    <a href="#" type="button" class="btn btn-success me-md-2" id="exportBtn" data-export="/export_catatan_beasiswa">
                        <i class="fas fa-file-export"></i> Export
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-secondary text-gray-900" style="text-align:center;"x id="dataTable">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Jumlah Donasi </th>
                            <th> Tanggal Donasi </th>
                            <th> Deskripsi </th>
                            <th> Bukti Donasi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logawardee as $la)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> Rp {{ number_format($la->total_expenditure,2,',','.') }} </td>
                            <?php
                            $bulanIndonesia = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            ?>
                            <td>{{ \DateTime::createFromFormat('Y-m-d', $la->expenditure_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $la->expenditure_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $la->expenditure_date)->format(' Y') }}</td>
                            <td> {!! $la->expenditure_description !!} </td>
                            <td>
                                @if ($la->proof_of_expenditure)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $fileExtension = pathinfo($la->proof_of_expenditure, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                        <a href="{{ asset('storage/'.$la->proof_of_expenditure) }}" download="{{ basename($la->proof_of_expenditure) }}">
                                            <img src="{{ asset('storage/'.$la->proof_of_expenditure) }}" width="150px" height="150px">
                                        </a>
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th> Total </th>
                        <th id="total1"></th>
                        <th colspan="3"></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection