@extends('layouts.adminapp')
@section('title','Yeni Ürün Ekle')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.products')}}" class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-0"><- Ürünler</a>
                    <h4 class="header-title mt-0">Ürün ekle</h4>
                    <form id="createForm" class="createForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-0 m-0">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ürün Adı</label>
                                    <input type="text" class="form-control" name="name" placeholder="Ürün Adı">
                                </div>
                                <div class="form-group">
                                    <label>Ürün Detayları</label>
                                    <textarea type="text" class="form-control" name="desc" placeholder="Uzun Açıklama"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ürün Fiyatı</label>
                                    <input type="number" class="form-control" min="1" name="price" placeholder="Fiyatı">
                                </div>
                                <div class="form-group">
                                    <label>İcon</label>
                                    <input type="file" class="form-control" min="1" name="image" placeholder="Fiyatı">
                                </div>
                            </div>
                            <button type="submit" class="newButton btn btn-block btn-gradient-primary">+ Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            $('#createForm').on('submit', function(event)
            {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('admin.newProduct') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function()
                    {
                        $(".is-invalid").removeClass('is-invalid');
                        $(".error").remove();
                        $(".invalid-feedback").remove();
                        $(".newButton").prop('disabled', true);
                        $(".newButton").html("Lütfen Bekleyiniz...");
                    },
                    success:function(data){
                        console.log(data.errors);
                        if(data.status)
                        {
                            location.href = "{{route('admin.vProduct','')}}/"+ data.slug;
                        }
                        $.each(data.errors, function(k, v) {
                            $("textarea[name="+k+"]").addClass('is-invalid');
                            $("input[name="+k+"]").addClass('is-invalid');
                            $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("input[name="+k+"]"));
                            $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("textarea[name="+k+"]"));
                        });
                        $(".newButton").prop('disabled', false);
                        $(".newButton").html("+ Ekle");
                    }
                });
            });
    </script>
@endsection
