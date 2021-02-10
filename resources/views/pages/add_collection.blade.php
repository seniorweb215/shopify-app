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
                                Add a new collection
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
                    <form class="kt-form" method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label for="name">Collection Name<span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Collection Name" value="" required="required">
                            </div>
                            <div class="form-group">
                                <label for="note">Collection Note</label>
                                <textarea class="form-control" id="note" name="note" placeholder="Collection Note" rows="3"></textarea>
                            </div>
                            <div class="form-group form-group-last">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
        </div>
    </div>
</div>
@endsection

@section('page_script')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/collection.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection