@extends('layouts.default')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row category-action">
            <div class="col-md-6 align-center">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit collection: {{ $row[0]->category_name }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <a href="{{ route('category') }}" class="btn btn-clean btn-icon-sm">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form" method="POST" action="/supplier/category/update/{{ $row[0]->id }}">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label for="name">Collection Name<span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Collection Name" value="{{ $row[0]->category_name }}" required="required">
                            </div>
                            
                            <div class="form-group">
                                <label for="note">Collection Note</label>
                                <textarea class="form-control" id="note" name="note" placeholder="Collection Note" rows="3">{{ $row[0]->note }}</textarea>
                            </div>
                            <div class="form-group form-group-last">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $row[0]->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $row[0]->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Save Collection</button>
                                <a href="{{ route('category') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-md-4 align-center">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Products
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <a href="javascript:;" id="add_product" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Browse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <div class="kt-datatable" id="selected_product_table" style="display: block;">
                            <table class="table">
                                <tbody>
                                    @if (isset($selected) && !empty($selected))
                                        @foreach($selected as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($data->file_path) }}" alt="" style="max-width: 40px;"></td>
                                            <td>{{ $data->title }}</td>
                                            <!-- <td><span class="kt-badge  kt-badge--<?php echo $data->status == 1 ? 'success' : 'brand'; ?> kt-badge--inline kt-badge--pill">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span></td> -->
                                            <td>
                                                <a href="javascript:;" data-id="{{ $data->id }}" class="delete-product btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a> 
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="text-align: center;">empty</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
                <!--end::Portlet-->
            </div> 
        </div>
    </div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="products_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden_id" value="{{ $row[0]->id }}">
                <div class="kt-datatable" id="local_data" style="display: block;">
                    <table class="table">
                        <tbody>
                            @if (isset($products) && !empty($products))
                                @foreach($products as $key => $product)
                                <tr>
                                    <td><input type="checkbox" class="check-box" data-id="{{ $product->id }}" <?php echo in_array($product->id, $arr_ids) ? 'checked' : ''; ?>></td>
                                    <td><img src="{{ asset($product->file_path) }}" alt="" style="max-width: 40px;"></td>
                                    <td>{{ $product->title }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td style="text-align: center;">empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn-confirm btn btn-primary">Done</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection

@section('page_script')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/collection.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection