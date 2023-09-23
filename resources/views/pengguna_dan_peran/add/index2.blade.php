@section('title', 'Add User')

@section('ua', 'active')
@section('u', 'show')
@section('add', 'active')

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tab-panel.css') }}" rel="stylesheet">

    <!-- Custom datatables for this page a-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

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
    
    <link rel="shortcut icon" href="/img/Logo_IADC.ico" type="image/x-icon">
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
                        @if (session()->has('success'))
                            <div class="alert alert-primary col-md-6" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger col-md-6" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger col-md-6">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-group" action="" method="post" enctype="multipart/form-data">
                        @csrf
                            <!-- konten modal-->
                            <div class="modal-content ">
                                <!-- heading modal -->
                                <div class="modal-header justify-content-center">
                                    <h4 style="color: #1949e6;"><strong> Tambah User </strong></h4>
                                </div>
                                    <!-- body modal --> 
                                    <div class="modal-body">
                                        <div class="mb-4 row">
                                            <label for="name" class="col-sm-3 col-form-label text-gray-900"><strong> Username </strong></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control text-gray-900" name="name" placeholder="nama pengguna" required>
                                            </div>
                                        </div>               
                                        <div class="mb-4 row">
                                            <label for="email" class="col-sm-3 col-form-label text-gray-900"><strong> Email </strong></label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control text-gray-900" name="email" required placeholder="email pengguna" required>
                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <label for="password" class="col-sm-3 col-form-label text-gray-900"><strong> Password </strong></label>
                                            <div class="col-md-9 input-group field-loginform-password">
                                                <input type="password" class="form-control text-gray-900" name="password" placeholder="password pengguna" required>
                                                <span class="input-group-text">
                                                    <i class="fas fa-eye-slash show-hide"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <label for="roles" class="col-sm-3 col-form-label text-gray-900"><strong> Role </strong></label>
                                            <div class="col-md-9">
                                                <select class="form-control text-gray-900" name="role_id" required>
                                                    <option disabled selected> -- Pilih Role -- </option>
                                                    @foreach ($role as $r)
                                                        <option value="{{ $r->id }}"> {{ $r->role_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="bph" class="col-sm-3 col-form-label text-gray-900" id="bph-label" style="display: none;"><strong> Nama BPH </strong></label>
                                            <div class="col-md-9">
                                                <select class="form-control text-gray-900" name="bph_id" style="display: none;">
                                                    <option value=""> -- Pilih BPH -- </option>
                                                    @php
                                                        $sortedBPH = $bph->sortBy('name');
                                                    @endphp
                                                    @foreach ($sortedBPH as $b)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('bph_id', $b->id)->exists();
                                                        @endphp
                                                        @if (!$hasAccount)
                                                            <option value="{{ $b->id }}"> {{ $b->name }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($sortedBPH as $b)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('bph_id', $b->id)->exists();
                                                        @endphp
                                                        @if ($hasAccount)
                                                            <option value="{{ $b->id }}" disabled> {{ $b->name }} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="donors" class="col-sm-3 col-form-label text-gray-900" id="donator-label" style="display: none;"><strong> Nama Donator </strong></label>
                                            <div class="col-md-9">
                                                <select class="form-control text-gray-900" name="donor_id" style="display: none;">
                                                    <option value=""> -- Pilih Donator -- </option>
                                                    @php
                                                        $sortedDonator = $donator->sortBy('name');
                                                    @endphp
                                                    @foreach ($sortedDonator as $dn)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('donor_id', $dn->id)->exists();
                                                        @endphp
                                                        @if (!$hasAccount)
                                                            <option value="{{ $dn->id }}"> {{ $dn->name }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($sortedDonator as $dn)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('donor_id', $dn->id)->exists();
                                                        @endphp
                                                        @if ($hasAccount)
                                                            <option value="{{ $dn->id }}" disabled> {{ $dn->name }} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                            
                                        <div class="row">
                                            <label for="penerima_beasiswa" class="col-sm-3 col-form-label text-gray-900" id="awardee-label" style="display: none;"><strong> Nama Awardee </strong></label>
                                            <div class="col-md-9">
                                                <select class="form-control text-gray-900" name="penerima_beasiswa_id" style="display: none;">
                                                    <option value=""> -- Pilih Awardee -- </option>
                                                    @php
                                                        $sortedAwardee = $awardee->sortBy('name_awarde');
                                                    @endphp
                                                    @foreach ($sortedAwardee as $u)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('penerima_beasiswa_id', $u->id)->exists();
                                                        @endphp
                                                        @if (!$hasAccount)
                                                            <option value="{{ $u->id }}"> {{ $u->name_awarde }} </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($sortedAwardee as $u)
                                                        @php
                                                            $hasAccount = \App\Models\User::where('penerima_beasiswa_id', $u->id)->exists();
                                                        @endphp
                                                        @if ($hasAccount)
                                                            <option value="{{ $u->id }}" disabled> {{ $u->name_awarde }} </option>
                                                        @endif
                                                    @endforeach
                                                </select>                                                                                                    
                                            </div>
                                        </div>                                                                
                                    </div>
                                    <!-- footer modal -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"> Add </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Tab panel plugins -->
    <script src="{{ asset('js/tab-panel.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/fontawesome-free/all.min.js') }}"></script>
    
    <script>
        const roleSelect = document.querySelector('select[name="role_id"]');
        const bphLabel = document.querySelector('label[for="bph"]');
        const bphSelect = document.querySelector('select[name="bph_id"]');
        const donatorLabel = document.querySelector('label[for="donors"]');
        const donatorSelect = document.querySelector('select[name="donor_id"]');
        const awardeeLabel = document.querySelector('label[for="penerima_beasiswa"]');
        const awardeeSelect = document.querySelector('select[name="penerima_beasiswa_id"]');

        roleSelect.addEventListener('change', function() {
            const selectedRoleId = this.value;
            if (selectedRoleId == 3) {
                bphLabel.style.display = 'none';
                bphSelect.style.display = 'none';
                donatorLabel.style.display = 'block';
                donatorSelect.style.display = 'block';
                awardeeLabel.style.display = 'none';
                awardeeSelect.style.display = 'none';
            } else if (selectedRoleId == 4) {
                bphLabel.style.display = 'none';
                bphSelect.style.display = 'none';
                donatorLabel.style.display = 'none';
                donatorSelect.style.display = 'none';
                awardeeLabel.style.display = 'block';
                awardeeSelect.style.display = 'block';
            } else if (selectedRoleId == 2) {
                bphLabel.style.display = 'block';
                bphSelect.style.display = 'block';
                donatorLabel.style.display = 'none';
                donatorSelect.style.display = 'none';
                awardeeLabel.style.display = 'none';
                awardeeSelect.style.display = 'none';
            } else {
                bphLabel.style.display = 'none';
                bphSelect.style.display = 'none';
                donatorLabel.style.display = 'none';
                donatorSelect.style.display = 'none';
                awardeeLabel.style.display = 'none';
                awardeeSelect.style.display = 'none';
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passField = document.querySelector(".field-loginform-password");
            const passInput = passField.querySelector("input");
            const eyeIcon = passField.querySelector(".show-hide");
    
            eyeIcon.addEventListener("click", function () {
                if (passInput.type === "password") {
                    passInput.type = "text";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                } else {
                    passInput.type = "password";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                }
            });
        });
    </script>
</body>
</html>