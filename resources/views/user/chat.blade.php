@extends('layouts.app')
@section('title','Sohbet')
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
        .gelen-kutu
        {
            color:#000;
            font-weight: bolder;
            border-bottom: 5px solid black;
            text-align: center;
            cursor: pointer;
            padding-bottom: 15px;
            padding-top: 15px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom:0px;
        }
        .chat-row-body {
            max-height: calc(100vh - 195px);
            overflow-y: auto;
            }
            .chat-row-body .chat-row {
                cursor: pointer;
                height: 59px;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                border-bottom: 1px solid #eaedf2;
            }
            .chat-row-body .chat-row .isseen-div {
                 width: 6px;
                 height: 6px;
                 border-radius: 50%;
                 background-color: #e63262;
                 margin-left: 8px;
            }
            .chat-row-body .chat-row .isseen-empty-div
            {
                width: 14px;
            }
            .avatar-main .avatar-image {
                width: 44px;
                height: 44px;
                border-radius: 50%;
            }
            .avatar-main
            {
                position: relative;
                width: 44px;
                height: 44px;
                margin-left: 7px;
            }
            .user-name-main {
                margin-left: 10px;
            }
            .user-name-main .user-last-message {
                font-size: 12px;
                color: #939c9c;
                margin:0px;
                margin-top: 0px;
                width: 125px;
                overflow: hidden;
                height: 16px;
            }
            .user-name-main .user-name{
                font-size: 14px;
                color: #242424;
                margin:0px;
            }
            .last-seen-div {
                font-size: 12px;
                text-align: right;
                color: #939c9c;
                margin-left: auto;
                padding-right: 13px;
            }
            .chat-row-body::-webkit-scrollbar {
                width: 0px;
            }
            .message-user-title{
                font-size: 18px;
                font-weight: 500;
                text-align: left;
                color: #242424;
            }.fixed-div {
                 position: fixed;
                 display: -ms-flexbox;
                 display: flex;
                 -ms-flex-direction: row;
                 flex-direction: row;
                 max-width: 1170px;
                 width: 100vw;
                 height: 100%;
                 margin: auto;
             }
            .messages-body {
                padding: 18px 21px 18px 27px;
                max-height: calc(100vh);
                overflow-y: auto;
            }.seemorediv {
                 text-align: center;
                 padding-bottom: 14px;
             }
            .chattarih {
                text-align: left;
                border-bottom: 1px solid #dde3eb;
                line-height: .1em;
                margin-top: 40px;
                margin-bottom: 20px;
            }
            .messages-main {
                 position: relative;
                 margin-top: 10px;
             }
            .chatbubble.right {
                  font-size: 14px;
                  line-height: 1.43;
                  color: #242424;
                  background-color: #f6d8d8;
                  float: right;
                  border-radius: 7.5px;
                  border-bottom-right-radius: 0;
              }
        .chattime.right {
                   position: relative;
                   float: right;
                   font-size: 11px;
                   color: #939c9c;
                   margin-top: 5px;
                   margin-right: 5px;
               }.chatbuble-text {
                    font-size: 13px;
                }.chatbubble.left {
                     font-size: 14px;
                     line-height: 1.43;
                     color: #2d3740;
                     background-color: #e4e8ed;
                     float: left;
                     border-radius: 7.5px;
                     border-bottom-left-radius: 0;
                 }.chattime.left {
                      position: relative;
                      float: left;
                      font-size: 11px;
                      color: #939c9c;
                      margin-top: 5px;
                      margin-left: 50px;
                  }
                    .chatbubble {
                       position: relative;
                       max-width: 420px;
                       width: auto;
                       display: inline-block;
                       font-size: 14px;
                       margin-top: 5px;
                       line-height: 1.29;
                       padding: 8px 15px;
                   }.messages-body::-webkit-scrollbar {
                        width: 4px;
                        background-color: #fff;
                    }.messages-body::-webkit-scrollbar-thumb {
                         background-color: #4d79f6;
                     }
                    .send-input
                    {
                        height: 47px;
                        padding:8px;
                        border:0px;
                        width: 66.3%;
                    }
                    .send-input-right
                    {
                        height: 47px;
                        padding:8px;
                        border:0px;
                        width: 33.7%;
                        background-color: #dce0e5;
                    }
                    .chat-send-box
                    {
                        margin-left: 8px!important;
                        padding-right: 8px!important;

                    }
    </style>
    <div class="row fixed-div">
    <div class="col-md-4 p-0 border">
        <!--<div class="form-group">
            <div class="input-group">
                <span class="input-group-prepend">
                    <button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </span>
                <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
            </div>
        </div>-->
        <p class="gelen-kutu">Gelen Kutusu</p>
        <div class="chat-row-body">
            @foreach($conversations as $c)
            <div class="chat-row" onclick="window.location='{{route('chat',$c->chatWith->username)}}'" style="background-color: rgb(244, 245, 247); @if($c->lastMessage->isRead()) border-right: 3px solid rgb(230, 50, 98); @endif">
                <div class="isseen-div" style="display: none;"></div>
                <div class="isseen-empty-div"></div>
                <div class="avatar-main">
                    <img src="{{$c->chatWith->userImage()}}" class="avatar-image">
                </div>
                <div class="user-name-main">
                    <p class="user-name" style="color: rgb(36, 36, 36); font-weight: 500;">{{$c->chatWith->username}}</p>
                    <p class="user-last-message" style="color: rgb(147, 156, 156);">{{$c->lastMessage->message}}</p>
                </div>
                <div class="last-seen-div">
                    {{ Carbon\Carbon::parse($c->lastMessage->created_at)->diffForHumans()}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
        Swal.fire({
            title: 'Submit your Github username',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`//api.github.com/users/${login}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `İstek reddedildi: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: `${result.value.login}'s avatar`,
                    imageUrl: result.value.avatar_url
                })
            }
        })
    </script>
    @if(isset($chatUser))
    <div class="col-md-8 p-0">
        <div class="row">
            <div class="col-md-12 border border-left-0 p-3">
                <a href="#" class="message-user-title">{{$chatUser->username}}</a>
            </div>
            <script>
                $( document ).ready(function() {
                    var div = document.getElementById("pull");
                    div.scrollTop = div.scrollHeight - div.clientHeight;

                    function scrollSmoothToBottom (id) {
                        var div = document.getElementById(id);
                        $('#' + id).animate({
                            scrollTop: div.scrollHeight - div.clientHeight
                        }, 500);
                    }
                });
            </script>
            <div class="col-md-8 boder border-left-0 p-0">
                <div id="pull" class="messages-body boder border-left-0" style="height: calc(100vh - 244px);">
                    <div style="height: 0px; display: none;"></div>
                        <!---->
                    <!---->
                    @if(isset($chat->messages))
                    @foreach($chat->messages as $message)
                        @if($message->user_id == Auth::user()->id)
                        <div class="messages-main">
                            <div class="chatbubble-main" style="margin-top: 5px;">
                                <!---->
                                <div class="chatbubble right" style="max-width: 280px;"><span class="chatbuble-text">{{$message->message}}</span>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                                <div style="clear: both;"></div>
                                <div class="chattime right">13.03.20 01:18
                                </div>
                            </div>
                        </div>
                        @else
                        <!---->
                        <div class="messages-main">
                            <div class="chatbubble-main" style="margin-top: 5px;">
                                <div><img src="{{$chatUser->userImage()}}" style="width: 36px; height: 36px; border-radius: 50%; float: left; margin-right: 10px; margin-top: 5px;"></div>
                                <div class="chatbubble left" style="max-width: 280px;"><span class="chatbuble-text">{{$message->message}}</span>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                                <div style="clear: both;"></div>
                                <div class="chattime left">{{$message->created_at->format('d.m.Y h:i')}}
                                </div>
                            </div>
                        </div>
                        @endif
                    <div style="clear: both;"></div>
                    @endforeach
                    @else
                        <div class="messages-main">
                            <div class="chatbubble-main" style="margin-top: 5px;">
                                <!---->
                                <div class="chatbubble right" style="max-width: 280px;background-color: #c1e5dc;"><span class="chatbuble-text">Bu üye ile sohbet başlatmak için hemen mesaj gönder.</span>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                                <div style="clear: both;"></div>
                                <div class="chattime right">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                    <!---->
                    <!---->
            </div>
            <div class="col-md-4 border border-bottom-0 float-right" style="background-color: #dce0e5;">
                <ul class="list">
                    <center>
                        <img src="{{$chatUser->userImage()}}" style="width: 64px; height: 64px; border-radius: 50%;  margin-bottom:0px;margin-top: 7.5px;">
                        @if($chatUser->isOnline())
                            <i  data-toggle="tooltip" data-container="body" data-original-title="Çevrimiçi" style="margin-bottom: 0px;transform: translateY(-5px);"class="mdi mdi-circle d-block mt-n2 font-18 text-success"></i>
                        @else
                            <i  data-toggle="tooltip" data-container="body" data-original-title="Çevrimdışı" style="margin-bottom: 0px;transform: translateY(-5px);"class="mdi mdi-circle d-block mt-n2 font-18 text-muted"></i>
                        @endif
                        <h4 class="mt-0"><b>{{$chatUser->username}}</b></h4>
                        <b>Son Görülme;</b>
                        <p>{{$chatUser->lastSeen()}}</p>
                    </center>
                    <li>
                        <span><i class="em em-bear"></i> Ad Soyad</span>
                        <span>{{$chatUser->showName()}} </span>
                    </li>
                    <li>
                        <span><i class="em em-timer_clock"></i> Kayıt Tarihi</span>
                        <span>{{$chatUser->created_at->format('d/m/Y')}}</span>
                    </li>
                    <li>
                        <span><i class="em em-feet"></i> Profil Ziyareti</span>
                        <span>{{$chatUser->profile_view}}</span>
                    </li>
                    @if($chatUser->role == 1)
                        <li>
                            <span><i class="em em-handshake"></i> Ticaret Puanı</span>
                            <span>{{$chatUser->ticaretPuani()}}</span>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-12 p-0 chat-send-box" style="height: 100%;max-height: 159px;">
                <form id="sendMessage" class="sendMessage" method="post" action="{{route('chat',$chatUser->username)}}">
                    @csrf
                <input type="text" name="message" class="send-input" placeholder="Buraya birşeyler yaz...">
                </form>
                <div class="send-input-right float-right">

                </div>
            </div>
            <script>
                $('#sendMessage').on('submit', function(event)
                {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url:"{{route('chat',$chatUser->username)}}",
                        method:"POST",
                        data:formData,
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(data){
                            console.log(data);
                            if(data.status)
                            {
                                location.reload();
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>
    @endif
@endsection
