@extends('admin.layouts.admin_design')

@section('title')  Attendance Report  - Institute Management System (IMS) @endsection

@section('content')



    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Attendance Report</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Attendance Report</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form action="{{ route('viewReport') }}" method="post">
                    @csrf
                    <div class="card card-box">
                        <div class="card-head" style="margin-top: 10px !important; line-height: 50px !important;">
                            <?php $date = date('Y-m-d', time()); ?>
                            <header>Date Today:  {{ $date }}</header>


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
                                    <label>Date</label>
                                </div>
                                <div class="col-md-4">
                                    <label >User Type</label>
                                </div>

                                <div class="col-md-4">
                                    <label >Search</label>
                                </div>
                            </div>


                                <div class="row small-spacing">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="datepicker"
                                                   placeholder="Select Date" name="date" data-validation="required"
                                                   data-validation-error-msg="Please Select Date"  >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="role_id"  class="form-control" data-validation="required"
                                                    data-validation-error-msg="Select User Type">
                                                <option disabled selected>Select a User Type</option>
                                                @foreach($roles as $role)
                                                <option  value="{{ $role->id }}" >{{ $role->name }}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button  type="submit" class="btn btn-primary">Generate Report </button>

                                        </div>
                                    </div>
                                </div>




                            @if(isset($staff))
                                @if(!empty($staff))
                            <div class="row small-spacing">
                                <div class="col-md-4">
                                    <label>Date</label>
                                </div>
                                <div class="col-md-4">
                                    <label >Name</label>
                                </div>

                                <div class="col-md-4">
                                    <label >Attendance Details</label>
                                </div>
                            </div>


                            @foreach($staff as $data)
                            <div class="row small-spacing">
                                
                                <div class="col-md-4">
                                    <input type="text" value="{{ $data->date }}" class="form-control" disabled="">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" value="{{ $data->user->name }}" class="form-control" disabled>
                                </div>

                                <div class="col-md-4">
                                    @if($data->attendance == "Present")
                                    <span class="label label-rouded label-menu label-success" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                        @else
                                        <span class="label label-rouded label-menu label-danger" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                    @endif
                                </div>
                            </div>
                                    <br>
                                @endforeach
                                    @endif
                                @endif



                            @if(isset($teacher))
                                @if(!empty($teacher))
                                    <div class="row small-spacing">
                                        <div class="col-md-4">
                                            <label>Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label > Teacher Name</label>
                                        </div>

                                        <div class="col-md-4">
                                            <label >Attendance</label>
                                        </div>
                                    </div>


                                    @foreach($teacher as $data)
                                        <div class="row small-spacing">

                                            <div class="col-md-4">
                                                <input type="text" value="{{ $data->date }}" class="form-control" disabled="">
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" value="{{ $data->teacher->name }}" class="form-control" disabled>
                                            </div>

                                            <div class="col-md-4">
                                                @if($data->attendance == "Present")
                                                    <span class="label label-rouded label-menu label-success" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @elseif($data->attendance  == "Absent")
                                                    <span class="label label-rouded label-menu label-danger" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @else
                                                    <span class="label label-rouded label-menu label-primary" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @endif
                            @endif



                            @if(isset($student))
                                @if(!empty($student))
                                    <div class="row small-spacing">
                                        <div class="col-md-3">
                                            <label>Date</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label >Name</label>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Course</label>
                                        </div>

                                        <div class="col-md-3">
                                            <label >Attendance</label>
                                        </div>




                                    </div>


                                    @foreach($student as $data)
                                        <div class="row small-spacing">

                                            <div class="col-md-3">
                                                <input type="text" value="{{ $data->date }}" class="form-control" disabled="">
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" value="{{ $data->student->fname . $data->student->lname }}" class="form-control" disabled>
                                            </div>



                                            <div class="col-md-3">
                                                <input type="text" value="{{ $data->course_id }}" class="form-control" disabled="">
                                            </div>

                                            <div class="col-md-3">
                                                @if($data->attendance == "Present")
                                                    <span class="label label-rouded label-menu label-success" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @elseif($data->attendance == "Absent")
                                                    <span class="label label-rouded label-menu label-danger" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @else
                                                    <span class="label label-rouded label-menu label-primary" style="float: left; height: 30px !important; width: 139px; line-height: 20px; margin-top: 3px; border-radius: 0px">{{ $data->attendance }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @endif
                            @endif

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