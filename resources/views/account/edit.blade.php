@extends('dashboard.app')

@section('title', 'Edit Account')

@section('contents')
@if ($errors->any())
<div class="alert alert-danger col-md-6">
    <ul>
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif
    <form class="form-group" action="/account/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <!-- konten modal-->
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header justify-content-center">
                <h4 style="color: #1b8112;"><strong>Edit Account</strong></h4>
            </div>
            
            <!-- body modal --> 
            <div class="modal-body">
                <div class="mb-4 row">
                    <label for="profile" class="col-sm-3 col-form-label text-gray-900"><strong> Foto Profile </strong></label>
                    <div class="col-md-9">
                        <input type="hidden" name="oldImage" value="{{ Auth::user()->profile }}">
                        @if (Auth::user()->profile)
                            <img src="{{ asset('storage/'.Auth::user()->profile) }}" width="40px" height="40px" alt="" class="img-preview img-fluid mb-2 col-sm-4">
                        @else
                            <img class="img-preview img-fluid mb-2 col-sm-4">
                        @endif
                        <input type="file" class="form-control text-gray-900" id="images" name="profile" onchange="previewImage()"> 
                    </div>
                </div> 
                <div class="mb-4 row">
                    <label for="name" class="col-sm-3 col-form-label text-gray-900"><strong> Username </strong></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control text-gray-900" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="email" class="col-sm-3 col-form-label text-gray-900"><strong> Email </strong></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control text-gray-900" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                </div>
                <div class="mb-4 row">
                    <label for="password" class="col-sm-3 col-form-label text-gray-900"><strong> Password </strong></label>
                    <div class="col-md-9 input-group field-loginform-password">
                        <input type="password" class="form-control text-gray-900" name="password">
                        <span class="input-group-text">
                            <i class="fas fa-eye-slash show-hide"></i>
                        </span>
                    </div>
                </div>                  
                {{-- <div class="mb-4 row">
                    <label for="confirm_password" class="col-sm-3 col-form-label text-gray-900"><strong>Confirm Password</strong></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control text-gray-900" name="confirm_password">
                    </div>
                </div> --}}
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/account" type="button" class="btn btn-warning">Back</a>
            </div>
        </div>
    </form>
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
