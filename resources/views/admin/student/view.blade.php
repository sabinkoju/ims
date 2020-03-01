@extends('admin.layouts.admin_design')

@section('title')
    @if(!empty($trashed))
        View All Trashed Student  - Institute Management System (IMS)
    @else
    View All Student  - Institute Management System (IMS)
    @endif
@endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">
                        @if(!empty($trashed))
                         Trashed Students List
                            @else
                        All Students List
                            @endif

                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Students</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">

                        @if(!empty($trashed))
                            Trashed Students List
                        @else
                           View All Students
                        @endif</li>
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
                                            <header>

                                                @if(!empty($trashed))
                                                    All Trashed Students List
                                                @else
                                                    All Students List
                                                    @endif
                                            </header>

                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('addStudent') }}" id="addRow"
                                                           class="btn btn-info" style="margin-right: 10px;">
                                                            Add New  <i class="fa fa-plus"></i>
                                                        </a>


                                                        @if(!empty($trashed))
                                                        <a href="{{ route('viewStudent') }}" id="addRow"
                                                           class="btn btn-warning">
                                                            View Students  <i class="fa fa-eye"></i>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('viewTrashedStudent') }}" id="addRow"
                                                           class="btn btn-warning">
                                                            Trashed Students  <i class="fa fa-eye"></i>
                                                        </a>
                                                        @endif

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
                                                                <a href="{{route('printStudent')}}">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('generate_studentPDF')}}">
                                                                    <i class="fa fa-file-pdf-o"></i> Save as
                                                                    PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
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
                                                        <th> First Name </th>
                                                        <th> Last Name </th>
                                                        <th> Gender </th>
                                                        <th> Date Of Birth </th>
                                                        <th> Students's Email </th>
                                                        <th> Phone </th>
                                                        <th> Address </th>
                                                        <th>Category</th>
                                                        <th>Courses</th>
                                                        <th>Batch</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($student as $std)
                                                        <tr class="odd gradeX">

                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td class="patient-img">  @if(!empty($std->image))
                                                                    <img src="{{ asset('uploads/profile/'.$std->image) }}"
                                                                         alt="{{ $std->fname }} {{ $std->lname }}">
                                                                @else
                                                                    <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                         alt="{{ $std->fname }} {{ $std->lname }}">
                                                                @endif</td>
                                                            <td><a href="{{route('studentprofile',$std->id)}}">{{ $std->fname }}</a></td>
                                                            <td>{{ $std->lname }}</td>
                                                            <td>{{ $std->gender }}</td>
                                                            <td>{{ $std->dob }}</td>
                                                            <td>{{ $std->email }}</td>
                                                            <td>{{ $std->phone }}</td>
                                                            <td>{{ $std->address }}</td>
                                                            <td>{{ @$std->student_category->name }}</td>


                                                            <?php $student_courses = $std->courses->sortBy('name')->pluck('id'); ?>
                                                            <td>
                                                                @foreach($student_courses as $data)
                                                                    <li>
                                                                        {{ \App\Course::find($data)->name }}
                                                                    </li>
                                                                @endforeach
                                                            </td>
                                                            <td>{{ @$std->batches->batch_name }}</td>
                                                            <td>

                                                                @if(!empty($trashed))
                                                                <a href="{{ route('restoreStudent', $std->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-undo"></i>
                                                                </a>


                                                                <a href="javascript:" rel="{{ $std->id }}" rel1="studentmanagement/delete-student" class="btn btn-danger btn-xs deleteRecord">
                                                                    <i class="fa fa-trash-o "></i>
                                                                </a>



                                                                    @else
                                                                <a href="{{ route('editStudent', $std->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button href="javascript:" rel="{{ $std->id }}" rel1="studentmanagement/trash-student" class="btn btn-danger btn-xs deleteRecord" >
                                                                    <i class="fa fa-trash-o "></i>
                                                                </button>

                                                                @endif
                                                            </td>



                                                        </tr>
                                                    @endforeach
                                                    
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
