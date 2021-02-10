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
                                Edit Profile: {{ $row[0]->name }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                           
                        </div>
                    </div>
                    <!--begin::Form-->
                    @if (Auth::user()->type == 1)
                        <?php $link_snippet = "supplier"; ?>
                    @else
                        <?php $link_snippet = "retailer"; ?>
                    @endif
                    <form class="kt-form" method="POST" action="/{{ $link_snippet }}/profile/update/{{ $row[0]->user_table_id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <input type="hidden" id="id" name="id" value="{{ $row[0]->id }}">
                            <div class="form-group">
                                <label for="name">Name<span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $row[0]->name }}" required="required">
                            </div>
                            <div class="form-group">
                                <label for="name">Email<span class="required-field">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $row[0]->email }}" required="required">
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Company Name<span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="{{ $row[0]->company_name }}" required="required">
                            </div>
                            <div class="form-group">
                                <label for="note">Company Address</label>
                                <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" value="{{ $row[0]->company_address }}">
                            </div>
                            <div class="form-group">
                                <label for="note">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{ $row[0]->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                    <div class="kt-avatar__holder" style="background-image: url({{ asset($row[0]->photo_path) }})"></div>
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change photo">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="file" accept=".png, .jpg, .jpeg">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel photo">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
<!--end::Page Scripts -->
@endsection