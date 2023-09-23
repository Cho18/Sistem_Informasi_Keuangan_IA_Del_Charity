@extends('dashboard.app')

@section('title', 'Tambah Pengguna')

@section('pengguna_dan_peran', 'active')
@section('pengguna', 'show')
@section('tambah_pengguna', 'active')

@section('contents')

    @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show col-md-6" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show col-md-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form class="form-group" action="" method="post" enctype="multipart/form-data">
    @csrf
        <!-- konten modal-->
        <div class="modal-content ">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1949e6;"><strong> Tambah Pengguna </strong></h4>
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
                    <div class="mb-4 row">
                        <label for="bph" class="col-sm-3 col-form-label text-gray-900" id="bph-label" ><strong> Nama BPH </strong></label>
                        <div class="col-md-9">
                            <select class="form-control text-gray-900" name="bph_id" data-live-search="true">
                                <option value=""> -- Pilih BPH -- </option>
                                @php
                                    $sortedBPH = $bph->sortBy('nama');
                                @endphp
                                @foreach ($sortedBPH as $b)
                                    @php
                                        $hasAccount = \App\Models\User::where('bph_id', $b->id)->exists();
                                    @endphp
                                    @if (!$hasAccount)
                                        <option value="{{ $b->id }}"> {{ $b->nama }} </option>
                                    @endif
                                @endforeach
                                @foreach ($sortedBPH as $b)
                                    @php
                                        $hasAccount = \App\Models\User::where('bph_id', $b->id)->exists();
                                    @endphp
                                    @if ($hasAccount)
                                        <option value="{{ $b->id }}" disabled> {{ $b->nama }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="donors" class="col-sm-3 col-form-label text-gray-900" id="donator-label" ><strong> Nama Donator </strong></label>
                        <div class="col-md-9">
                            <select class="form-control text-gray-900" name="donor_id" data-live-search="true">
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
                    <div class="mb-4 row">
                        <label for="penerima_beasiswa" class="col-sm-3 col-form-label text-gray-900" id="awardee-label" ><strong> Nama Awardee </strong></label>
                        <div class="col-md-9">
                            <select class="form-control text-gray-900" name="penerima_beasiswa_id" data-live-search="true">
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

    {{-- <script>
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
    </script> --}}
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
@endsection