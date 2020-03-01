@extends('admin.layouts.admin_design')

@section('title') Student Attendance  - Institute Management System (IMS) @endsection

@section('content')



    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Attendance Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Attendance Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form action="{{ route('storeAttendanceStudent') }}" method="post">
                    @csrf
                <div class="card card-box">
                    <div class="card-head" style="margin-top: 10px !important; line-height: 50px !important;">
                        <?php $date = date('Y-m-d', time()); ?>
                        <header>Date Today:  {{ $date }}</header>



                            <div class="pull-right">

                            <div class="col-md-12">
                                <input type="text" class="form-control" id="datepicker"
                                       placeholder="Select Date" name="date" data-validation="required"
                                       data-validation-error-msg="Please Select Date"  value="{{ $date }}" >
                            </div>

                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                        </div>
                    </div>

                    @if(Session::has('flash_message_alert'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {!! session('flash_message_alert') !!}

                        </div>
                    @endif

                    <div class="card-body " id="bar-parent">

                        <div class="row small-spacing">
                            <div class="col-md-4">
                                <label>Student Name</label>
                            </div>
                            <div class="col-md-4">
                                <label >Attendance</label>
                            </div>

                            <div class="col-md-4">
                                <label >Remarks</label>
                            </div>
                        </div>

                        @foreach($students as $student)


                       <div class="row small-spacing">
                           <div class="col-md-4">
                               <div class="form-group">
                                   <select name="student_id[]"  class="form-control" data-validation="required"
                                           data-validation-error-msg="Select Course">
                                       <option  value="{{ $student->id }}" >{{ $student->fname . $student->lname }}</option>

                                   </select>
                               </div>
                           </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   <select name="attendance[]"  class="form-control" data-validation="required"
                                           data-validation-error-msg="Select Course">
                                       <option  value="Present" >Present</option>
                                       <option  value="Absent" >Absent</option>
                                       <option  value="Excused" >Excused</option>
                                   </select>
                               </div>
                           </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   <input type="text" name="remarks[]" class="form-control" placeholder="Remarks">
                               </div>
                           </div>
                       </div>

                            @endforeach

                        <div class="pull-right">
                            <button  type="submit" class="btn btn-primary">Submit </button>
                        </div>

                    </div>
                </div>
                </form>
            </div>

        </div>

    </div>

    @endsection


@section('css')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection


@section('scripts')

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