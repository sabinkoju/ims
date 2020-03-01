@extends('admin.layouts.admin_design')

@section('title')  View All User  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Users List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Users</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View All Users</li>
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
                                            <header>All Users List</header>

                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('addUser') }}" id="addRow"
                                                           class="btn btn-info" style="margin-right: 10px;">
                                                            Add New  <i class="fa fa-plus"></i>
                                                        </a>

                                                        <a href="{{ route('viewTrashedUser') }}" id="addRow"
                                                           class="btn btn-warning">
                                                            Trashed Users  <i class="fa fa-eye"></i>
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
                                                                <a href="{{ route('printUser') }}">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('generate_usersPDF') }}">
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
                                                        <th> Name </th>
                                                        <th> User Role </th>
                                                        <th> Phone </th>
                                                        <th> Email </th>
                                                        <th>Address</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                    <tr class="odd gradeX">
                                                        <td class="patient-img">
                                                            @if(!empty($user->image))
                                                            <img src="{{ asset('uploads/profile/'.$user->image) }}"
                                                                 alt="{{ $user->name }}">
                                                                @else
                                                                <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                     alt="{{ $user->name }}">
                                                            @endif
                                                        </td>
                                                        <td class="left"> {{ $loop->index +1 }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td class="left">{{ $user->role->name }}</td>
                                                        <td>
                                                            @if(!empty($user->phone))

                                                                    {{ $user->phone }}
                                                                @else
                                                                Not Available
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->email }} </td>
                                                        <td class="left">
                                                            @if(!empty($user->address))
                                                                {{ $user->address }}
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('editUser', $user->id) }}"
                                                               class="btn btn-primary btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            @if($user->id == auth()->user()->id)
                                                            <button href="javascript:" rel="{{ $user->id }}" rel1="trash-user" class="btn btn-danger btn-xs deleteRecord" disabled="disabled">
                                                                <i class="fa fa-trash-o "></i>
                                                            </button>
                                                                @else
                                                            <a href="javascript:" rel="{{ $user->id }}" rel1="trash-user" class="btn btn-danger btn-xs deleteRecord">
                                                                <i class="fa fa-trash-o "></i>
                                                            </a>
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
