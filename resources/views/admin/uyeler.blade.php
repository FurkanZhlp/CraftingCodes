@extends('layouts.adminapp')
@section('title','Üyeler')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3">+ Yeni Üye</button>
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
                                <tr id="user{{$user->email}}">
                                    <th>{{$user->id}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.user',$user->id)}}" class=" mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="#" onclick="userDelete('{{$user->email}}')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
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
            var name = id;
            $.ajax({
                type:'POST',
                dataType:'Json',
                url:'/admin/ajax/user/delete',
                data:{id:name},
                success:function(data){
                    if(data.status == true)
                    {
                        swal.fire({
                            icon: 'success',
                            text: data.message
                        });
                        document.getElementById("user"+id).remove();
                    }
                    else
                        {
                        swal.fire({
                            icon: 'error',
                            text: data.message
                        });
                    }
                }
            });
        };

    </script>


@endsection
