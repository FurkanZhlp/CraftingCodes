@extends('layouts.adminapp')
@section('title','Yönetici Paneli')
@section('content')
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0"><a href="{{route('admin.users')}}">Üyeler</a></h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-purple">{{\App\User::all()->count()}}</h3>
                            <i class="dripicons-user-group card-eco-icon bg-icon-purple align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate"><span class="text-success">{{App\User::whereDate('created_at', DB::raw('CURDATE()'))->get()->count()}}</span> bügün kayıt olan</p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0"><a href="{{route('admin.products')}}">Ürünler</a></h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-pink">{{\App\Product::all()->count()}}</h3>
                            <i class="dripicons-cart card-eco-icon bg-icon-pink align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate"><span class="text-success">{{\App\Product::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get()->count()}}</span> bu ay oluşturulan</p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0">Return Orders</h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-secondary">₺8400</h3>
                            <i class="dripicons-jewel card-eco-icon bg-icon-secondary align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate">⠀
                        </p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0">Gelirler</h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-warning">₺1590</h3>
                            <i class="dripicons-wallet card-eco-icon bg-icon-warning  align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate">⠀
                        </p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
@endsection
