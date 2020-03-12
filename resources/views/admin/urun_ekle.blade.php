@extends('layouts.adminapp')
@section('title','Yeni Ürün Ekle')
@section('head')

    <link href="{{url('admin/assets/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
    <script src="{{url('admin/assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{url('admin/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
@endsection
@section('content')
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <style>
        .form-control {
            border-radius: 2px;
            font-size: 18px;
            font-family: Poppins;
            font-weight: 500;
            color: #2d3640;
            border: 1px solid #bfc8d2;
            padding: 0 8px 0 25px;
            height: 77px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
        }
        textarea.form-control
        {
            font-size:14px;
            padding:15px;
            height:auto;
        }
        .title
        {
            font-size: 24px;
            font-weight: bolder;
            color: #2d3640;
            margin-bottom: 14px;
            font-family: Poppins;
        }
        .sub-title
        {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.44;
            color: #6a7685;
            font-family: Poppins;
        }

    </style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="createForm" class="createForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <p class="title">Hizmetini Hangi Kategoride Sunmak İstiyorsun ?</p>
                            <p class="sub-title">Başlangıcımızı yapalım, 😎 hizmetini sunmak istediğin kategoriyi seç;</p>
                            <select class="form-control" name="categoryid">
                                <option>Bir kategori seçme vakti..</option>
                                @foreach(\App\ProductCategory::where('parent_id','=','0')->orderBy('priority')->get() as  $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if($category->childs->isNotEmpty())
                                    @foreach($category->childs as $child)
                                        <option value="{{$child->id}}">⠀
                                            ⠀
                                            {{$child->name}}</option>
                                    @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="title">Sırada başlığımız var 🚀</p>
                            <p class="sub-title">İlgi çekici bir başlıkla müşterilerinin dikkatini toplaman gerekiyor</p>
                            <input name="name" maxlength="50" type="text" class="form-control" placeholder="Örn; Yeni Nesil Skyblock Plugin Paketi">
                        </div>
                        <div class="form-group">
                            <p class="title">Kaç para istiyorsun? 💸</p>
                            <p class="sub-title">En sevdiğimiz kısıma geldik 😅 ürününün fiyatını belirleme vakti</p>
                            <input type="number" name="price" class="form-control" placeholder="Örn; 50TL" min="10" max="999">
                        </div>
                        <div class="form-group">
                            <p class="title">Detaylandırma sırası 📑</p>
                            <p class="sub-title">Ee tabi müşterilerine detaylı bir anlatım yapman gerekiyor değilmi :)</p>
                            <small>Bu alanda HTML ve CSS ({{"<style><\style>"}}) kodlarını kullanabilirsiniz.</small>
                            <textarea rows="5" name="desc" class="form-control" placeholder="Örn; Yeni Nesil Skyblock Plugin Paketi"></textarea>
                        </div>
                        <div class="form-group">
                            <p class="title">Olmazsa olmaz resim</p>
                            <p class="sub-title">Ürününe bir kapak 🖼️ fotoğrafı güzel gitmezmiydi peki ?</p>

                            <div class="row">
                                <div class="mx-auto" style="display:none;" id="resim">
                                    <div id="image_urun" style="width:350px; margin-top:30px"></div>
                                </div>
                            </div>
                            <input type="file" name="image" id="upload_image" class="dropify" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-xl newButton">+ Oluştur</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            $('#createForm').on('submit', function(event)
            {
                var formData = new FormData(this);
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response)
                {
                    event.preventDefault();
                    formData.append('imagecrop',response);
                    $.ajax({
                        url:"{{ route('admin.newProduct') }}",
                        method:"POST",
                        data:formData,
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
                            console.log(data);
                            if(data.status)
                            {
                                location.href = "{{route('admin.vProduct','')}}/"+ data.slug;
                            }
                            $.each(data.errors, function(k, v) {
                                $("textarea[name="+k+"]").addClass('is-invalid');
                                $("input[name="+k+"]").addClass('is-invalid');
                                $("select[name="+k+"]").addClass('is-invalid');
                                $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("input[name="+k+"]"));
                                $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("select[name="+k+"]"));
                                $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("textarea[name="+k+"]"));
                            });
                            $(".newButton").prop('disabled', false);
                            $(".newButton").html("+ Ekle");
                        }
                    });
                });
            });

            $(function () {
                // Basic
                var image = $('.dropify').dropify({
                    messages: {
                        default: 'Sürükle bırak veya tıklayarak resim yükle',
                        replace: 'Sürükle bırak veya tıklayarak resimi değiştir',
                        remove:  'Sil',
                        error:   'Hata'
                    }
                });
                image.on('dropify.beforeClear', function(event, element){
                    return confirm("Resimi kaldırmak istediğine eminmisin ?");
                });
                image.on('dropify.afterClear', function(event, element){
                    var x = document.getElementById("resim");
                    x.style.display = "none";
                    return true;
                });
            });


            $(document).ready(function() {
                $image_crop = $('#image_urun').croppie({
                    enableExif: true,
                    viewport: {
                        width: 258 ,
                        height: 120,
                        type: 'square' //circle
                    },
                    boundary: {
                        width: 320,
                        height: 320
                    }
                });
                $('#upload_image').on('change', function () {
                    var x = document.getElementById("resim");
                    x.style.display = "block";
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $image_crop.croppie('bind', {
                            url: event.target.result
                        }).then(function () {
                            console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#uploadimageModal').modal('show');
                });
            });


            $('input[name=name]').maxlength({
                alwaysShow: true,
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger",
                separator: '/',
                preText: '',
                postText: '',
                validate: true
            });
    </script>
@endsection
