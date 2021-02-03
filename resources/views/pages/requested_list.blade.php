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
                        All Requests
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!--begin: Datatable -->
                <div class="kt-datatable" id="Request_table" style="display: block;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($list as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ date("Y-m-d", strtotime($data->created_at)) }}</td>
                                    <?php 
                                        if ($data->status == 0) {
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
                                    <td><span class="kt-badge  kt-badge--{{ $cla }} kt-badge--inline kt-badge--pill">{{ $msg }}</span></td>
                                    <td class="actions">
                                        <?php
                                            if ($data->status == 0) {
                                        ?>
                                            <a href="javascript:;" data-id="{{ $data->id }}" receive-type-id="1" class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approve</a>
                                            <a href="javascript:;" data-id="{{ $data->id }}" receive-type-id="2" class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Decline</a>
                                        <?php
                                            } else if($data->status == 1) {
                                        ?>
                                            <a href="javascript:;" data-id="{{ $data->id }}" receive-type-id="2" class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Decline</a>
                                        <?php
                                            }
                                        ?>
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
<script src="{{ asset('js/request.js  ') }}" defer></script>
<!--end::Page Scripts -->
@endsection