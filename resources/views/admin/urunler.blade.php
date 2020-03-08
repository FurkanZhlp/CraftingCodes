@extends('layouts.adminapp')
@section('title','Ürünler')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.newProduct')}}" class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3">+ Yeni Ürün</a>
                    <h4 class="header-title mt-0">Ürünleriniz</h4>
                    <div class="table-responsive dash-social">
                        <table id="datatable" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ürün Adı</th>
                                <th>Fiyatı</th>
                                <th>Sahibi</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                                <th>İşlem</th>
                            </tr><!--end tr-->
                            </thead>

                            <tbody>
                            @foreach($products as  $product)
                                <tr>
                                    <th>{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->owner->email}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>{{$product->updated_at}}</td>
                                    <td>
                                        <a href="{{route('admin.product',$product->id)}}" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            @if($products->count() < 1)
                                <div class="alert alert-info">
                                    Henüz hiç ürününüz bulunmamakta.
                                </div>
                            @endif
                        </table>
                    </div>
                    <div class="row d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->
@endsection
