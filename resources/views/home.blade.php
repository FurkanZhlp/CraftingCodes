@extends('layouts.app')
@section('title', 'Ana Sayfa')
@section('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">MCSepeti</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Ürünler</a></li>
                            <li class="breadcrumb-item active">Öne Çıkanlar</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Öne Çıkan Ürünler</h4></div>
            </div>
        </div>
        <div class="row">
            @foreach($products as  $product)
            <div class="col-lg-3 ">
                <div class="card e-co-product mcs-product-div">
                    <a href=""><img src="{{$product->image()}}" alt="" class="img-fluid"></a>
                    <div class="card-body product-info">
                        <div style="max-height: 43px;height: 43px;overflow: hidden;">
                            <a class="product-title">{{$product->name}}</a>
                        </div>
                        <div>
                            <div style="display:flex;margin-top:5px;">
                                <img src="{{$product->owner->userImage()}}" alt="" class="thumb-sm rounded-circle mr-2">
                                <div style="">
                                    <b>{{$product->owner->username}}</b>
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
