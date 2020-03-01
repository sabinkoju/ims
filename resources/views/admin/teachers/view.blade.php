@extends('admin.layouts.admin_design')

@section('title')  View All Teachers  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Teachers List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Teachers</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View All Teachers</li>
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
                                            <header>All Teachers List</header>

                                        </div>
                                       
                                        <div class="card-body ">
                                        @if(Auth::user()->can('admin_staff'))
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('addTeacher') }}" id="addRow"
                                                           class="btn btn-info" style="margin-right: 10px;">
                                                            Add New  <i class="fa fa-plus"></i>
                                                        </a>

                                                        <a href="{{ route('viewTrashedTeacher') }}" id="addRow"
                                                           class="btn btn-warning">
                                                            Trashed Teachers  <i class="fa fa-eye"></i>
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
                                                                <a href="{{route('printTeacher')}}">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('generate_teachersPDF')}}">
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
                                                @endif
                                            </div>
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> </th>
                                                                <th> Name </th>
                                                                <th> Phone </th>
                                                                <th> Courses </th>
                                                                <th> Teacher's Category </th>
                                                                <th> Timing </th>
                                                                <th> Email </th>
                                                                <th>Address</th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                                    @if(Auth::user()->can('admin_staff'))
                                                    @foreach($teachers as $teacher)
                                                        <tr class="odd gradeX">
                                                            <td class="patient-img">
                                                                @if(!empty($teacher->image))
                                                                    <img src="{{ asset('uploads/profile/'.$teacher->image) }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @else
                                                                    <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @endif
                                                            </td>
                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td><a href="{{route('teacherprofile',$teacher->id)}}">{{ $teacher->name }}</a></td>

                                                            <td>
                                                                @if(!empty($teacher->phone))

                                                                    {{ $teacher->phone }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <?php $teacher_courses = $teacher->courses->sortBy('name')->pluck('id'); ?>
                                                            <td>
                                                                @foreach($teacher_courses as $data)
                                                                    <li>
                                                                        {{ \App\Course::find($data)->name }}
                                                                    </li>
                                                                @endforeach
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->teacher_category_id))

                                                                    {{ $teacher->teacher_category->cat_name }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->timing))

                                                                    {{ $teacher->timing }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>



                                                            <td>{{ $teacher->email }} </td>
                                                            <td class="left">
                                                                @if(!empty($teacher->address))
                                                                    {{ $teacher->address }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>
                                                             <td>
                                                                <a href="{{ route('editTeachers', $teacher->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>

                                                                    <a href="javascript:" rel="{{ $teacher->id }}" rel1="teachermanagement/trash-teacher" class="btn btn-danger btn-xs deleteRecord">
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    @endif
<!-- -----------------------------------------------------STUDENT-------------------------------------------------------------------- -->
                                                @if(Auth::user()->can('student'))    
                                                
                                                    @foreach($test as $teachers)
                                                   <?php $teacher=\App\Teacher::findorFail($teachers->teacher_id) ?>
                                                   <tr class="odd gradeX">
                                                            <td class="patient-img">
                                                                @if(!empty($teacher->image))
                                                                    <img src="{{ asset('uploads/profile/'.$teacher->image) }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @else
                                                                    <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @endif
                                                            </td>
                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td><a href="{{route('teacherprofile',$teacher->id)}}">{{ $teacher->name }}</a></td>

                                                            <td>
                                                                @if(!empty($teacher->phone))

                                                                    {{ $teacher->phone }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <?php $teacher_courses = $teacher->courses->sortBy('name')->pluck('id'); ?>
                                                            <td>
                                                                @foreach($teacher_courses as $data)
                                                                    <li>
                                                                        {{ \App\Course::find($data)->name }}
                                                                    </li>
                                                                @endforeach
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->teacher_category_id))

                                                                    {{ $teacher->teacher_category->cat_name }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->timing))

                                                                    {{ $teacher->timing }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>



                                                            <td>{{ $teacher->email }} </td>
                                                            <td class="left">
                                                                @if(!empty($teacher->address))
                                                                    {{ $teacher->address }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{ route('editTeachers', $teacher->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>

                                                                    <a href="javascript:" rel="{{ $teacher->id }}" rel1="teachermanagement/trash-teacher" class="btn btn-danger btn-xs deleteRecord">
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </a>

                                                            </td>

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
