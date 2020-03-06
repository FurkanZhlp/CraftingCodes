<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{\App\Options::value('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('admin/assets/images/favicon.ico') }}">

    <link href="{{ url('admin/assets/plugins/filter/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ url('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="dark-sidenav">

<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{route('admin')}}" class="logo">
            {{\App\Options::value('title')}}
        </a>
    </div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{ url('admin/assets/images/users/user-4.jpg') }}" alt="profile-user" class="rounded-circle" />
                    <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->email}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('home')}}"><i class="dripicons-home text-muted mr-2"></i> Anasayfa</a>
                    <a class="dropdown-item" href="{{route('admin.user',Auth::user()->id)}}"><i class="dripicons-gear text-muted mr-2"></i> Ayarlarım</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit text-muted mr-2"></i> Çıkış Yap</a>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fas fa-search"></i></a>
                </form>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->

<div class="page-wrapper">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="{{route('admin')}}"><i class="ti-palette"></i><span>Arayüz</span></a>
            </li>
            <li>
                <a href="{{route('admin.products')}}"><i class="ti-palette"></i><span>Ürünler</span></a>
            </li>
            <li>
                <a href="{{route('admin.users')}}"><i class="ti-palette"></i><span>Üyeler</span></a>
            </li>
            <li>
                <a href="javascript: void(0);"><i class="ti-bar-chart"></i><span>Analytics</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="../analytics/analytics-index.html"><i class="ti-control-record"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../analytics/analytics-customers.html"><i class="ti-control-record"></i>Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../analytics/analytics-reports.html"><i class="ti-control-record"></i>Reports</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end left-sidenav-->

    <!-- Page Content-->
    <div class="page-content">

        <div class="container-fluid pt-5">
            @yield('content')
        </div><!-- container -->
        <footer class="footer text-center text-sm-left">
            &copy; {{date("Y")}} CraftingCodes <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Green</span>
        </footer><!--end footer-->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- jQuery  -->
<script src="{{ url('admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ url('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('admin/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ url('admin/assets/js/waves.min.js') }}"></script>
<script src="{{ url('admin/assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ url('admin/assets/plugins/filter/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('admin/assets/plugins/filter/masonry.pkgd.min.js') }}"></script>
<script src="{{ url('admin/assets/plugins/filter/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('admin/assets/pages/jquery.gallery.inity.js') }}"></script>

<!-- App js -->
<script src="{{ url('admin/assets/js/app.js') }}"></script>

</body>
</html>
