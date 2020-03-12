<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{\App\Options::value('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{\App\Options::value('meta_desc')}}" name="description" />
    <meta content="Mannatthemes" name="author" />
    @if(View::hasSection('social'))
        @yield('social')
    @else
    <meta property="og:title" content="@yield('title') - {{\App\Options::value('title')}}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="{{url('logo-sm.png')}}" />
    <meta property="og:description" content="{{\App\Options::value('meta_desc')}}" />
    @endif
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('logo-sm.png')}}">

    <!-- App css -->
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('assets/js/jquery.min.js')}}"></script>

</head>

<body>

<!-- Top Bar Start -->
<div class="topbar">

    <!-- Navbar -->
    <nav class="topbar-main container">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="{{route('home')}}" class="logo">
                        <span>
                            <img src="{{url('logo-sm.png')}}" alt="logo-small" class="logo-sm">
                        </span>
                <span>
                            <img src="{{url('logo-dark.png')}}" alt="logo-large" class="logo-lg">
                        </span>
            </a>
        </div><!--topbar-left-->
        <!--end logo-->
        <ul class="list-unstyled topbar-nav float-right mb-0">
            @auth
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <h6 class="dropdown-item-text">
                        Notifications (18)
                    </h6>
                    <div class="slimscroll notification-list">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                            <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                        </a>
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li><!--end notification-list-->
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user pr-0" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{Auth::user()->userImage()}}" alt="profile-user" class="rounded-circle" />
                    <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('profile',Auth::user()->username)}}"><i class="dripicons-user text-muted mr-2"></i> Profil</a>
                    <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Ayarlarım</a>
                    <a class="dropdown-item text-danger" href="{{route('admin')}}"><i class="dripicons-lock text-muted mr-2"></i> Yönetim Paneli</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit text-muted mr-2"></i> Çıkış Yap</a>
                </div>
            </li>

            @else
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user pr-0" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <span class="ml-1 nav-user-name hidden-sm">Hesap <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('login')}}"><i class="dripicons-user text-muted mr-2"></i> Giriş Yap</a>
                        <a class="dropdown-item" href="{{route('register')}}"><i class="dripicons-wallet text-muted mr-2"></i> Kayıt Ol</a>
                    </div>
                </li><!--end dropdown-->
            @endauth
            <li class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link" id="mobileToggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li> <!--end menu item-->
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Ürün ara..." class="form-control">
                    <a href=""><i class="fas fa-search"></i></a>
                </form>
            </li>
        </ul><!--end topbar-nav-->
    </nav>
    <!-- end navbar-->
    <!-- MENU Start -->
    <div class="navbar-custom-menu">
        <div class="container-fluid d-flex justify-content-center">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu d-flex justify-content-center">
                    <li class="mcs-nav-item">
                        <a href="{{route('home')}}">
                            <svg class="nav-svg" viewBox="0 0 512 512"><path d="M169.6 377.6c-22.882 0-41.6 18.718-41.6 41.601 0 22.882 18.718 41.6 41.6 41.6s41.601-18.718 41.601-41.6c-.001-22.884-18.72-41.601-41.601-41.601zM48 51.2v41.6h41.6l74.883 151.682-31.308 50.954c-3.118 5.2-5.2 12.482-5.2 19.765 0 27.85 19.025 41.6 44.825 41.6H416v-40H177.893c-3.118 0-5.2-2.082-5.2-5.2 0-1.036 2.207-5.2 2.207-5.2l20.782-32.8h154.954c15.601 0 29.128-8.317 36.4-21.836l74.882-128.8c1.237-2.461 2.082-6.246 2.082-10.399 0-11.446-9.364-19.765-20.8-19.765H135.364L115.6 51.2H48zm326.399 326.4c-22.882 0-41.6 18.718-41.6 41.601 0 22.882 18.718 41.6 41.6 41.6S416 442.082 416 419.2c0-22.883-18.719-41.6-41.601-41.6z"></path></svg>
                            <span>Anasayfa</span>
                        </a>
                    </li>
                    <li class="mcs-nav-item">
                        <a href="#">
                            <svg class="nav-svg" viewBox="0 0 512 512"><path d="M352 144v-39.6C352 82 334 64 311.6 64H200.4C178 64 160 82 160 104.4V144H48v263.6C48 430 66 448 88.4 448h335.2c22.4 0 40.4-18 40.4-40.4V144H352zm-40 0H200v-40h112v40z"></path></svg>
                            <span>Ekipler</span>
                        </a>
                    </li>
                </ul>
            </div> <!-- end navigation -->
        </div> <!-- end container-fluid -->
    </div> <!-- end navbar-custom -->
</div>
<!-- Top Bar End -->

<div class="page-wrapper">


    <!-- Page Content-->
    <div class="page-content">

        <div class="container">
            @yield('content')

        </div><!-- container -->
    </div>
    <!-- end page content -->
    <footer class="footer text-center text-sm-left">
        <div class="boxed-footer container">
            &copy; {{date("Y")}} MCSepeti.com -
            <span class="text-muted">MCSepeti.com <a href="#">xxx.com</a> sunucularında barınmaktadır.</span>
            <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Green</span>
        </div>
    </footer><!--end footer-->
</div>
<!-- end page-wrapper -->

<!-- jQuery  -->
<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/js/metisMenu.min.js')}}"></script>
<script src="{{url('assets/js/waves.min.js')}}"></script>
<script src="{{url('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- App js -->
<script src="{{url('assets/js/app.js')}}"></script>

</body>
</html>
