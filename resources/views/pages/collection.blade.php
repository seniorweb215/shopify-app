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
                        All Categories
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('category.create') }}" id="add_item" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Add New</a>
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
                                <th>Name</th>
                                <th>Collection Name</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_list as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="/supplier/category/edit/{{ $data->id }}">{{ $data->category_name }}</a></td>
                                    <td>{{ $data->collection_name }}</td>
                                    <td>{{ $data->note }}</td>
                                    <td><span class="kt-badge  kt-badge--<?php echo $data->status == 1 ? 'success' : 'brand'; ?> kt-badge--inline kt-badge--pill">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                    <td>{{ date("Y-m-d", strtotime($data->created_at)) }}</td>
                                    <td>
                                        <a href="/supplier/category/edit/{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details"><i class="la la-edit"></i></a>
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
<script src="{{ asset('js/collection.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection
