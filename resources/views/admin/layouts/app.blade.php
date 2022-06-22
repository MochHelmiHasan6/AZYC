<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Data Management | AZYC Numerator</title>
    <link rel="icon" href="{{url('')}}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{url('assets/admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/icon-kit/dist/css/iconkit.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/ionicons/dist/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{url('assets/admin/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet"
        href="{{url('assets/admin/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/weather-icons/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/c3/c3.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/owl.carousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/owl.carousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/dist/css/theme.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/src/js/vendor/modernizr-2.8.3.min.js')}}">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">

    {{-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    @yield('css')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <style>
        .jq-icon-success {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==);
            color: #ffffff;
            background-color: #2dce89;
            border-color: #d6e9c6;
        }

        .fixedButtonAdd {
            position: fixed;
            bottom: 10px;
            right: 50px;
        }

        .fixedButtonRefresh {
            position: fixed;
            bottom: 10px;
            right: 110px;
        }

        .fixedButtonPrint {
            position: fixed;
            bottom: 10px;
            right: 170px;
        }

        .footer-buttons .btn-icon {
            width: 50px;
            height: 50px;
            color: white;
            line-height: 2.5;
            font-size: 20px;
            border-radius: 100%;
        }

    </style>
    <style>
        tfoot {
            display: table-header-group;
        }

        tbody tr:nth-child(odd) td {
            background-color: #f2f2f2
        }

        tbody tr:nth-child(even) td {
            background-color: #ffffff
        }

        tbody tr:hover td {
            background-color: #ececec;
        }

        .dataTables_filter {
            display: none;
        }

    </style>
    <style>
        .paginate_button.page-item.active .page-link {
            background: #404e67 !important;
            color: #FFFFFF !important;
        }

    </style>
    <style>
        .scroll {
            overflow: scroll;
        }

        /* th, td {
            white-space: nowrap;
        } */

        .scroll::-webkit-scrollbar {
            height: 7px;
            width: 7px;
            border: 1px solid #d5d5d5;
        }

        .scroll::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .scroll::-webkit-scrollbar-thumb {
            background: #4a587263;
            border-radius: 5px;
        }

        .modal-body {
            position: relative;
            overflow-y: auto;
            overflow-x: auto;
            max-height: 400px;
            /* padding: 15px; */
        }

        td {
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

    </style>
    @yield('header')

    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        {{-- <h5>Selamat Datang, {{Auth::user()->id}}</h5> --}}
                        <h5>Selamat Datang, Admin!</h5>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i
                                class="ik ik-maximize"></i></button>

                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{url('assets/admin/img/user.png')}}" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i>
                                    Profile</a>
                                <a class="dropdown-item" href="#"><i class="ik ik-lock dropdown-icon"></i>
                                    Ubah Kata Sandi</a> --}}
                                <a  class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" role="button"><i class="ik ik-power dropdown-icon"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="#">
                        <div class="logo-img">
                            <img src="{{url('assets/admin/img/logo_invert.png')}}" class="logo_invert"
                                width="500%">
                        </div>
                    </a>

                </div>

                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                            {{-- <div class="nav-item">
                                <a href="{{route('dashboard.index')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div> --}}

                            <div
                                class="nav-item {{Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? 'active' : ''}}">
                                    <a href="{{route('user.index')}}"
                                        class="menu-item {{Route::is('user.index') || Route::is('user.create') || Route::is('user.edit')  ? 'active' : ''}}"><i
                                            class="mdi mdi-account"></i> User</a>
                            </div>

                            <div
                                class="nav-item {{Route::is('produk.index') || Route::is('produk.create') || Route::is('produk.edit') ? 'active' : ''}}">
                                    <a href="{{route('produk.index')}}"
                                        class="menu-item {{Route::is('produk.index') || Route::is('produk.create') || Route::is('produk.edit')  ? 'active' : ''}}"><i
                                            class="mdi mdi-view-list"></i> Jasa</a>
                            </div>

                            <div
                                class="nav-item {{Route::is('transaksi.index') || Route::is('transaksi.create') || Route::is('transaksi.edit') ? 'active' : ''}}">
                                    <a href="{{route('transaksi.index')}}"
                                        class="menu-item {{Route::is('transaksi.index') || Route::is('transaksi.create') || Route::is('transaksi.edit')  ? 'active' : ''}}"><i
                                            class="mdi mdi-credit-card"></i> Pesanan</a>
                            </div>

                            

                            <div
                                class="nav-item {{Route::is('rekap.index')}}">
                                    <a href="{{route('rekap.index')}}"
                                        class="menu-item {{Route::is('rekap.index')}}"><i
                                            class="mdi mdi-account"></i> Rekapitulasi</a>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>

            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    @yield('iconHeader')
                                    <div class="d-inline">
                                        <h5>@yield('titleHeader')</h5>
                                        <span>@yield('subtitleHeader')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <i class="ik ik-home"></i><a href="#"> Beranda</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb')</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @yield('content-wrapper')
                </div>
            </div>
            <div class='footer-buttons'>
                @yield('fixedButton')
            </div>
            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2022 </span>
                </div>
            </footer>

        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/admin/src/js/vendor/jquery-3.3.1.min.js"><\/script>')

    </script>
    <script src="{{url('assets/admin/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/screenfull/dist/screenfull.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
    </script>
    <script src="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{url('assets/admin/plugins/moment/moment.js')}}"></script>
    <script src="{{url('assets/admin/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>
    <script src="{{url('assets/admin/plugins/d3/dist/d3.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/c3/c3.min.js')}}"></script>

    <script src="{{url('assets/admin/js/widgets.js')}}"></script>
    <script src="{{url('assets/admin/js/charts.js')}}"></script>
    <script src="{{url('assets/admin/dist/js/theme.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script src="{{url('assets/admin/js/alerts.js')}}"></script>
    <script src="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    @yield('footer')

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function (b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function () {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');

    </script>

    <script type="text/javascript">
        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });

    </script>

</body>

</html>

