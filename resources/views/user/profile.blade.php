@extends('layouts.app')
@section('title', $user->username."'in profili")
@section('content')
    <style>
        ul.list {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        ul.list li {
            line-height: 24px;
            color: #979aae;
            margin-bottom: 15px;
            overflow: hidden;
        }
        ul.list li span:first-child {
             position: relative;
             display: block;
             float: left;
             width: 120px;
             margin-right: 5px;
             color: #515365;
             font-weight: 600;
        }
        ul.list li span:first-child i{
            font-size:9px;
            margin-right: 3px;
        }
        ul.list li span:first-child:after {
            position: absolute;
            top:0px;
            right:0px;
            content: ":";
        }
    </style>
    <div class="card-body  met-pro-bg"  style="background-image: url(https://cdn.r10.net/kapaklar/106190-1583124594.jpg);">
        <div class="met-profile">
            <div class="row">
                <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                    <div class="met-profile-main">
                        <div class="met-profile-main-pic rounded-circle">
                            <img src="{{$user->userImage()}}" alt="" style="width:128px;height:128px;" class="rounded-circle">
                            @if($user->isOnline())
                            <i  data-toggle="tooltip" data-container="body" data-original-title="Çevrimiçi" style="top:50%;right:-10px;position: absolute;"class="mdi mdi-circle d-block mt-n2 font-18 text-success"></i>
                            @else
                            <i  data-toggle="tooltip" data-container="body" data-original-title="Çevrimdışı" style="top:50%;right:-10px;position: absolute;"class="mdi mdi-circle d-block mt-n2 font-18 text-muted"></i>
                            @endif
                        </div>
                        <div class="met-profile_user-detail">
                            <h5 class="met-user-name">{{$user->username}}</h5>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end f_profile-->
    </div>
    <div class="row p-0 m-0 mt-4">
        <div class="col-lg-3">
            <div class="card">
                @if($ownProfile)
                    <a href="#" class="btn btn-outline-dark btn-block rounded-0">
                        <i class="em em-hammer_and_wrench"></i>
                        Profil Ayarlarım
                    </a>
                @else
                <a href="#" class="btn btn-outline-dark btn-block rounded-0">
                    <i class="em em-mail"></i>
                    Özel Mesaj Gönder
                </a>
                @endif
                <div class="card-body text-center ">
                    <b class="m-0">Son Görülme:</b>
                    <p class="m-0">{{$user->lastSeen()}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body  ">
                    <ul class="list">
                        <li>
                            <span><i class="em em-bear"></i> Ad Soyad</span>
                            <span>{{$user->showName()}}</span>
                        </li>
                        <li>
                            <span><i class="em em-timer_clock"></i> Kayıt Tarihi</span>
                            <span>{{$user->created_at->format('d/m/Y')}}</span>
                        </li>
                        <li>
                            <span><i class="em em-feet"></i> Profil Ziyareti</span>
                            <span>{{$user->profile_view}}</span>
                        </li>
                        @if($user->role == 1)
                        <li>
                            <span><i class="em em-handshake"></i> Ticaret Puanı</span>
                            <span>{{$user->ticaretPuani()}}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    Test
                </div>
            </div>
        </div>
    </div>
@endsection
