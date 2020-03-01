@extends('admin.layouts.admin_design')

@section('title')  Add New Teacher  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        	 @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New Teacher</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add New Teacher</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New Teacher Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Enter Name" name="name" data-validation="length"
                                           data-validation-length="3-400" value="{{old('name')}}"
                                           data-validation-error-msg="Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="email">Email address</label>
                                    <input type="email" class="form-control" id="email"value="{{old('email')}}"
                                           placeholder="Enter E-mail Address" data-validation="email" name="email">
                                </div>
                                <p id="emailExists" style="color: red; display: none">Email Already Exists In Our Database</p>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Select Teacher Category</label>
                                    <select name="category" id="category" class="form-control" data-validation="required" value="{{old('category')}}"
                                            data-validation-error-msg="Select Teacher Category">
                                        <option selected disabled="">Select Teacher Category</option>
                                        @foreach($category as $data)
                                            <option value="{{ $data->id }}">{{ $data->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="timing">Select Time</label>
                                    <select name="timing" id="timing" class="form-control" data-validation="required" value="{{old('timing')}}"
                                            data-validation-error-msg="Select Time">
                                        <option selected disabled="">Select Timing </option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
                                    </select>
                                </div>
                            </div>





                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shift">Please Select Course
                                    </label>
                                    <select id="shift" class="form-control select2-multiple" name="course_id[]" multiple data-validation="required" value="{{old('shift')}}"
                                            data-validation-error-msg="At Least a course is required">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch_id">Please Select Batch
                                        </label>
                                        <select id="batch_id" class="form-control select2-multiple" name="batch_id[]" multiple data-validation="required"
                                                data-validation-error-msg="At Least a Batch is required">
                                            @foreach($batches as $batch)
                                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                    <input type="number" class="form-control" id="phone" value="{{old('number')}}"
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

                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="checkbox" id="Usercheck" name="usercheck"  checked>
                                    <span>Register For User</span>
                                </div>
                            </div>






                            <button onclick="checkUserEmail()" type="submit" class="btn btn-primary">Add New Teacher</button>

                            <a href="{{ route('viewAllTeachers') }}" class="btn btn-info">View All</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('css')

    <link href="{{asset('adminAssets/assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection




@section('scripts')


    <script src="{{asset('adminAssets/assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('adminAssets/assets/js/pages/select2/select2-init.js')}}"></script>

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



            $(document).ready(function() {
                $('.select2-multiple').select2({
                    placeholder: 'Please Choose Course'
                });

                $('.select2-multiple').select2({
                    placeholder: 'Please Choose Batch'
                });


        });
    </script>
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

    <script>
        @if(session('toast_error'))
        toastr.error("E-Mail Has Been Already Taken");
        @endif
    </script>
@endsection
