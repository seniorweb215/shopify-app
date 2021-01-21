@extends('layouts.default')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        {{ $info }}    
    </div>
</div>
@endsection

@section('page_script')
<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('plugins/fullcalendar/fullcalendar-bundle.js') }}" defer></script>
<!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> -->
<!-- <script src="assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script> -->
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/dashboard.js') }}" defer></script>
<!--end::Page Scripts -->
@endsection
