<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Set the favicon for the website -->
    <link rel="shortcut icon" href="/img/Logo_IADC.ico" type="image/x-icon">

    <!-- Set the title of the page -->
    <title> IADC | @yield('title') </title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom datatables for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    
    <!-- Template Stylesheet -->
    <script src="{{ asset('css/publik.css') }}"></script>
    <style>
        /********** Template CSS **********/
        :root {
            --primary: #2124B1;
            --secondary: #4777F5;
            --light: #fafff7;
            --dark: #1D1D27;
        }


        /*** Spinner ***/
        #spinner {
            opacity: 0;
            visibility: hidden;
            transition: opacity .5s ease-out, visibility 0s linear .5s;
            z-index: 99999;
        }

        #spinner.show {
            transition: opacity .5s ease-out, visibility 0s linear 0s;
            visibility: visible;
            opacity: 1;
        }

        .back-to-top {
            position: fixed;
            display: none;
            right: 45px;
            bottom: 45px;
            z-index: 99;
        }


        /*** Heading ***/
        h1,
        h2,
        h3,
        .fw-bold {
            font-weight: 700 !important;
        }

        h4,
        h5,
        h6,
        .fw-medium {
            font-weight: 500 !important;
        }


        /*** Button ***/
        .btn {
            font-weight: 500;
            transition: .5s;
        }

        .btn-square {
            width: 38px;
            height: 38px;
        }

        .btn-sm-square {
            width: 32px;
            height: 32px;
        }

        .btn-lg-square {
            width: 48px;
            height: 48px;
        }

        .btn-square,
        .btn-sm-square,
        .btn-lg-square {
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: normal;
            border-radius: 50px;
        }

        .container-xxl.py-5 + .container-xxl.py-5 {
            margin-top: -100px; 
        }

        p {
            text-align: justify;
        }

        li {
            text-align: left;
        }
        .service-item {
            align-items: center;
            justify-content: center;
        }


        /*** Navbar ***/
        .navbar-light .navbar-nav .nav-link {
            position: relative;
            margin-left: 25px;
            padding: 15px 0;
            color: var(--light) !important;
            outline: none;
            transition: .5s;
            font-weight: 500;
        }

        .sticky-top.navbar-light .navbar-nav .nav-link {
            padding: 15px 0;
            color: var(--light) !important; /* Text color remains light on scroll */
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: var(--dark) !important;
        }

        .navbar-light {
            background-color: var(--primary);
        }

        .navbar-light .navbar-brand h1 {
            color: var(--light);
            margin-top: 10px;
        }

        .navbar-light .navbar-brand img {
            max-height: 45px;
            transition: .5s;
        }

        .navbar-light .navbar-brand .ms-2 {
            font-size: 1.2rem;
            color: var(--light);
            font-weight: 500;
            margin-top: 5px;
        }

        .sticky-top.navbar-light .navbar-brand img {
            max-height: 40px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
        }

        @media (max-width: 991.98px) {
            .sticky-top.navbar-light {
                position: relative;
                background: #FFFFFF;
            }

            .navbar-light .navbar-collapse {
                margin-top: 15px;
                border-top: 1px solid #DDDDDD;
            }

            .navbar-light .navbar-nav .nav-link,
            .sticky-top.navbar-light .navbar-nav .nav-link {
                padding: 10px 0;
                margin-left: 0;
                color: var(--light) !important;
            }

            .navbar-light .navbar-brand h1 {
                color: var(--light);
            }

            .navbar-light .navbar-brand img {
                max-height: 40px;
            }
        }

        @media (min-width: 992px) {
            .navbar-light {
                position: absolute;
                width: 100%;
                top: 0;
                left: 0;
                border-bottom: 1px solid rgba(256, 256, 256, .1);
                z-index: 999;
            }
            
            .sticky-top.navbar-light {
                position: fixed;
                background: var(--primary);
            }

            .navbar-light .navbar-nav .nav-link::before {
                position: absolute;
                content: "";
                width: 0;
                height: 2px;
                bottom: -1px;
                left: 50%;
                background: var(--dark);
                transition: .5s;
            }

            .navbar-light .navbar-nav .nav-link:hover::before,
            .navbar-light .navbar-nav .nav-link.active::before {
                width: 100%;
                left: 0;
            }

            .navbar-light .navbar-nav .nav-link.nav-contact::before {
                display: none;
            }

            .sticky-top.navbar-light .navbar-brand h1 {
                color: var(--light);
            }
        }

        /*** Section Title ***/
        .section-title {
            margin-top: 20px;
        }

        .section-title::before {
            position: absolute;
            content: "";
            width: 45px;
            height: 4px;
            bottom: 0;
            left: 0;
            background: var(--dark);
        }

        .section-title::after {
            position: absolute;
            content: "";
            width: 4px;
            height: 4px;
            bottom: 0;
            left: 50px;
            background: var(--dark);
        }

        .section-title.text-center::before {
            left: 50%;
            margin-left: -25px;
        }

        .section-title.text-center::after {
            left: 50%;
            margin-left: 25px;
        }

        .section-title h6::before,
        .section-title h6::after {
            position: absolute;
            content: "";
            width: 10px;
            height: 10px;
            top: 2px;
            left: 0;
            background: rgba(33, 66, 177, .5);
        }

        .section-title h6::after {
            top: 5px;
            left: 3px;
        }

        /*** Project Portfolio ***/
        #portfolio-flters .btn {
            position: relative;
            display: inline-block;
            margin: 10px 4px 0 4px;
            transition: .5s;
        }

        #portfolio-flters .btn::after {
            position: absolute;
            content: "";
            right: -1px;
            bottom: -1px;
            border-left: 20px solid transparent;
            border-right: 0 solid transparent;
            border-bottom: 50px solid #FFFFFF;
        }

        #portfolio-flters .btn:hover,
        #portfolio-flters .btn.active {
            color: var(--light);
            background: var(--primary);
        }

        .portfolio-overlay {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 30px;
            top: 0;
            left: 0;
            background: var(--primary);
            transition: .5s;
            z-index: 1;
            opacity: 0;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }

        .portfolio-item .btn {
            position: absolute;
            width: 90px;
            height: 90px;
            top: 0px;
            right: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url(../img/icon-shape-white.png) center center no-repeat;
            border: none;
            transition: .5s;
            opacity: 0;
            z-index: 2;
        }

        .portfolio-item:hover .btn {
            opacity: 1;
            transition-delay: .15s;
        }

        /*** Testimonial ***/
        .newsletter,
        .testimonial {
            background-position:
                left top,
                right bottom;
            background-repeat: no-repeat;
        }

        .testimonial-carousel .owl-item .testimonial-item,
        .testimonial-carousel .owl-item.center .testimonial-item * {
            transition: .5s;
        }

        .testimonial-carousel .owl-item.center .testimonial-item {
            background: var(--light) !important;
            border-color: var(--light);
        }

        .testimonial-carousel .owl-item.center .testimonial-item * {
            color: #888888;
        }

        .testimonial-carousel .owl-item.center .testimonial-item i {
            color: var(--primary) !important;
        }

        .testimonial-carousel .owl-item.center .testimonial-item h6 {
            color: var(--dark) !important;
        }

        .container-xxl.bg-primary.newsletter.my-5 .row.align-items-center .col-md-6.text-center.d-none.d-md-block img {
            width: 100%;
            height: 400px;
        }

        .container-xxl.bg-primary.newsletter.my-5 .row.align-items-center .col-md-6.text-center.img-visible-on-small img {
            width: 80%;
            height: 400px;
        }
        @media (max-width: 767.98px) {
            .container-xxl.bg-primary.newsletter.my-5 {
                background: none;
                color: var(--light);
            }
        }

        .container-xxl.bg-primary.newsletter.my-5 {
            background-position:
                left top,
                right bottom;
            background-repeat: no-repeat;
            color: var(--dark); 
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle img-fluid w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="/home" class="navbar-brand p-0">
                    <div class="logo-container">
                        <img src="img/Logo_IADC.ico" alt="Logo" class="logo-img">
                        <span class="ms-2">IADC</span>
                    </div>
                </a>                               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="/home" class="nav-item nav-link {{ Request::is('home') ? ' active' : '' }}">Home</a>
                        <a href="/album" class="nav-item nav-link {{ Request::is('album') ? ' active' : '' }}">Album</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle {{ Request::is('pemasukan_keuangan', 'pengeluaran_keuangan') ? 'active' : '' }}" data-bs-toggle="dropdown">Keuangan</a>
                            <div class="dropdown-menu m-0">
                                <a href="/pemasukan_keuangan" class="dropdown-item {{ Request::is('pemasukan_keuangan') ? ' active' : '' }}">Pemasukan</a>
                                <a href="/pengeluaran_keuangan" class="dropdown-item {{ Request::is('pengeluaran_keuangan') ? ' active' : '' }}">Pengeluaran</a>
                            </div>
                        </div>
                        <a href="/login" class="nav-item nav-link">Login</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->

        @yield('contents')

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Page level custom scripts datatables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/publik.js') }}"></script>
    <script>
        (function ($) {
            "use strict";

            // Spinner
            var spinner = function () {
                setTimeout(function () {
                    if ($('#spinner').length > 0) {
                        $('#spinner').removeClass('show');
                    }
                }, 1);
            };
            spinner();
            
            // Initiate the wowjs
            new WOW().init();

            // Sticky Navbar
            $(window).scroll(function () {
                if ($(this).scrollTop() > 45) {
                    $('.navbar').addClass('sticky-top shadow-sm');
                } else {
                    $('.navbar').removeClass('sticky-top shadow-sm');
                }
            });

            // Dropdown on mouse hover
            const $dropdown = $(".dropdown");
            const $dropdownToggle = $(".dropdown-toggle");
            const $dropdownMenu = $(".dropdown-menu");
            const showClass = "show";
            
            $(window).on("load resize", function() {
                if (this.matchMedia("(min-width: 992px)").matches) {
                    $dropdown.hover(
                    function() {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function() {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                    );
                } else {
                    $dropdown.off("mouseenter mouseleave");
                }
            });

            // Back to top button
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn('slow');
                } else {
                    $('.back-to-top').fadeOut('slow');
                }
            });
            $('.back-to-top').click(function () {
                $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
                return false;
            });

            // Testimonials carousel
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1000,
                margin: 25,
                dots: false,
                loop: true,
                center: true,
                responsive: {
                    0:{
                        items:1
                    },
                    576:{
                        items:1
                    },
                    768:{
                        items:2
                    },
                    992:{
                        items:3
                    }
                }
            });

            // Portfolio isotope and filter
            var portfolioIsotope = $('.portfolio-container').isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });
            $('#portfolio-flters li').on('click', function () {
                $("#portfolio-flters li").removeClass('active');
                $(this).addClass('active');

                portfolioIsotope.isotope({filter: $(this).data('filter')});
            });
            
        })(jQuery);
    </script>
</body>

</html>
