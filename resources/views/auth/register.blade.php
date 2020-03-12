@section('title','Kayıt Ol')
    <!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{\App\Options::value('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{\App\Options::value('meta_desc')}}" name="description" />
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

</head>

<body class="account-body">

<!-- Log In page -->
<div class="row vh-100 ">
    <div class="col-12 align-self-center" style="
        background-image: url('{{url('login.jpg')}}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: 100%;">
        <div class="auth-page pb-5" style="margin-top: 50px;">
            <div class="card auth-card shadow-lg">
                <div class="card-body">
                    <div class="px-3">
                        <div class="auth-logo-box">
                            <a href="{{route('home')}}" class="logo logo-admin">
                                <img src="{{url('logo-sm.png')}}" height="55" alt="logo" class="auth-logo">
                            </a>
                        </div><!--end auth-logo-box-->

                        <div class="text-center auth-logo-text">
                            <h4 class="mt-0 mb-3 mt-5">MCSepeti.com</h4>
                            <p class="text-muted mb-0">MCSepeti.com'da devam edebilmek için kayıt ol.</p>
                        </div> <!--end auth-logo-text-->


                        <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="username">Adınız Soyadınız</label>
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-user"></i>
                                    </span>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="username">Kullanıcı Adınız</label>
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-user"></i>
                                    </span>
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="username">Mail Adresiniz</label>
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-user"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="userpassword">Şifreniz</label>
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="userpassword">Şifre Tekrarı</label>
                                <div class="input-group mb-3">
                                    <span class="auth-form-icon">
                                        <i class="dripicons-lock"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div><!--end form-group-->
                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Kayıt Ol <i class="fas fa-sign-in-alt ml-1"></i></button>
                                </div><!--end col-->
                            </div> <!--end form-group-->
                        </form><!--end form-->
                    </div><!--end /div-->

                    <div class="m-3 text-center text-muted">
                        <p class="">Zaten hesabın var mı?  <a href="{{route('login')}}" class="text-primary ml-2">Giriş Yap</a></p>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end auth-page-->
    </div><!--end col-->
</div><!--end row-->
<!-- End Log In page -->


<!-- jQuery  -->
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/js/metisMenu.min.js')}}"></script>
<script src="{{url('assets/js/waves.min.js')}}"></script>
<script src="{{url('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- App js -->
<script src="{{url('assets/js/app.js')}}"></script>

</body>
</html>
