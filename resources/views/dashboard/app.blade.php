<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <!-- Trix -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tab-panel.css') }}" rel="stylesheet">

    <!-- Custom datatables for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    <!-- Selectpicker -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style type="text/css">
        .inf-content{
            border:1px solid #DDDDDD;
            -webkit-border-radius:10px;
            -moz-border-radius:10px;
            border-radius:10px;
            box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
        }
        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }		     
        .table-center {
            margin-left: auto;
            margin-right: auto;
        }                                                 
    </style>
    <style>
        .active {
            border-right: solid 4px orange;
        }
    </style>
    
    <!-- Set the favicon for the website -->
    <link rel="shortcut icon" href="/img/Logo_IADC.ico" type="image/x-icon">

    <!-- Set the title of the page -->
    <title> IADC | @yield('title') </title>
    
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        
        <!-- Sidebar -->
        @include('dashboard.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar --> 
                    @include('dashboard.navbar')
                    <!-- End of Navbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                    @yield('contents')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Sidebar -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('dashboard.logout')

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Tab panel plugins -->
    <script src="{{ asset('js/tab-panel.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/fontawesome-free/all.min.js') }}"></script>
    
    <!-- Page level custom scripts datatables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- Trix TetxArea -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    
    <!-- Preview Image -->
    <script>
        function previewImageModalAdd() {
            const images = document.querySelector('#images');
            const imgPreview = document.querySelector('.img-preview');
    
            images.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
    
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                    };
    
                    reader.readAsDataURL(this.files[0]);
                } else {
                    imgPreview.src = '';
                }
            });
        }
        previewImageModalAdd();
    </script>        
    <script>
        function previewImage(index) {
            const images = document.querySelector(`#images${index}`);
            const imgPreview = document.querySelector(`#imgPreview${index}`);
    
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(images.files[0]);
    
            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    </script>  
    <!-- JavaScript code for image preview -->
    <script>
        function previewImage(index) {
            const images = document.querySelector(`#images${index}`);
            const imgPreview = document.querySelector(`#imgPreview${index}`);

            const file = images.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>  
    
    <!-- Chart plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>

    <!-- Selectpicker -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-group select').selectpicker();
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('shown.bs.modal', function() {
                $('.form-group select').selectpicker();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });
    </script>
    <script>
        var dateInput = document.getElementById("dateInput");
        var today = new Date();
        var formattedDate = today.toISOString().substr(0, 10);
        dateInput.value = formattedDate;
    </script>
    <script>
        const initialFormHTML = document.getElementById('filterForm').innerHTML;
        function resetForm() {
            document.getElementById('filterForm').innerHTML = initialFormHTML;
        }
    </script> 
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            table.on('draw', function() {
                calculateTotal(1, '#total1');
                calculateTotal(2, '#total2');
                calculateTotal(3, '#total3');
                calculateTotal(4, '#total4');
                calculateTotal(5, '#total5');
            });
    
            function calculateTotal(columnIndex, totalId) {
                var totalDonation = 0;
    
                table.column(columnIndex, { search: 'applied' }).data().each(function(value) {
                    var donation = parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
                    if (!isNaN(donation)) {
                        totalDonation += donation;
                    }
                });
    
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                var formattedDonation = formatter.format(totalDonation);
                $(totalId).text(formattedDonation);
            }
            calculateTotal(1, '#total1');
            calculateTotal(2, '#total2');
            calculateTotal(3, '#total3');
            calculateTotal(4, '#total4');
            calculateTotal(5, '#total5');
        });
    </script>   
    <script>
        $(document).ready(function() {
            $('#exportBtn').click(function() {
                var searchTerm = $('#dataTable_filter input').val();
                var exportUrl = $(this).data('export') + '?search=' + searchTerm;
                var anchor = document.createElement('a');

                anchor.href = exportUrl;
                anchor.style.display = 'none';
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
            });
        });
    </script>
</body>
</html>