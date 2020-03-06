@extends('layouts.adminapp')
@section('title','TEST')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-gradient-primary px-4 btn-rounded float-right mt-0 mb-3">+ Yeni Ürün
                    </button>
                    <h4 class="header-title mt-0">Ürünleriniz</h4>
                    <div class="table-responsive dash-social">
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table dataTable no-footer" role="grid"
                                           aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Ürün adı</th>
                                                    <th></th>
                                                </tr><!--end tr-->
                                            </thead>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td></td>
                                                <td>
                                                    <a href="#" class="mr-2">
                                                        <i class="fas fa-edit text-info font-16"></i></a>
                                                        <a href="#"><i  class="fas fa-trash-alt text-danger font-16"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="datatable_info" role="status"
                                         aria-live="polite">Showing 1 to 6 of 6 entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="datatable_previous"><a href="#" aria-controls="datatable"
                                                                           data-dt-idx="0" tabindex="0"
                                                                           class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                                                            aria-controls="datatable"
                                                                                            data-dt-idx="1"
                                                                                            tabindex="0"
                                                                                            class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item next disabled" id="datatable_next">
                                                <a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0"
                                                   class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div>
    </div><!--end col-->

@endsection
