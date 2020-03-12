@extends('layouts.adminapp')
@section('title','Kategoriler')
@section('head')
    <link href="{{url('admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
@endsection
@section('content')

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <button data-toggle="modal" data-target="#new" class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3">+ Yeni Kategori</button>
                    </div>
                    <h4 class="page-title">Kategoriler</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion" id="Customers_collapse">
                    @foreach($categories as  $category)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-lg-flex justify-content-between collapsed">
                                <div class="media mb- mb-lg-0">
                                    <div style="height:32px;width:32px;background-color:{{$category->color}};" class="mr-3 thumb-md align-self-center rounded-circle" alt="..."></div>
                                    <div class="media-body align-self-center">
                                        <h5 style="cursor: pointer;" class="mt-0 mb-1"  data-toggle="collapse" href="#parent{{$category->id}}" role="button" aria-expanded="false" aria-controls="#parent{{$category->id}}">
                                            {{$category->name}} @if($category->childs->isNotEmpty())<i class="mdi mdi-chevron-down"></i>@endif
                                        </h5>
                                        <p class="text-muted mb-0"><i class="fas fa-list mr-2 text-info"></i>{{$category->childs->count()}} Alt Kategori </p>
                                    </div><!--end media body-->
                                </div> <!--end media-->
                                <p class="text-muted mb-2 mb-lg-0 align-self-center"><i class="fas fa-calendar mr-2 text-info font-14"></i>{{$category->created_at}}</p>
                                <p class="text-muted mb-2 mb-lg-0 align-self-center"><a href="#"><i class="fas fa-edit mr-2 text-info font-14"></i></a></p>
                            </div>
                            @if($category->childs->isNotEmpty())
                            <div class="collapse" id="parent{{$category->id}}" data-parent="#Customers_collapse" style="">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="page-title">Alt Kategoriler</h4>
                                        <div class="table">
                                            <table class="table">
                                                <tbody>
                                                @foreach($category->childs as $child)
                                                    <tr id="user{{$child->id}}">
                                                        <td><b>{{$child->name}}</b></td>
                                                        <td style="width: 150px;">{{$child->created_at}}</td>
                                                        <td style="width:30px;">
                                                            <a href="{{route('admin.user',$child->id)}}" class=" mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><!--end /table-->
                                        </div><!--end /tableresponsive-->
                                    </div><!-- end col-->
                                </div><!--end row-->
                            </div><!--end collapse-->
                            @endif
                        </div><!--end card-body-->
                    </div><!--end card-->
                    @endforeach
                </div><!--end Customers_collapse-->
            </div><!--end col-->
        </div><!--end row-->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function newCategory()
        {
            var name = $("input[name=name]").val();
            var parent_id = $("select[name=parent_id]").val();
            var color = $("input[name=color]").val();
            var priority = $("input[name=priority]").val();
            $.ajax({
                type:'POST',
                dataType:'Json',
                url:'{{route('admin.categories')}}',
                data:{name:name, parent_id:parent_id, color:color,priority:priority},
                beforeSend:function(){
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
                        location.reload();
                    }
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
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Kategori Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="new-form">
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" name="name" class="form-control" id="setFullName" placeholder="Kategori Adı">
                        </div>
                        <div class="form-group">
                            <label>Üst Kategorisi</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Anasayfa</option>
                                @foreach($categories as  $category)
                                    <option value="{{$category->id}}">-> {{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Önceliği ( Düşük Olan Önce Çıkar )</label>
                            <input type="text" name="priority" class="form-control" placeholder="Kategori Önceliği">
                        </div>
                        <div class="form-group">
                            <label>Kategori Rengi</label>

                            <div id="b_color-default" class="input-group" title="Using input value">
                                <input name="color" type="text" class="form-control input-lg" value="#f5a416"/>
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button onclick="newCategory()" type="button" class="newButton btn btn-block btn-primary">
                                    + Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#b_color-default').colorpicker();
        });
    </script>
@endsection
