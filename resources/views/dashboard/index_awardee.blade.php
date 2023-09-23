@extends('dashboard.app')

@section('title', 'Dashboard')

@section('dashboard3', 'active')

@section('contents')
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Beasiswa yang Sudah Diberikan
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
                                Total Beasiswa yang Anda Ajukan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($tbeasiswa,2,',','.') }}
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
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Total Beasiswa </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="beasiswa"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Total Beasiswa yang Anda ajukan
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i>  Total Beasiswa yang sudah diberikan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Status Unggah Berkas </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="status_file"></canvas>
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
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Status Ajuan Beasiswa </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="status_ajuan"></canvas>
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
        var income = {!! $total !!};
        var expense = {!! $tbeasiswa !!};
        var ctx = document.getElementById("beasiswa").getContext("2d");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Total Beasiswa yang Anda ajukan', 'Total Beasiswa yang sudah diberikan'],
                datasets: [{
                    data: [income, expense],
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
        var sudah = {!! $sudah2 !!};
        var belum = {!! $belum2 !!};
        var ctx = document.getElementById("status_file");
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
    
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
    
        // Pie Chart Example
        var sudah = {!! $sudah !!};
        var belum = {!! $belum !!};
        var ctx = document.getElementById("status_ajuan");
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