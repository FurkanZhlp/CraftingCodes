@extends('layouts.adminapp')
@section('title','Yönetici Paneli')
@section('content')
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0">Üyeler</h4>
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
                        <h4 class="title-text mt-0">New Orders</h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-pink">10k</h3>
                            <i class="dripicons-cart card-eco-icon bg-icon-pink align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>1.5%</span> Up From Last Week</p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0">Return Orders</h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-secondary">8400</h3>
                            <i class="dripicons-jewel card-eco-icon bg-icon-secondary align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i class="mdi mdi-trending-down"></i>3%</span> Down From Last Month</p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <h4 class="title-text mt-0">Revenue</h4>
                        <div class="d-flex justify-content-between">
                            <h3 class="text-warning">$1590</h3>
                            <i class="dripicons-wallet card-eco-icon bg-icon-warning  align-self-center"></i>
                        </div>
                        <p class="mb-0 text-muted text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>10.5%</span> Up From Yesterday</p>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
@endsection
