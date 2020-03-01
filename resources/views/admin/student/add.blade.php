@extends('admin.layouts.admin_design')

@section('title')  Add New Student  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add New Student</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add New Student</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New Student Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname"
                                           placeholder="Enter First Name" name="fname" data-validation="length" value="{{old('fname')}}"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname"
                                           placeholder="Enter Last Name" name="lname" data-validation="length" value="{{old('lname')}}"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Last Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Select Student Gender</label>
                                    <select name="gender" id="gender" class="form-control" data-validation="required" value="{{old('gender')}}"
                                            data-validation-error-msg="Select Student Gender">
                                        <option selected disabled="">Select Student Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="dob">Date Of Birth</label>
                                    <input type="text" class="form-control" id="datepicker"
                                           placeholder="Enter Date Of Birth" name="dob" data-validation="required" value="{{old('dob')}}"
                                           data-validation-error-msg="Select Student Date Of Birth">
                                </div>

                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="email">Email address</label>
                                    <input type="email" class="form-control" id="email"
                                           placeholder="Enter E-mail Address"  value="{{old('email')}}" data-validation="email" name="email">
                                </div>
                                <p id="emailExists" style="color: red; display: none">Email Already Exists In Our Database</p>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_category_id">Select Student Category</label>
                                    <select name="student_category_id" id="student_category_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Student Category">
                                        <option selected disabled="">Select Student Category</option>
                                        @foreach($category as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch_id">Select Batch</label>
                                    <select name="batch_id" id="batch_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Batch">
                                        <option selected disabled="">Select Batch</option>
                                        @foreach($batch as $data)
                                            <option value="{{ $data->id }}">{{ $data->batch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch_id">Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Section">
                                        <option selected disabled="">Select Section</option>
                                        @foreach($section as $data)
                                            <option value="{{ $data->id }}">{{ $data->section_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shift">Please Select Course
                                    </label>
                                    <select id="shift" class="form-control select2-multiple" name="course_id[]" multiple data-validation="required"
                                            data-validation-error-msg="At Least a course is required">

                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                                           data-validation-max-size="1024kb" value="{{old('image')}}"
                                           data-validation-error-msg-required="Please Upload User Image">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="checkbox" id="Usercheck" name="usercheck"  checked>
                                    <span>Register For User</span>
                                </div>
                            </div>





                            <button onclick="checkUserEmail()" type="submit" class="btn btn-primary">Add New Student</button>

                            <a href="{{ route('viewStudent') }}" class="btn btn-info">View All</a>

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

@endsection




@section('scripts')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                maxDate: 0,
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
        } );
    </script>



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


        });
    </script>
@endsection
