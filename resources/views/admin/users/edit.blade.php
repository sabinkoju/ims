@extends('admin.layouts.admin_design')

@section('title')  Edit User  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit User</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit User</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Update User Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="{{ route('editUser', $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id">Select Role</label>
                                    <select name="role_id" id="role_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select User Role">
                                        <option selected disabled="">Select User Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Enter name" name="name" data-validation="length"
                                               data-validation-length="3-400"
                                               data-validation-error-msg="Name is required (3-50 chars)" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email"
                                               placeholder="Enter email address" data-validation="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>

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

                                <div class="col-md-6">
                                    <label for="image">Image</label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="current_image" value="{{ $user->image }}">
                                        <input type="file" class="form-control" id="image"
                                               name="image" data-validation="mime size"
                                               data-validation-allowing="jpg, png"
                                               data-validation-max-size="1024kb"
                                               data-validation-error-msg-required="Please Upload User Image">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">
                                               <a data-toggle="modal" data-target="#imageModal"> <i class="fa fa-eye"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>











                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-body">
                        @if(!empty($user->image))
                        <img src="{{ asset('uploads/profile/'.$user->image) }}" alt="{{ $user->name }}" height="200px" width="auto">
                            @else
                            <img src="{{ asset('uploads/profile/profile.png') }}" alt="{{ $user->name }}" height="200px" width="auto">
                            @endif
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