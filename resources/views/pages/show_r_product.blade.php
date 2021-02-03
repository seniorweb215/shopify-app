@extends('layouts.default')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row category-action">
            <div class="col-md-8 align-center">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                View Product
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <a href="{{ url()->previous() }}" class="btn btn-clean btn-icon-sm">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                                &nbsp;
                                <div class="dropdown dropdown-inline">
                                    <a href="javascript:;" id="approve_item" data-id="{{ $row[0]->id }}" class="btn btn-brand btn-icon-sm"><i class="flaticon2-check-mark"></i> Approve Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-datatable" id="local_data" style="display: block;">
                            <table class="table">
                                <tbody>
                                    <tr><td><strong>Title: </strong>{{ $row[0]->title }}</td></tr>
                                    <tr><td><strong>Supplier: </strong>{{ $row[0]->name }}</td></tr>
                                    <tr><td><strong>Description: </strong>{{ $row[0]->description }}</td></tr>
                                    <tr><td><strong>Price: </strong>{{ $row[0]->price }}</td></tr>
                                    <tr><td><strong>SKU: </strong>{{ $row[0]->SKU }}</td></tr>
                                    <tr><td><strong>Quantity: </strong>{{ $row[0]->quantity }}</td></tr>
                                    <tr><td><strong>weight(kg): </strong>{{ $row[0]->weight }}</td></tr>
                                    <tr><td><strong>Shipping cost: </strong>{{ $row[0]->shipping_cost }}</td></tr>
                                    <td><strong>Status: </strong><span class="kt-badge  kt-badge--<?php echo $row[0]->status == 1 ? 'success' : 'brand'; ?> kt-badge--inline kt-badge--pill">{{ $row[0]->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                    <tr><td><strong>Image: </strong><img src="{{ asset($row[0]->file_path) }}" alt="" style="max-width: 600px;"></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
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