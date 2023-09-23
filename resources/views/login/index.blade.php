<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet">

    <!-- Set the favicon for the website -->
    <link rel="shortcut icon" href="/img/Logo_IADC.ico" type="image/x-icon">

    <!-- Set the title of the page -->
    <title> IADC | Login </title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <img src="./img/Logo_IADC.png" width="70px">
                    <small> IA Del Charity </small>
                </p>
                <hr>
                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="" method="post">
                    @csrf
                    <div class="form-group has-feedback">
                        <div class="form-group field-loginform-username required">
                            <label class="control-label" for="email"> Email </label>
                            <input
                            type="text"
                            name="email"
                            id="email"
                            class="form-control"
                            aria-required="true"
                            autofocus
                            required>
                        </div>
                        {{-- <div class="form-group field-loginform-username required">
                            <label class="control-label" for="email"> Email </label>
                            <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            aria-required="true"
                            autofocus
                            required>
                        </div> --}}
                        <div class="form-group field-loginform-password required mt-2">
                            <label class="control-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" aria-required="true" required/>
                                <span class="input-group-text">
                                    <i class="fas fa-eye-slash show-hide"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/home" class="btn btn-danger btn-block mr-2"> Back </a>
                            <button type="submit" class="btn btn-primary btn-block"> Login </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passField = document.querySelector(".field-loginform-password");
            const passInput = passField.querySelector("input");
            const eyeIcon = passField.querySelector(".fa-eye-slash");
        
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