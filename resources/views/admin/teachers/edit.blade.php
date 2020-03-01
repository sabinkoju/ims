@extends('admin.layouts.admin_design')

@section('title')  Edit Teachers  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Teachers</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Teachers</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Update Teachers Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="{{ route('editTeachers', $teachers->id) }}" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Enter name" name="name" data-validation="length"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Name is required (3-50 chars)" value="{{ $teachers->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email"
                                           placeholder="Enter email address" data-validation="email" name="email" value="{{ $teachers->email }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Select Teacher Category</label>
                                    <select name="category" id="category" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Teacher Category">
                                        <option value="{{ $teachers->teacher_category_id }}" selected  hidden>{{ $teachers->teacher_category->cat_name }}</option>
                                        @foreach($category as $data)
                                            <option value="{{ $data->id }}">{{ $data->cat_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="timing">Select Time</label>
                                    <select name="timing" id="timing" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Time">
                                        <option value="{{ $teachers->timing}}" selected  hidden>{{ $teachers->timing }} </option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
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
                                            <option value="{{ $course->id }}" {{ in_array($course->id, $course_teacher) ? 'selected' : '' }}>{{ $course->name }}</option>
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
                                            <option value="{{ $batch->id }}"{{in_array( $batch->id,$teacher_batch)? 'selected' : '' }}>{{$batch->batch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address"
                                           placeholder="Enter Address" name="address" value="{{ $teachers->address }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone"
                                           placeholder="Enter Phone Number" name="phone" value="{{ $teachers->phone }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="image">Image</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="current_image" value="{{ $teachers->image }}">
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

                                    <input type="checkbox" id="Usercheck" name="usercheck"  checked>
                                    <span>Register For User</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Teachers</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-body">
                        @if(!empty($teachers->image))
                            <img src="{{ asset('uploads/profile/'.$teachers->image) }}" alt="{{ $teachers->name }}" height="200px" width="auto">
                        @else
                            <img src="{{ asset('uploads/profile/profile.png') }}" alt="{{ $teachers->name }}" height="200px" width="auto">
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

        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: 'Please Choose Course'
            });
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
