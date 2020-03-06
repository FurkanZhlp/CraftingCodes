@extends('layouts.adminapp')
@section('title','TEST')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body  met-pro-bg">
                        <div class="met-profile">
                            <div class="row">
                                <div class="col-lg-8 align-self-center">
                                    <div class="met-profile-main">
                                        <div class="met-profile-main-pic">
                                            <img src="../assets/images/users/user-10.jpg" alt="" class="rounded-circle">
                                            <span class="fro-profile_main-pic-change">
                                                            <i class="fas fa-camera"></i>
                                                        </span>
                                        </div>
                                        <div class="met-profile_user-detail">
                                            <h5 class="met-user-name">{{$user->name}}</h5>
                                            <p class="mb-0 met-user-name-post">{{$user->email}}</p>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end f_profile-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="setFullName">Adı Soyadı</label>
                                <input type="text" class="form-control" id="setFullName" placeholder="Adı Soyadı" value="{{$user->name}}">
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="setEmail">Mail Adresi</label>
                                <input type="email" class="form-control" id="setEmail" placeholder="Mail Adresi" value="{{$user->email}}">
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="setPassword">Password</label>
                                <input type="password" class="form-control" id="setPassword" placeholder="Password">
                            </div><!--end form-group-->
                            <button type="submit" class="btn btn-gradient-secondary btn-sm">Save Change</button>
                        </form> <!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
@endsection
