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
                        All Suppliers
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!--begin: Datatable -->
                <div class="kt-datatable" id="supplier_list_table" style="display: block;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company name</th>
                                <th>Company address</th>
                                <th>description</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($list as $key => $data)
                                @if ($data->sender == Auth::user()->id || $data->sender == '')
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($data->photo_path) }}" alt="" style="width: 60px;"></td>
                                        <?php 
                                            if ($data->status == 1) {
                                        ?>
                                            <td><a href="/retailer/suppliers/getCategories/{{ $data->id }}">{{ $data->name }}</a></td>
                                        <?php
                                            } else {
                                        ?>
                                            <td>{{ $data->name }}</td>
                                        <?php } ?>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->company_name }}</td>
                                        <td>{{ $data->company_address }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>{{ date("Y-m-d", strtotime($data->created_at)) }}</td>
                                        <?php 
                                            if ($data->sender == '') {
                                                $msg = "Sending Request";
                                                $cla = "info";
                                            } else if ($data->status == 0) {
                                                $msg = "Waiting";
                                                $cla = "warning";
                                            } else if ($data->status == 1) {
                                                $msg = "Approved";
                                                $cla = "success";
                                            } else {
                                                $msg = "Declined";
                                                $cla = "danger";
                                            }
                                        ?>
                                        <td><span data-id="{{ $data->id }}" class="kt-badge  kt-badge--{{ $cla }} kt-badge--inline kt-badge--pill">{{ $msg }}</span></td>
                                    </tr>
                                @endif
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
<script src="{{ asset('js/request.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection