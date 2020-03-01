@extends('admin.layouts.admin_design')

@section('title')  Site Settings  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Site Settings </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Site Settings</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Update Your Site Information</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="{{ route('updateSiteSettings', $site->id) }}" enctype="multipart/form-data">
                            @csrf


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control" id="company_name"
                                                       placeholder="Enter name" name="company_name" value="{{ $site->company_name }}" data-validation="length"
                                                       data-validation-length="3-400"
                                                       data-validation-error-msg="Company Name is required (3-50 chars)">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="short_name">Short Name</label>
                                                <input type="text" class="form-control" id="short_name"
                                                       placeholder="Enter name" name="short_name" value="{{ $site->short_name }}" >
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tagline">Company Tagline</label>
                                                <input type="text" class="form-control" id="tagline"
                                                       placeholder="Enter name" name="tagline" value="{{ $site->tagline }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="logo">Company Logo</label>
                                                <input type="hidden" name="current_image" value="{{ $site->logo }}">
                                                <input type="file" class="form-control" id="logo"
                                                       name="logo" data-validation="mime size"
                                                       data-validation-allowing="jpg, png"
                                                       data-validation-max-size="500kb"
                                                       data-validation-error-msg-required="Please Upload Company Logo">
                                            </div>
                                            @if($site->logo != "NULL")
                                                <div id="@if($site->logo != "NULL") logoSite @endif">
                                                    <img src="{{ asset('uploads/site/'.$site->logo) }}" alt="" width="200px">
                                                </div>

                                                @endif
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="favicon">Fav Icon</label>
                                                <input type="hidden" name="current_image2" value="{{ $site->favicon }}">
                                                <input type="file" class="form-control" id="favicon"
                                                       name="favicon" data-validation="mime size"
                                                       data-validation-allowing="jpg, png"
                                                       data-validation-max-size="500kb"
                                                       data-validation-error-msg-required="Please Upload Fav Icon">
                                            </div>
                                            @if($site->favicon != "NULL" )
                                                <div id="@if($site->favicon != "NULL") favicon @endif">
                                                    <img src="{{ asset('uploads/site/'.$site->favicon) }}" alt="" width="50px" >
                                                </div>
                                                @else

                                                @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       placeholder="Enter email address" value="{{ $site->email }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address"
                                                       placeholder="Enter Address" name="address" value="{{ $site->address }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control" id="phone"
                                                       placeholder="Enter Phone Number" name="phone" value="{{ $site->phone }}">
                                            </div>
                                        </div>


                                    </div>

                                </div>






                            <button type="submit" class="btn btn-primary">Update Site Settings</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection




@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script>
        $.validate({
            lang: 'en',
            modules: 'file',
        });

    </script>

    <script src="{{ asset('adminAssets/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/js/jquery.sweet-alert.custom.js') }}"></script>
    <script type="text/javascript">
        @if(session('flash_message'))
        swal("Success!", "{!! session('flash_message') !!}", "success")
        @endif

        @if(session('flash_error'))
        swal("Error", "{!! session('flash_error') !!}")
        @endif
    </script>

@endsection