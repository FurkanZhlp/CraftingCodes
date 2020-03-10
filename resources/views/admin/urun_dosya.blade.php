@extends('layouts.adminapp')
@section('title','Dosyalar '.$product->name)
@section('content')
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="files-nav">
                            <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                                <a class="nav-link mb-0" href="#" data-toggle="modal" data-animation="bounce" data-target="#new">
                                    <span class="mr-3 text-warning d-inline-block">➕</span>
                                    <div class="d-inline-block align-self-center">
                                        <h5 class="m-0">Yeni</h5>
                                        <small>Yeni Sürüm Oluştur</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->

                <div class="card">
                    <div class="card-body">
                        <div class="text-center pb-2 mb-2 border-bottom">
                            <img style="width:64px;height:64px;" src="{{ url('/storage/products/'.$product->image) }}" alt="{{$product->slug}}" title="">
                            <h6 class="mt-0">{{$product->name}}</h6>
                        </div>
                        <h6 class="mt-0">Toplam {{$product->download}} kez indirildi</h6>
                        <div class="progress mb-4" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$product->download}}%;" aria-valuenow="{{$product->download}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @foreach($product->versions as $version)
                            <div class="text-muted">
                                {{$version->version}} -> {{$version->download}} indirme
                            </div>
                        @endforeach
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-9">
                <div class="">
                    <div class="tab-content" id="files-tabContent">
                        <div class="tab-pane fade show active" id="files-projects">
                            <h4 class="header-title mt-0 mb-3">{{$product->name}} sürümleri</h4>

                            @if($product->versions->count() < 1)
                                <div class="alert alert-info">
                                    Henüz hiç sürüm bulunmamakta.
                                </div>
                            @endif
                            <div class="file-box-content">
                                @foreach($product->versions as $version)
                                <div class="file-box">
                                    <a href="{{route('admin.downloadVersion',$version->id)}}" class="download-icon-link">
                                        <i class="dripicons-download file-download-icon"></i>
                                    </a>
                                    <div class="text-center">
                                        <i class="far fa-file-archive text-warning"></i>
                                        <h6 class="text-truncate">{{$version->version}}</h6>
                                        <small class="text-muted">{{$version->formatSize()}}</small><br>
                                        <small class="text-muted">{{$version->created_at}}</small>
                                        <div class="custom-control custom-switch switch-success">
                                            <input type="checkbox" onchange="changeStatus('{{$version->id}}')" class="custom-control-input" disabled id="customSwitchSuccess{{$version->id}}" @if($version->status) checked @endif>
                                            <label class="custom-control-label" for="customSwitchSuccess{{$version->id}}">Durumu</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>  <!--end tab-content-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yeni Sürüm Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Sürüm Adı</label>
                                <input type="text" name="version" class="form-control" placeholder="Sürüm Adı">
                            </div>
                            <div class="form-group">
                                <label>İndirilebilir İçerik</label>
                                <input type="file" name="file" class="form-control" accept=".rar" placeholder="Dosya">
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="newButton btn btn-block btn-primary">
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
            $('#createForm').on('submit', function(event)
            {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('admin.vProduct',$product->slug) }}",
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
                        console.log(data);
                        if(data.status)
                        {
                            location.reload();
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
