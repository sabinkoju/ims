@extends('admin.layouts.admin_design')

@section('title')  Add New Invoice  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ (isset($data)?'Update':'Add New') }} Invoice</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ (isset($data)?'Update':'Add New') }} Invoice</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>{{ (isset($data)?'Update':'New') }} Invoice Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                    @if(isset($data))
                        <form method="post" action="{{ route('invoice.update',$data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        @else
                        <form method="post" action="{{ route('invoice.store') }}" enctype="multipart/form-data">
                            @csrf
                        @endif
                            <div class="row">
                                <div class="col-md-6">

                                <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="student name">Student Name
                                        </label>
                                            <select id="student_id" class="form-control" name="student_id"  data-validation="required"
                                                    data-validation-error-msg="At Least a Student is required">
                                                    @if(isset($data) && !empty($data))
                                                    <option  selected hidden>{{$students[0]->fname}} {{$students[0]->lname}}</option>
                                                  
                                                    @else
                                                     
                                                    <option selected hidden>Please Select Student</option>
                                                    @endif 

                                                @foreach($students as $student)
                                                <option value="{{$student->id}}">{{$student->fname}} {{$student->lname}}</option>
                                                   @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="coursefees">Please Select Course
                                        </label>
                                            <select id="coursefees" class="form-control" name="course_name"  data-validation="required"
                                                    data-validation-error-msg="Please Select Course">
                                                    <option selected hidden>Please Select Course  </option>
                                                  
                                                @foreach($courses as $course)
                                                <option value="{{ $course->name }}" data-fees="{{ $course->fees }}">{{ $course->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fees">Fees </label>
                                            <input type="number" class="form-control" id="fees"
                                                   placeholder="Enter Fees" name="course_fee" data-validation="required"
                                                   data-validation-error-msg="Fee is required">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description </label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>

                                  
                                    <button  type="submit" class="btn btn-primary">{{ (isset($data)?'Update':'Add New') }} Invoice</button>
                                    <a href="{{ route('invoice.index') }}" class="btn btn-danger">Go Back</a>
                                </div>
                            </div>

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

    <script type="text/javascript">
       $("#coursefees").change(function () {
            var fees=$(this).find(':selected').data("fees");
            $("#fees").val(fees);
       });
</script>




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

        $('.select2-shift').select2({
            placeholder: 'Please Choose Shifts'
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

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <script>
    $(document).ready(function() {
       $('#description').summernote({
           'height' : 130
       });
    });
    </script>



@endsection


