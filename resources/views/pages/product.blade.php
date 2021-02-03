@extends('layouts.default')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        All Products
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('product.create') }}" id="add_item" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Add New</a>
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
                                <th>Description</th>
                                <th>Price(wholesale)</th>
                                <th>SKU</th>
                                <!-- inventory = register - order quantity -->
                                <th>Inventory</th>
                                <!-- inventory - approved quantity -->
                                <th>Not approved</th>
                                <th>weight(kg)</th>
                                <th>Shipping cost</th>
                                <!-- <th>Shipping date</th> -->
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_list as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td class="table-max-column">{{ $data->description }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->SKU }}</td>
                                    <td>{{ $data->total_quantity }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->weight }}</td>
                                    <td>{{ $data->shipping_cost }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td><span class="kt-badge  kt-badge--<?php echo $data->status == 1 ? 'success' : 'brand'; ?> kt-badge--inline kt-badge--pill">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                    <!-- <td>{{ date("Y-m-d", strtotime($data->created_at)) }}</td> -->
                                    <td>
                                        <a href="/supplier/product/edit/{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details"><i class="la la-edit"></i></a>
                                        <a href="javascript:;" data-id="{{ $data->id }}" class="delete-item btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a> 
                                    </td>
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
<script src="{{ asset('js/product.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection