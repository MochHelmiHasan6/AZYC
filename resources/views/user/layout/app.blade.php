<!DOCTYPE html>
<html lang="en">

<head>
    <title>AZYC Nomerator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{url('assets/admin/img/logo_ori.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/admin/img/logo_ori.png')}}">

    <link rel="stylesheet" href="{{url('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/custom.css')}}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{url('assets/frontend/css/fontawesome.min.css')}}">
    @yield('css')

</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:azycnomerator@gmail.com">azycnomerator@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:0851-0174-9179">0851-0174-9179</a>
                </div>
                <!-- <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div> -->
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                <img src="{{url('assets/admin/img/logo_ori.png')}}" width="150">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-start" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-start mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengguna.index') }}">Beranda</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="shop.html">Shop</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Kontak</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    {{-- <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a> --}}
                    <a class="nav-icon position-relative text-decoration-none" href="{{route('cart.index')}}">
                        <i class="fa fa-fw fa-shopping-cart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                        Keranjang
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="{{route('profile.show')}}">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                        Akun
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->
    @yield('header')
    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- main content --}}
    <div class="container py-5">
        <div class="row">
            @yield('content')
        </div>
    </div>


    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-muted border-bottom pb-3 border-light logo">AZYC Nomerator</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Jl. Raya Ki Ageng Gribig No.234, Madyopuro, Kec. Kedungkandang, Kota Malang, Jawa Timur 65138
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:0851-0174-9179">0851-0174-9179</a>
                        </li>
                        <li>
                            <i class="fas fa-door-open fa-fw"></i>
                            Buka Hari Senin - Sabtu
                        </li>
                        <li>
                            <i class="fa fa-clock fa-fw"></i>
                            Pukul 08.00 - 17.00
                        </li>
                    </ul>
                </div>

                <div class="col-md-8 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Lokasi</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.1632702688757!2d112.65958381744383!3d-7.982068499999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62860d2621563%3A0xcab08ca5b95bac78!2sAzyc%20Nomerator!5e0!3m2!1sen!2sid!4v1653618429897!5m2!1sen!2sid" width="720" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </ul>
                </div>
            </div>

            {{-- <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2022 AZYC Nomerator
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{url('assets/frontend/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{url('assets/frontend/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{url('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/frontend/js/templatemo.js')}}"></script>
    <script src="{{url('assets/frontend/js/custom.js')}}"></script>
    <!-- End Script -->
    @yield('footer')
</body>

</html>
