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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="setFullName">Adınız Soyadınız</label>
                                        <input type="text" class="form-control" onchange="showButtonUser();" value="Özhalep" id="setFullName" placeholder="Soyadınızı Giriniz">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="setEmail">Mail Adresiniz</label>
                                        <input type="email" class="form-control" onchange="showButtonUser();" value="furkanzhlp@hotmail.com" placeholder="Mail Adresinizi Giriniz" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="setPassword">Password</label>
                                        <input type="password" class="form-control" onchange="showButtonUser();" id="setPassword" placeholder="Password">
                                    </div>
                                    <button type="submit" id="set-btn" style="visibility:hidden;" class="btn btn-secondary btn-sm">Değişiklikleri Kaydet</button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="setEmail">Telefon Numaranız</label>
                                        <input type="phone" class="form-control" onchange="showButtonUser();" id="setEmail" placeholder="Telefon Numaranızı Giriniz">
                                    </div>
                                    <div class="form-group">
                                        <label for="setPassword">Password</label>
                                        <input type="password" class="form-control" onchange="showButtonUser();" id="setPassword2" placeholder="Password2">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function showButton()
                {
                    document.getElementById("notify-btn").style.visibility = "visible";
                }

                function submitNotifyForm()
                {
                    var data = $("#notify-form").serialize();

                    $.ajax({

                        type : 'POST',
                        url  : 'https://mcsepeti.com/ajax/updateNotify.php',
                        dataType: 'json',
                        data : data,
                        beforeSend: function()
                        {
                            $("#notify-btn").html("Lütfen bekleyiniz..");
                            $("#notify-btn").disabled = true;
                        },
                        success :  function(data)
                        {
                            document.getElementById("notify-btn").style.visibility = "hidden";
                            $("#notify-btn").html("Değişiklikleri kaydet");

                        }
                    });
                    return false;
                }
            </script>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 mb-3 header-title">Bildirimler</h4>
                        <div class="text-center">
                            <img src="../assets/images/widgets/notify.svg" alt="" class="mb-3" height="115">
                        </div>
                        <form id="notify-form">
                            <div class="custom-control custom-switch switch-success mb-2">
                                <input type="checkbox" name="mail" onchange="showButton();" class="custom-control-input" id="ICOnotify">
                                <label class="custom-control-label" for="ICOnotify">E-Posta ile beni yeniliklerden haberdar et</label>
                            </div>
                            <div class="custom-control custom-switch switch-success mb-2">
                                <input type="checkbox" name="discord" onchange="showButton();" class="custom-control-input" id="notyfySound">
                                <label class="custom-control-label" for="notyfySound">Discord ile bana bildirim gönder ( Discord bağlantısı gerektirir )</label>
                            </div>
                            <button type="button" id="notify-btn" onclick="submitNotifyForm();" style="visibility:hidden;" class="btn btn-secondary btn-sm">Değişiklikleri Kaydet</button>
                        </form>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div>


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
