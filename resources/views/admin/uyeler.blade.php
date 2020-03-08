@extends('layouts.adminapp')
@section('title','Üyeler')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button data-toggle="modal" data-target="#new" class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3">+ Yeni Üye</button>
                    <h4 class="header-title mt-0">Üyeleriniz</h4>
                    <div class="table-responsive dash-social">
                        <table id="datatable" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mail Adresi</th>
                                <th>Adı Soyadı</th>
                                <th>Kayıt Tarihi</th>
                                <th>İşlem</th>
                            </tr><!--end tr-->
                            </thead>

                            <tbody>
                            @foreach($users as  $user)
                                <tr id="user{{$user->id}}">
                                    <th>{{$user->id}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.user',$user->id)}}" class=" mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="#" onclick="userDelete('{{$user->id}}')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            @if($users->count() < 1)
                                <div class="alert alert-info">
                                    Henüz hiç üyeniz bulunmamakta.
                                </div>
                            @endif
                        </table>
                    </div>
                    <div class="row d-flex justify-content-center">
                            {{ $users->links() }}
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function userDelete(id)
        {
            swal.fire({
                title: 'Emin misin?',
                text: "Bunu geri almak için şansın olmayacak!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Hayır',
                confirmButtonText: 'Evet,hemen sil'
            }).then((result) => {
                if (result.value) {
                    var name = id;
                    $.ajax({
                        type: 'POST',
                        dataType: 'Json',
                        url: '{{route('admin.deleteUser')}}',
                        data: {id: name},
                        success: function (data) {
                            if (data.status == true) {
                                swal.fire({
                                    icon: 'success',
                                    text: data.message
                                });
                                document.getElementById("user" + id).remove();
                            } else {
                                swal.fire({
                                    icon: 'error',
                                    text: data.message
                                });
                            }
                        }
                    });
                }
            });
        };
        function newUser()
        {
            var name = $("input[name=name]").val();
            var password = $("input[name=password]").val();
            var email = $("input[name=email]").val();
            $.ajax({
                type:'POST',
                dataType:'Json',
                url:'{{route('admin.newUser')}}',
                data:{name:name, password:password, email:email},
                beforeSend:function(){
                    $("input[name=name]").removeClass('is-invalid');
                    $("input[name=password]").removeClass('is-invalid');
                    $("input[name=email]").removeClass('is-invalid');
                    $(".error-name").remove();
                    $(".error-password").remove();
                    $(".error-email").remove();
                    $(".newButton").prop('disabled', true);
                    $(".newButton").html("Lütfen Bekleyiniz...");
                },
                success:function(data){
                    if(data.status)
                    {
                        location.reload();
                    }
                    console.log(data.errors);
                    $.each(data.errors, function(k, v) {
                        $("input[name="+k+"]").addClass('is-invalid');
                        $("<div class='error-"+k+" help-block invalid-feedback'>"+v+"</div>").insertAfter($("input[name="+k+"]"));
                    });
                    $(".newButton").prop('disabled', false);
                    $(".newButton").html("+ Ekle");
                }
            });
        };
    </script>
    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Kayıt Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="new-form">
                        <div class="form-group">
                            <label for="setFullName">Adı Soyadı</label>
                            <input type="text" name="name" class="form-control" id="setFullName" placeholder="Adı Soyadı">
                        </div>
                        <div class="form-group">
                            <label for="setFullName">Mail Adresi</label>
                            <input type="text" name="email" class="form-control" id="setEmailAdress" placeholder="Mail Adresi">
                        </div>
                        <div class="form-group">
                            <label for="setFullName">Şifre</label>
                            <input type="text" name="password" class="form-control" id="setPassword" placeholder="Şifresi">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button onclick="newUser()" type="button" class="newButton btn btn-block btn-primary">
                                    + Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
