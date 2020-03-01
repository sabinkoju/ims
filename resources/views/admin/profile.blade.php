@extends('admin.layouts.admin_design')

@section('title')  My Profile {{ auth()->user()->name }} - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">My Profile - {{ auth()->user()->name }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">My Profile</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Update Your Profile Information</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="{{ route('updateProfile', $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="email" value="{{ $user->email }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Enter name" name="name" value="{{ $user->name }}" data-validation="length"
                                               data-validation-length="3-400"
                                               data-validation-error-msg="Name is required (3-50 chars)">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email"
                                               placeholder="Enter email address" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address"
                                               placeholder="Enter Address" name="address" value="{{ $user->address }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone"
                                               placeholder="Enter Phone Number" name="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="hidden" name="current_image" value="{{ $user->image }}">
                                            <input type="file" class="form-control" id="image"
                                                   name="image" data-validation="mime size"
                                                   data-validation-allowing="jpg, png"
                                                   data-validation-max-size="1024kb"
                                                   data-validation-error-msg-required="Please Upload User Image">
                                        </div>
                                    </div>
                            </div>





                            <button type="submit" class="btn btn-primary">Update Profile</button>
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