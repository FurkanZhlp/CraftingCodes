@extends('layouts.app')
@section('title', 'Giriş Yap')
@section('content')
        <div class="row mb-4"></div>
        <div class="row">
            @foreach($products as  $product)
            <div class="col-lg-3 col-sm-6">
                <div class="card e-co-product mcs-product-div">
                    <a href="#"><img src="{{$product->image()}}" alt="" class="img-fluid"></a>
                    <div class="card-body product-info">
                        <div style="max-height: 43px;height: 43px;overflow: hidden;">
                            <a href="#" class="product-title">{{$product->name}}</a>
                        </div>
                        <div>
                            <div style="display:flex;margin-top:5px;">
                                <a href="{{$product->owner->profile()}}"><img src="{{$product->owner->userImage()}}" alt="" class="thumb-sm rounded-circle mr-2"></a>
                                <div style="">
                                    <b><a href="{{$product->owner->profile()}}">{{$product->owner->username}}</a></b>
                                    <p style="margin-bottom:0px;">{{$product->category->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%; height: 1px; background-color: rgb(223, 228, 236); margin-top: 12px;"></div>

                        <div class="d-flex justify-content-between my-2">
                            <p class="product-price">{{$product->price}} TL</p>
                            <!--
                            <ul class="list-inline mb-0 product-review align-self-center">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i><b class="text-warning">5.0</b> (1)</li>
                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
@endsection
