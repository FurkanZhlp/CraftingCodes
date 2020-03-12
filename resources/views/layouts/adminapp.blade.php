<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{\App\Options::value('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Green,CraftingCodes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('logo-sm.png') }}">

    <link href="{{ url('admin/assets/plugins/filter/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ url('assets/css/croppie.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ url('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/croppie.js') }}"></script>
    @if(View::hasSection('head'))
    @yield('head')
    @endif

</head>

<body class="dark-sidenav">
<div class="topbar">
    <div class="topbar-left">
        <a href="{{route('admin')}}" class="logo">
            {{\App\Options::value('title')}}
        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Auth::user()->userImage() }}" alt="profile-user" class="rounded-circle" />
                    <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->email}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('home')}}"><i class="dripicons-home text-muted mr-2"></i> Anasayfa</a>
                    <a class="dropdown-item" href="{{route('admin.user',Auth::user()->id)}}"><i class="dripicons-gear text-muted mr-2"></i> Ayarlarım</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit text-muted mr-2"></i> Çıkış Yap</a>
                </div>
            </li>
        </ul>
        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>
<div class="page-wrapper">
    <div class="left-sidenav">
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="{{route('admin')}}"><i class="ti-palette"></i><span>Arayüz</span></a>
            </li>
            <li>
                <a href="{{route('admin.products')}}"><i class="ti-files"></i><span>Ürünlerim</span></a>
            </li>
            @if(Auth::user()->admin)
            <li>
                <a href="{{route('admin.users')}}"><i class="ti-user"></i><span>Üyeler</span></a>
            </li>
            <li>
                <a href="{{route('admin.categories')}}"><i class="ti-list"></i><span>Kategoriler</span></a>
            </li>
            <li>
                <a href="{{route('admin.products')}}">
                    <i class="ti-folder"></i>
                    <span>Ürünler</span>
                    @if(\App\Product::all()->count() > 0)
                    <span class="badge badge-pink float-right mr-2">{{\App\Product::all()->count()}}</span>
                    <span class="badge badge-soft-success float-right mr-2">Onay</span>
                    @endif
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="page-content">

        <div class="container-fluid pt-5">
            @yield('content')
        </div>
        <footer class="footer text-center text-sm-left">
            &copy; {{date("Y")}} CraftingCodes <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Green</span>
        </footer>
    </div>
</div>
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
