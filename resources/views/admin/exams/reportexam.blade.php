@extends('admin.layouts.admin_design')

@section('title')  View Exam Report  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">View Exam Report</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Exams</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View Exam Report</li>
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

                                                <header>Exam : {{$course->name}} - {{$examname->exam_name}} </header>


                                                @if($errors->any())
                                                    <h4>{{$errors->first()}}</h4>
                                                @endif

                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Students Name </th>
                                                        <th> Result </th>
                                                        <th>Edit</th>

                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($result as $data)
                                                        <tr>
                                                            <td>{{ $loop->index +1 }}</td>
                                                            <td>{{ $data->student->fname}}  {{$data->student->lname}}</td>

                                                            <td>
                                                                <form method="post" action="{{route('editresult')}}">
                                                                    @csrf


                                                                <select name="result"  class="form-control" data-validation="required"
                                                                        data-validation-error-msg="Select Course">
                                                                    <option  value="1" @if ( $data->result==1) selected @endif  >Pass</option>
                                                                    <option  value="0" @if ( $data->result==0) selected @endif  >Fail</option>
                                                                    <option  value="3" @if ( $data->result==3) selected @endif  >Absent</option>
                                                                </select>
                                                            </td>

                                                            <td>

                                                                <input type="hidden"  value="{{$examname->id}}" name="exam_id">
                                                                <input type="hidden"  value="{{ $data->student->id}}" name="student_id">

                                                                <button class="btn-success" type="submit" >Change Result</button></td>
                                                            </form>

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

    <script>
        @if(session('toast_error'))
        toastr.error("Attendance Has Been Already Submitted");
        @endif
    </script>





@endsection





