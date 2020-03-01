@extends('admin.layouts.admin_design')

@section('title')  Update Student  - Institute Management System (IMS) @endsection

@section('content')
<div class="page-content">
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Edit Student</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                       href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Edit Student</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Update Student Details</header>


                </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" value="{{$student->fname}}"
                                           placeholder="Enter First Name" name="fname" data-validation="length"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" value="{{$student->lname}}"
                                           placeholder="Enter Last Name" name="lname" data-validation="length"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Last Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Select Student Gender</label>
                                    <select name="gender" id="gender" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Student Gender">
                                        <option value="{{ $student->gender}}" selected hidden>{{ $student->gender}}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="dob">Date Of Birth</label>
                                    <input type="date" class="form-control" id="datepicker" value="{{$student->dob}}"
                                           placeholder="Enter Date Of Birth" name="dob" data-validation="required"
                                           data-validation-error-msg="Select Student Date Of Birth">
                                </div>

                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" value="{{$student->email}}"
                                           placeholder="Enter E-mail Address" data-validation="email" name="email">
                                </div>
                                <p id="emailExists" style="color: red; display: none">Email Already Exists In Our Database</p>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_category_id">Select Student Category</label>
                                    <select name="student_category_id" id="student_category_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Student Category">
                                        <option selected hidden value="{{$student->student_category_id}}">{{@$student->student_category->name}}</option>
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
                                        <option selected hidden value="{{$student->batch_id}}">{{@$student->batches->batch_name}}</option>
                                        @foreach($batch as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                                        <option selected hidden value="{{$student->section_id}}">{{@$student->sections->section_name}}</option>
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
                                            <option value="{{ $course->id }}" {{ in_array($course->id, $course_student) ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" value="{{$student->address}}"
                                           placeholder="Enter Address" name="address">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control" id="phone" value="{{$student->phone}}"
                                           placeholder="Enter Phone Number" name="phone" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="image">Image</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="current_image" value="{{ $student->image }}">
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" id="Usercheck" name="usercheck" @if( $student->ifuser == 1) checked @endif>
                                    <span>Register For User</span>
                                </div>
                            </div>



                            <button onclick="checkUserEmail()" type="submit" class="btn btn-primary">Update Student</button>

                            <a href="{{ route('viewStudent') }}" class="btn btn-info">View All</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-body">
                @if(!empty($student->image))
                    <img src="{{ asset('uploads/profile/'.$student->image) }}" alt="{{ $student->name }}" height="200px" width="auto">
                @else
                    <img src="{{ asset('uploads/profile/profile.png') }}" alt="{{ $student->name }}" height="200px" width="auto">
                @endif
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
