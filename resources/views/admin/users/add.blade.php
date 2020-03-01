@extends('admin.layouts.admin_design')

@section('title')  Add New User  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New Users</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add New User</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New User Details</header>


                    </div>

                    <div class="col-md-8">
                        @if(Session::has('flash_message_error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {!! session('flash_message_error') !!}

                            </div>
                        @endif
                    </div>


                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id">Select Role</label>
                                    <select name="role_id" id="role_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select User Role">
                                        <option selected disabled="">Select User Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Enter name" name="name" data-validation="length" value="{{old('name')}}"
                                               data-validation-length="3-400"
                                               data-validation-error-msg="Name is required (3-50 chars)">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" value="{{old('email')}}"
                                               placeholder="Enter email address" data-validation="email" name="email">
                                    </div>
                                    <p id="emailExists" style="color: red; display: none">Email Already Exists In Our Database</p>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" value="{{old('address')}}"
                                               placeholder="Enter Address" name="address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" value="{{old('phone')}}"
                                               placeholder="Enter Phone Number" name="phone" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="hidden" name="current_image">
                                        <input type="file" class="form-control" id="image"
                                               name="image" data-validation="mime size"
                                               data-validation-allowing="jpg, png"
                                               data-validation-max-size="1024kb"
                                               data-validation-error-msg-required="Please Upload User Image">
                                    </div>
                                </div>





                            <button onclick="checkUserEmail()" type="submit" class="btn btn-primary">Add New User</button>

                            <a href="{{ route('viewAllUsers') }}" class="btn btn-info">View All</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection



@section('css')
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') }}">
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

    <script>
        function checkUserEmail() {
            var email = $("#email").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               type: 'post',
               url: '{{ route('checkUserEmail') }}',
                data: { email:email},
                success: function (resp) {
                   if( resp == "exists"){
                       $("#emailExists").show();
                   }
                }, error: function () {
                    alert("Error");
                }
            });
        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

    <script>
        @if(session('toast_error'))
        toastr.error("E-Mail Has Been Already Taken");
        @endif
    </script>
@endsection