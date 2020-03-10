@extends('layouts.adminapp')
@section('title',$user->name)
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
                                            <img src="{{$user->userImage()}}" style="width: 128px;height: 128px;" alt="" class="rounded-circle">
                                            <span class="fro-profile_main-pic-change" onclick="chooseFile();">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                            <div style="height:0px;overflow:hidden">
                                                <input type="file" name="upload_image" id="upload_image" accept="image/x-png,image/jpeg" />
                                            </div>
                                        </div>
                                        <div class="met-profile_user-detail">
                                            <h5 class="met-user-name">{{$user->name}}</h5>
                                            <p class="mb-0 met-user-name-post">{{'@'.$user->username}}</p>
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


            <div id="uploadimageModal" class="modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="mx-auto">
                                    <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success crop_image">Kırp & Resmi yükle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>

                function chooseFile() {
                    $("#upload_image").click();
                }
                $(document).ready(function(){

                    var $image_crop = $('#image_demo').croppie({
                        enableExif: true,
                        viewport: {
                            width:128,
                            height:128,
                            type:'circle' //circle
                        },
                        boundary:{
                            width:300,
                            height:300
                        }
                    });

                    $('#upload_image').on('change', function(){
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            $image_crop.croppie('bind', {
                                url: event.target.result
                            }).then(function(){
                                console.log('jQuery bind complete');
                            });
                        }
                        reader.readAsDataURL(this.files[0]);
                        $('#uploadimageModal').modal('show');
                    });

                    $('.crop_image').click(function(event){
                        $image_crop.croppie('result', {
                            type: 'canvas',
                            size: 'viewport'
                        }).then(function(response){
                            $.ajax({
                                url:"{{route('admin.user',$user->id)}}",
                                type: "PUT",
                                dataType: 'Json',
                                data:{"_token": "{{ csrf_token() }}","image": response},
                                success:function(data)
                                {
                                    if(data.status)
                                    {
                                        $('#uploadimageModal').modal('hide');
                                        $('#uploaded_image').html(data);
                                        location.reload();
                                    }
                                    else
                                    {
                                        $('#upload_image').value = "";
                                        Swal.fire(
                                            'Hata!',
                                            'Bir hata oluştu lütfen daha sonra tekrar deneyiniz.',
                                            'error'
                                        )
                                    }
                                }
                            });
                        })
                    });

                });
            </script>
@endsection
