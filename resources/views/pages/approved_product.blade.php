@extends('layouts.default')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-history"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Approved product History
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <!--<a href="{{ route('product.create') }}" id="add_item" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Add New</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!--begin: Datatable -->
                <div class="kt-datatable" id="local_data" style="display: block;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Supplier</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>tags</th>
                                <th>date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_list as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td style="max-width: 350px">{{ $data->approved_description }}</td>
                                    <td>{{ $data->approved_price }}</td>
                                    <td>{{ $data->approved_quantity }}</td>
                                    <td>{{ $data->approved_tags }}</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable -->
            </div>
        </div>      
    </div>
</div>
@endsection

@section('page_script')
<!--begin::Page Scripts(used by this page) -->
<!--<script src="{{ asset('js/product.js  ') }}" defer></script>-->
<!--end::Page Scripts -->
@endsection