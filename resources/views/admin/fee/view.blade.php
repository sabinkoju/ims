@extends('admin.layouts.admin_design')

@section('title')  View All Fees  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Fees List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Fee</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">View All Fees</li>
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
                                            <header>All Fee List</header>

                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('addFees') }}" id="addRow"
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
                                                                <a href="{{route('printFees')}}">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('generate_feePDF')}}">
                                                                    <i class="fa fa-file-pdf-o"></i> Save as
                                                                    PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="">
                                                                    <i class="fa fa-file-excel-o"></i>
                                                                    Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">

                                            <form action="{{ route('viewFees') }}" method="post">
                                                @csrf

                                                <div class="row small-spacing">


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <select name="student"  class="form-control" data-validation="required"
                                                                        data-validation-error-msg="Select Student">
                                                                    <option disabled selected>Select a Student</option>
                                                                @foreach($students as $student)
                                                                   <option value="{{$student->id}}">{{@$student->fname}}  {{@$student->lname}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button  type="submit" class="btn btn-primary">Generate Fee Report </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                            </div>
                                            </div>


                                            @if(isset($fees))

                                            <div class="row">
                                                <div class="col-md-12">

                                                  <strong>Name : {{$student_name->fname}}  {{$student_name->lname}}
                                                </strong>



                                                </div>
                                            </div>

                                            <div class="table-scrollable">
                                                <table
                                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        >
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Title  </th>
                                                        <th> Amount</th>
                                                        <th> Action </th>

                                                    </tr>
                                                    </thead>
                                                       <?php
                                                       $total = 0;
                                                       foreach($fees as $data){
                                                              $total = $data->amount+$total;
                                                       }
                                                       ?>

                                                    <tfoot>


                                                        <tr>
                                                            <td></td>
                                                        <td colspan="">
                                                            <strong>Total </strong>
                                                        </td>
                                                        <td>Rs. {{$total}}</td>
                                                        </tr>


                                                        <tr>
                                                            <td></td>
                                                            <td colspan="">
                                                                <strong>Paid </strong>
                                                            </td>
                                                            <td>Rs. {{$totalamountpaid}}</td>
                                                        </tr>


                                                        <tr>
                                                            <td></td>
                                                            <td colspan="">
                                                                <strong>Due </strong>
                                                            </td>
                                                            <td>Rs. {{$student_name->due}}</td>
                                                        </tr>
                                                    </tfoot>
                                                     <tbody>

                                                    @foreach($fees as $fee)

                                                        <tr>
                                                            <td>{{ $loop->index +1 }}</td>
                                                            <td>{{$fee->title}}</td>
                                                            <td> Rs. {{ $fee->amount }}</td>
                                                            <td> <button href="javascript:" rel="{{ $fee->id }}" rel1="delete-fee" class="btn btn-danger btn-xs deleteRecord" >
                                                                    <i class="fa fa-trash-o "></i>
                                                                </button></td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                                <?php $std_id=$student_name->id ?>

                                                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$student_name->fname}}  {{$student_name->lname}}">Make Payment</button>

                                                 <a href="{{route('viewfeedetails',$std_id)}}" class="btn btn-warning pull-right" style="margin-right: 10px;">View Details</a>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




        <!---   MOdal Body--->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('makepayment')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                @if(isset($fees))
                                <input type="hidden" value="{{$student_name->id}}" name="student_id">
                                    <input type="hidden" value="{{$total}}" name="payableamount">
                                @endif
                                <label for="title" class="col-form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="fee" class="col-form-label">Payment Fee</label>
                                <input type="text" class="form-control" id="fee" name="amount" >
                            </div>


                                <div class="form-group">
                                    <label for="received_b">Received By</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                           placeholder="Enter Received By" name="received_by">
                                </div>



                                <div class="form-group">
                                    <label for="mode_of_payment">Mode Of Payment</label>
                                    <select id="mode_of_payment"  placeholder="select" class="form-control" name="mode_of_payment"  data-validation="required" onchange="mode_of_payment()"
                                            data-validation-error-msg="Please Select Mode of Payment">
                                        <option selected hidden>Please Select Mode Of Payment</option>
                                        <option value="cash" selected>Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="bank_deposite">Bank Deposite</option>

                                    </select>
                                </div>

                            <div id="selectpayment" style="display: none">

                                    <div class="form-group">
                                        <label for="document_number">Document Number </label>
                                        <input type="number" class="form-control" id="document_number"
                                               placeholder="Enter Document Number" name="document_number">
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image"
                                               name="doc_image" data-validation="mime size"
                                               data-validation-allowing="jpg, png"
                                               data-validation-max-size="1024kb"
                                               data-validation-error-msg-required="Please Upload Document Image">
                                    </div>



                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a target="_blank">
                        <button type="submit" class="btn btn-primary" >Pay</button>
                        </a>
                    </div>
                    </form>
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
    $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Fee Payment ' + recipient)

    })
</script>

<script type="text/javascript">

    document.getElementById("mode_of_payment").onchange = function() {
        var mode=document.getElementById("mode_of_payment").value;

        if(mode=="cash")
            document.getElementById("selectpayment").style.display = "none";
        else{
            document.getElementById("selectpayment").style.display = "block";

        }

    }


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
