@extends('layouts.adminapp')
@section('title','Yeni Ürün Ekle')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.products')}}" class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3"><- Ürünler</a>
                    <h4 class="header-title mt-0">Ürün ekle</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
