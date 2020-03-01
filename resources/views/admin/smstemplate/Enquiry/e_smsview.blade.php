@extends('admin.layouts.admin_design')

@section('title')

        SMS Enquiries  - Institute Management System (IMS)

@endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">

                            All Enquiries List


                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Enquiry</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">


                            View All Enquiries

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
                                    <form method="post" id="myForm" action="{{route('sendsms')}}">
                                        @csrf

                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>

                                                    All Enquiries List

                                            </header>

                                        </div>
                                        <div class="card-body ">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">


                                                            <label for="sms_name">Select SMS Template</label>
                                                        <select name="sms_name" id="sms_name" class="form-control"  onchange="smscheck()">

                                                            <option selected disabled hidden>Select SMS Template</option>
                                                            <option value="other">Other</option>

                                                            @foreach($sms as $data)
                                                                <option value="{{$data->message}}" >{{ $data->name }}</option>

                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="sms_message">SMS</label>
                                                            <textarea name="sms" id="sms_message" cols="30" rows="5" class="form-control" data-validation="required"
                                                                      data-validation-error-msg="Please Select SMS" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                                <div class="row ">
                                                    <div class="col-12 ">
                                            <a id="submitBtn" class="btn btn-success btn-lg " style="float: right;">Send <i class="fa fa-paper-plane"></i> </a>
                                                    </div>
                                                </div>





                                            <div class="row">
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover  order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="selectall"></th>
                                                        <th> S.No </th>
                                                        <th> Name </th>
                                                        <th> Email </th>
                                                        <th> Phone </th>
                                                        <th> Enquiry On </th>
                                                        <th> Category </th>
                                                        <th> Source </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($enquiry as $key=>$enq)
                                                        <tr class="odd gradeX">

                                                            <td><input type="checkbox" id="phonenumbers" value="{{ $enq->phone }}" name="phone[]"></td>

                                                            </form>
                                                            <td class="left"> {{ $loop->index +1 }}</td>

                                                            <td>{{ $enq->name }}</td>
                                                            <td>{{ $enq->email }}</td>
                                                            <td>{{ $enq->phone }}</td>
                                                            <td>{{ $enq->date }}</td>

                                                            <td>
                                                                <?php $enquiry_category = $enq->category->sortBy('cat_name')->pluck('id'); ?>

                                                            @foreach($enquiry_category as $data)
                                                                    <li>
                                                                        {{ \App\EnquiryCategory::find($data)->cat_name }}
                                                                    </li>
                                                                @endforeach
                                                            </td>

                                                            <?php $enquiry_sources = $enq->sources->sortBy('name')->pluck('id'); ?>
                                                            <td>
                                                                @foreach($enquiry_sources as $data)
                                                                    <li>
                                                                        {{ \App\EnquirySource::find($data)->name }}
                                                                    </li>
                                                                @endforeach
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
    <script>

        function smscheck(){

                var x = document.getElementById("sms_name").value;


            if (x == "other") {

                document.getElementById("sms_message").value =  "";
                document.getElementById("sms_message").placeholder = "Type SMS Here";

            } else {

                document.getElementById("sms_message").value =  x;
            }



        };

        $(document).ready(function(){
            $("#selectall").click(function(){


                if($('#selectall').is(':checked')){
                    $('input[name="phone[]"]').prop('checked', true);


                }
                else {
                    $('input[name="phone[]"]').prop('checked', false);
                }//Select All
            });
        });

        $(document).ready(function() {
            $('#example4').DataTable( {
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            } );
        } );




        $(document).ready(function(){
            $("#submitBtn").click(function(){
                $("#myForm").submit(); // Submit the form
            });
        });





    </script>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


    <script>
        $.validate({
            lang: 'en',
            modules: 'file',
        });

    </script>
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
