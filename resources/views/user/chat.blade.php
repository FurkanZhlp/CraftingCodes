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
            <div class="chat-row" style="background-color: rgb(244, 245, 247); border-right: 3px solid rgb(230, 50, 98);">
                <div class="isseen-div" style="display: none;"></div>
                <div class="isseen-empty-div"></div>
                <div class="avatar-main">
                    <img src="{{Auth::user()->userImage()}}" class="avatar-image">
                </div>
                <div class="user-name-main">
                    <p class="user-name" style="color: rgb(36, 36, 36); font-weight: 500;">{{Auth::user()->username}}</p>
                    <p class="user-last-message" style="color: rgb(147, 156, 156);">{{$c->message}}</p>
                </div>
                <div class="last-seen-div">
                    1 ay
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-8 p-0">
        <div class="row">
            <div class="col-md-12 border border-left-0 p-3">
                <a href="#" class="message-user-title">{{Auth::user()->username}}</a>
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
                    <div class="loader" style="width: 26px; height: 26px; text-align: center; margin: 0px auto; display: none;"></div>
                        <!---->
                    <!---->
                    @for($i=0;$i<=15;$i++)
                    <div class="messages-main">
                        <div class="chatbubble-main" style="margin-top: 5px;">
                            <!---->
                            <div class="chatbubble right" style="max-width: 280px;"><span class="chatbuble-text">Mesaj deneme</span>
                                <!---->
                                <!---->
                                <!---->
                            </div>
                            <div style="clear: both;"></div>
                            <div class="chattime right">13.03.20 01:18
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <!---->
                    <div class="messages-main">
                        <div class="chatbubble-main" style="margin-top: 5px;">
                            <div><img src="{{Auth::user()->userImage()}}" style="width: 36px; height: 36px; border-radius: 50%; float: left; margin-right: 10px; margin-top: 5px;"></div>
                            <div class="chatbubble left" style="max-width: 280px;"><span class="chatbuble-text">Mesaj deneme 2</span>
                                <!---->
                                <!---->
                                <!---->
                            </div>
                            <div style="clear: both;"></div>
                            <div class="chattime left">13.03.20 01:20
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    @endfor
                </div>
                    <!---->
                    <!---->
            </div>
            <div class="col-md-4 border border-bottom-0 float-right" style="background-color: #dce0e5;">
                <ul class="list">
                    <center>
                        <img src="http://craftingcodes.test/storage/users/1.png" style="width: 128px; height: 128px; border-radius: 50%;  margin-bottom:7.5px;margin-top: 7.5px;">

                        <h3>{{Auth::user()->username}}</h3>
                    </center>
                    <li>
                        <span><i class="em em-bear"></i> Ad Soyad</span>
                        <span>Fu Ya Ö </span>
                    </li>
                    <li>
                        <span><i class="em em-timer_clock"></i> Kayıt Tarihi</span>
                        <span>12/03/2020</span>
                    </li>
                    <li>
                        <span><i class="em em-feet"></i> Profil Ziyareti</span>
                        <span>69</span>
                    </li>
                    <li>
                        <span><i class="em em-handshake"></i> Ticaret Puanı</span>
                        <span>{{Auth::user()->ticaretPuani()}}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 p-0 chat-send-box" style="height: 100%;max-height: 159px;">
                <input type="text" class="send-input" placeholder="Buraya birşeyler yaz...">
                <div class="send-input-right float-right">

                </div>
            </div>
        </div>
    </div>
@endsection
