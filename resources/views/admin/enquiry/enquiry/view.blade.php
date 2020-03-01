@extends('admin.layouts.admin_design')

@section('title') View All enquries - Institute Management System (IMS) @endsection

@section('content')

<div class="page-content">
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">All enquries List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:">enquries</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">View All enquries</li>
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
                                        <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">All enquries List</header>

                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="btn-group">
                                                    <a href="{{ route('enquiry.create') }}" id="addRow" class="btn btn-info" style="margin-right: 10px;">
                                                        Add New <i class="fa fa-plus"></i>
                                                    </a>


                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group pull-right">
                                                        <a class="btn deepPink-bgcolor  btn-outline dropdown-toggle"
                                                           data-toggle="dropdown">Tools
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
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
                                                </div> -->
                                        </div>
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                                <thead>
                                                    <tr>
                                                        <th> S.No </th>
                                                        <th> Enquiry By </th>
                                                        <th> Email </th>
                                                        <th> Phone </th>
                                                        <th> Enquiry On </th>
                                                        <th> Category </th>
                                                        <th> Source </th>
                                                        <th> Responded Through </th>
                                                        <th>Office Visit</th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($enquries as $key=>$enquries)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            {{ $enquries->name }}
                                                        </td>
                                                        <td>
                                                            {{ $enquries->email }}
                                                        </td>
                                                        <td>
                                                            {{ $enquries->phone }}
                                                        </td>
                                                        <td>
                                                            {{ $enquries->date }}
                                                        </td>
                                                        <?php $enquiry_category = $enquries->category->sortBy('cat_name')->pluck('id'); ?>
                                                        <td>
                                                            @foreach($enquiry_category as $data)
                                                            <li>
                                                                {{ \App\EnquiryCategory::find($data)->cat_name }}
                                                            </li>
                                                            @endforeach
                                                        </td>

                                                            <?php $enquiry_sources = $enquries->sources->sortBy('name')->pluck('id'); ?>
                                                        <td>
                                                            @foreach($enquiry_sources as $data)
                                                            <li>
                                                                {{ \App\EnquirySource::find($data)->name }}
                                                            </li>
                                                            @endforeach
                                                        </td>

                                                        <?php $enquiry_responses = \App\EnquiryResponse::where('enquiry_id', $enquries->id)->pluck('enquiry_response_id'); ?>
                                                        <td>
                                                            @foreach($enquiry_responses as $data)
                                                            <li>
                                                                {{ \App\EnquirySource::find($data)->name }}
                                                            </li>
                                                            @endforeach
                                                        </td>
                                                        <td>@if($enquries->visited==1)Yes @elseif($enquries->visited==0) No @endif </td>
                                                        
                                                        <td>
                                                             <form action="{{route('clientadd',$enquries->id)}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$enquries->id}}" name="enquiry_id" >
                                                        <button type="submit" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-user"></i>
                                                            </button>
                                                            </form>
                                                        

                                                            <a href="{{ route('enquiry.edit', $enquries->id) }}" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>

                                                            <button href="javascript:" rel="{{$enquries->id}}" rel1="enquiries/delete-enquiry" class="btn btn-danger btn-xs deleteRecord">
                                                                <i class="fa fa-trash-o "></i>
                                                            </button>
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