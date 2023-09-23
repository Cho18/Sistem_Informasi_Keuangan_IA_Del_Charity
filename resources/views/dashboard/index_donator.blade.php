@extends('dashboard.app')

@section('title', 'Dashboard')

@section('dashboard2', 'active')

@section('contents')
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Awardee
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $awardee }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Expense
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($expense,2,',','.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Donasi Anda yang Sudah Diproses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($total,2,',','.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Donasi yang Sudah Anda Berikan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($tdonasi,2,',','.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Total Donasi Anda </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="donasi"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Total donasi Anda yang sudah diproses
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i>  Total donasi yang sudah Anda berikan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Status Bukti Donasi </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="ajuan"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sudah diproses 
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Belum diproses
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        
        // Pie Chart Example
        var income = {!! $tdonasi !!};
        var income2 = {!! $total !!};
        var ctx = document.getElementById("donasi").getContext("2d");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Total donasi Anda yang sudah diproses', ' Total donasi yang sudah Anda berikan'],
                datasets: [{
                    data: [income2, income],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var value = dataset.data[tooltipItem.index];
                            var label = data.labels[tooltipItem.index];
                            return label + ': Rp. ' + numberFormat(value, 2, ',', '.');
                        }
                    }
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 60,
            },
        });
        function numberFormat(number, decimals, decimalSeparator, thousandSeparator) {
            decimals = decimals || 0;
            number = parseFloat(number);

            if (!isFinite(number) || (!number && number !== 0)) {
                return '';
            }

            var parts = number.toFixed(decimals).split('.');
            var integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator);
            var decimalPart = parts[1] ? decimalSeparator + parts[1] : '';

            return integerPart + decimalPart;
        }
    </script>
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        
        // Pie Chart Example
        var sudah = {!! $sudah !!};
        var belum = {!! $belum !!};
        var ctx = document.getElementById("ajuan").getContext("2d");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sudah diproses', 'Belum diproses'],
                datasets: [{
                    data: [sudah, belum],
                    backgroundColor: ['#1cc88a', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#c0392b'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 60,
            },
        });
    </script>
@endsection