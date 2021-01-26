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
                                <th>image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price(wholesale)</th>
                                <th>SKU</th>
                                <!-- total_quantity - approved quantity - order quantity -->
                                <th>Inventory</th>
                                <th>weight(kg)</th>
                                <th>Shipping cost</th>
                                <!-- <th>Shipping date</th> -->
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_list as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($data->file_path) }}" alt="" style="max-width: 40px;"></td>
                                    <td>{{ $data->title }}</td>
                                    <td class="table-max-column">{{ $data->description }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->SKU }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->weight }}</td>
                                    <td>{{ $data->shipping_cost }}</td>
                                    <td>{{ $data->category_name }}</td>
                                    <td>{{ $data->name }}</td>
                                    <!-- <td><span class="kt-badge  kt-badge--<?php echo $data->status == 1 ? 'success' : 'brand'; ?> kt-badge--inline kt-badge--pill">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span></td> -->
                                    <!-- <td>{{ date("Y-m-d", strtotime($data->created_at)) }}</td> -->
                                    <td>
                                        <a href="javascript:;" data-id="{{ $data->id }}" class="approve-item btn btn-sm btn-clean btn-icon btn-icon-md" title="Approve product"><i class="flaticon-list-3"></i></a>
                                        <a href="/retailer/product/show/{{ $data->id }}" class="view-item btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail view"><i class="fas fa-eye"></i></a> 
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
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Changes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden_id" value="">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="price" class="form-control-label">Price($):</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="col-md-4">
                        <label for="inventory" class="form-control-label">Inventory:</label>
                        <input type="text" class="form-control" id="inventory" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="form-control-label">Quantity:</label>
                        <input type="number" min="1" required="required" class="form-control" id="quantity" name="quantity">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-label">Description:</label>
                    <textarea class="form-control" id="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="tags" class="form-control-label">Tags:</label>
                    <textarea class="form-control" id="tags" placeholder="tag1, tag2, ..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn-confirm btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection

@section('page_script')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/product.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection