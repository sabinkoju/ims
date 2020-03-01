@extends('admin.layouts.admin_design')

@section('title')  View All Examinee  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Examinee List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Exams</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View All Examinee</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">

                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <form method="post" action="{{route('viewResult')}}">
                                                @csrf
                                                <header>Exam : {{$course->name}} - {{$examid->exam_name}} </header>


                                                @if($errors->any())
                                                    <h4>{{$errors->first()}}</h4>
                                                @endif
                                                <input type="hidden" value="{{$examid->id}}" name="examid">

                                                <input type="hidden" value="{{$course->id}}" name="courseid">


                                                <div class="card-body " id="bar-parent">
                                                    <div class="row">
                                                        <div class="col-12">
                                                    <div class="pull-right">
                                                        <button href="{{route('viewResult')}}"  type="submit" class="btn btn-primary">Report </button>
                                                    </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                    <form method="post" action="{{route('changeresult')}}">
                                                        @csrf
                                                        <input type="hidden" value="{{$examid->id}}" name="examid">


                                                    <div class="row small-spacing">
                                                        <div class="col-md-4">
                                                            <label>Students Name</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label >Result </label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label >Remarks</label>
                                                        </div>
                                                    </div>

                                                    @foreach($student_courses as $student)

                                                        <div class="row small-spacing">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <select name="student_id[]"  class="form-control" data-validation="required"
                                                                            data-validation-error-msg="Select Course">
                                                                        <option  value="{{ $student->id }}" >{{$student->fname}} {{$student->lname}}</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <select name="result[]"  class="form-control" data-validation="required"
                                                                            data-validation-error-msg="Select Course">
                                                                        <option  value="1" >Pass</option>
                                                                        <option  value="0" >Fail</option>
                                                                        <option  value="3" >Absent</option>
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

                                            </form>


                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('css')
        <!-- data tables -->
            <link href="{{ asset('adminAssets/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    @section('scripts')
        <!-- data tables -->
            <script src="{{ asset('adminAssets/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('adminAssets/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('adminAssets/assets/js/pages/table/table_data.js') }}"></script>


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


            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
            </script>

            <script>
                @if(session('toast_error'))
                toastr.error("Attendance Has Been Already Submitted");
                @endif
            </script>





@endsection





