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
                                Edit Product
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <a href="{{ route('product') }}" class="btn btn-clean btn-icon-sm">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form" method="POST" action="/supplier/product/update/{{ $row[0]->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            @if ($errors->any())
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="alert alert-solid-danger alert-bold" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li class="alert-text">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">Product Name<span class="required-field">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Product Name" value="{{ $row[0]->title }}" required="required">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Price(Wholesale)<span class="required-field">*</span></label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price(Wholesale)" value="{{ $row[0]->price }}" required="required">    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="note">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{ $row[0]->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">SKU</label>
                                    <input type="text" class="form-control" id="SKU" name="SKU" placeholder="SKU" value="{{ $row[0]->SKU }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Quantity<span class="required-field">*</span></label>
                                    <input type="number" class="form-control" min="1" id="quantity" name="quantity" placeholder="Quantity" value="{{ $row[0]->quantity }}" required="required">    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">Weight(Kg)</label>
                                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="{{ $row[0]->weight }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Shipping Cost</label>
                                    <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" placeholder="Shipping Cost" value="{{ $row[0]->shipping_cost }}">
                                </div>
                            </div>
                            <div class="form-group row form-group-last">
                                <div class="col-md-6">
                                    <label>Image</label>
                                    <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                        <div class="kt-avatar__holder" style="background-image: url({{ asset($row[0]->file_path) }})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="file" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" {{ $row[0]->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $row[0]->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="save-product btn btn-primary">Save Product</button>
                                <a href="{{ route('product') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div> 
        </div>
    </div>
</div>
@endsection

@section('page_script')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/ktavatar.js') }}" defer></script>
<script src="{{ asset('js/product.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection