@extends('admin.layouts.admin_design')

@section('title')  View All Courses  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Courses List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Course</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View All Courses</li>
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
                                            <header>All Courses List</header>

                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('addCourse') }}" id="addRow"
                                                           class="btn btn-info" style="margin-right: 10px;">
                                                            Add New  <i class="fa fa-plus"></i>
                                                        </a>


                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group pull-right">
                                                        <a class="btn deepPink-bgcolor  btn-outline dropdown-toggle"
                                                           data-toggle="dropdown">Tools
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{ route('printCourse') }}">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('generatePDF') }}">
                                                                    <i class="fa fa-file-pdf-o"></i> Save as
                                                                    PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('exportCourse') }}">
                                                                    <i class="fa fa-file-excel-o"></i>
                                                                    Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable">
                                                <table
                                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> </th>
                                                        <th> Course Code </th>
                                                        <th> Course Name </th>
                                                        <th> Fees </th>
                                                        <th> Duration (in Weeks) </th>
                                                        <th>Status</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(Auth::user()->can('admin_staff'))
                                                            @foreach($courses as $course)
                                                                <tr>
                                                            <td>{{ $loop->index +1 }}</td>
                                                            <td>
                                                                @if(empty($course->image))
                                                                    <img src="{{ asset('uploads/course/course.png') }}" width="150px">
                                                                    @else
                                                                    <img src="{{ asset('uploads/course/'. $course->image) }}" alt="" width="150px">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $course->code }}
                                                            </td>
                                                            <td>{{$course->name}}</td>
                                                            <td> Rs. {{ $course->fees }}</td>
                                                            <td>{{ $course->duration }}</td>

                                                            <td>
                                                                @if($course->status == 1)
                                                                    <span class="label label-rouded label-menu label-success">Active</span>
                                                                    @else
                                                                    <span class="label label-rouded label-menu label-danger">In Active</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('editCourse', $course->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                    <button href="javascript:" rel="{{ $course->id }}" rel1="delete-course" class="btn btn-danger btn-xs deleteRecord" >
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </button>
                                                            </td>
                                                        </tr>
                                                            @endforeach

                                                        @endif



                                                        @if(Auth::user()->can('teacher'))



                                                            @foreach($courses as $course)


                                                                <td>{{ $loop->index +1 }}</td>
                                                                <td>
                                                                    @if(empty($course->image))
                                                                        <img src="{{ asset('uploads/course/course.png') }}" width="150px">
                                                                    @else
                                                                        <img src="{{ asset('uploads/course/'. $course->image) }}" alt="" width="150px">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $course->code }}
                                                                </td>
                                                                <td>{{$course->name}}</td>
                                                                <td> Rs. {{ $course->fees }}</td>
                                                                <td>{{ $course->duration }}</td>

                                                                <td>
                                                                    @if($course->status == 1)
                                                                        <span class="label label-rouded label-menu label-success">Active</span>
                                                                    @else
                                                                        <span class="label label-rouded label-menu label-danger">In Active</span>
                                                                    @endif
                                                                </td>

                                                                <td>

                                                                    <form action="{{ route('courseStudent') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                                        <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-user-o "></i></button>
                                                                    </form>
                                                                    <a href="{{ route('editCourse', $course->id) }}"
                                                                       class="btn btn-primary btn-xs">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <button href="javascript:" rel="{{ $course->id }}" rel1="delete-course" class="btn btn-danger btn-xs deleteRecord" >
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </button>

                                                                </td>
                                                            </tr>
                                                                @endforeach
                                                        @endif

                                                        @if(Auth::user()->can('student'))



                                                            @foreach($courses as $course)


                                                                <td>{{ $loop->index +1 }}</td>
                                                                <td>
                                                                    @if(empty($course->image))
                                                                        <img src="{{ asset('uploads/course/course.png') }}" width="150px">
                                                                    @else
                                                                        <img src="{{ asset('uploads/course/'. $course->image) }}" alt="" width="150px">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $course->code }}
                                                                </td>
                                                                <td>{{$course->name}}</td>
                                                                <td> Rs. {{ $course->fees }}</td>
                                                                <td>{{ $course->duration }}</td>

                                                                <td>
                                                                    @if($course->status == 1)
                                                                        <span class="label label-rouded label-menu label-success">Active</span>
                                                                    @else
                                                                        <span class="label label-rouded label-menu label-danger">In Active</span>
                                                                    @endif
                                                                </td>

                                                               <td>No actions available</td>
                                                            </tr>
                                                                @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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


@endsection
