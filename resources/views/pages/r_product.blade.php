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
                        <a href="/retailer/suppliers/getCategories/{{ $sup_id }}" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-pricing-1 kt-pricing-1--fixed product-grid">
                    <div class="kt-pricing-1__items row">
                        @foreach($data_list as $key => $data)
                            <div class="kt-pricing-1__item col-lg-3">
                                <div class="kt-pricing-1__visual">
                                    <div class="img-wrapper">
                                        <img src="{{ asset($data->file_path) }}" alt="" style="width: 100%;">
                                    </div>
                                </div>
                                <h2 class="kt-pricing-1__subtitle">{{ $data->title }}</h2>
                                <span class="kt-pricing-1__price">{{ $data->price }}<span class="kt-pricing-1__label">$</span></span>
                                <div class="kt-pricing-1__btn">
                                    <!-- <button type="button" class="btn btn-brand btn-wide btn-bold btn-upper">Get For Free</button> -->
                                    <a href="javascript:;" data-id="{{ $data->id }}" class="approve-item btn btn-brand btn-wide btn-bold btn-upper" title="Approve product">Approve</a>
                                    <a href="/retailer/product/show/{{ $data->id }}" class="view-item btn btn-success btn-wide btn-bold btn-upper" title="Detail view">Detail view</a> 
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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