@extends('admin.layouts.admin_design')

@section('title')  Edit Payment   - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Payment</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit New Fee</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header> Fee Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post"  enctype="multipart/form-data">
                            @csrf

                        <div class="col-md-6">
                         <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$payment->payment_title}}">
                         </div>
                        </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="fee" class="col-form-label">Payment Fee</label>
                                <input type="text" class="form-control" id="fee" name="amount" value="{{$payment->amount_paid}}" >
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="received_b">Received By</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                           placeholder="Enter Received By" name="received_by">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mode_of_payment">Mode Of Payment</label>
                                   <select id="mode_of_payment" placeholder="select" class="form-control" name="mode_of_payment"  data-validation="required"
                                                    data-validation-error-msg="At Least a course is required">

                                                <option value="cash" @if ($payment->student_id="cash") selected @endif>Cash</option>
                                                <option value="cheque" @if ($payment->student_id="cheque") selected @endif>Cheque</option>
                                                <option value="transfer" @if ($payment->student_id="transfer") selected @endif>Transfer</option>
                                                <option value="bank_deposite" @if ($payment->student_id="bank_deposite") selected @endif>Bank Deposite</option>

                                            </select>
                                </div>
                            </div>


                             <div id="selectpayment">
                    <div class="col-md-6">
                           <div class="form-group">
                                <label for="document_number">Document Number </label>
                                          <input type="number" class="form-control" id="document_number"
                                                   placeholder="Enter Document Number" name="document_number" value="{{$payment->document_number}}">
                           </div>
                   </div>
                   <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="hidden" name="current_image">
                                    <input type="file" class="form-control" id="image"
                                           name="image" data-validation="mime size"
                                           data-validation-allowing="jpg, png"
                                           data-validation-max-size="1024kb"
                                           data-validation-error-msg-required="Please Upload User Image"
                                        value="{{$payment->doc_image}}">
                                </div>
                    </div>

                </div>




                            <button  type="submit" class="btn btn-primary">UPDATE FEE</button>

                            <a href="{{ route('viewFees') }}" class="btn btn-danger">Go Back</a>





                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('css')

    <link href="{{asset('adminAssets/assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection




@section('scripts')


<script type="text/javascript">
    $(document).ready(function(){  var mode=document.getElementById("mode_of_payment").value;

           if(mode=="cash")
            document.getElementById("selectpayment").style.display = "none";
          else{
             document.getElementById("selectpayment").style.display = "block";

        }
   });

        document.getElementById("mode_of_payment").onchange = function() {
            var mode=document.getElementById("mode_of_payment").value;

           if(mode=="cash")
            document.getElementById("selectpayment").style.display = "none";
          else{
             document.getElementById("selectpayment").style.display = "block";

        }

        }


</script>

<script type="text/javascript">

        $("#coursefee").change(function () {
             var fees=$(this).find(':selected').data("fees");
             $("#fees").val(fees);

        });


</script>


    <script src="{{asset('adminAssets/assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('adminAssets/assets/js/pages/select2/select2-init.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


    <script>
        $.validate({
            lang: 'en',
            modules: 'file',
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

    <script>
        function checkUserEmail() {
            var email = $("#email").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '{{ route('checkUserEmail') }}',
                data: { email:email},
                success: function (resp) {
                    if( resp == "exists"){
                        $("#emailExists").show();
                    }
                }, error: function () {
                    alert("Error");
                }
            });
        }




            $(document).ready(function() {
                $('.select2-multiple').select2({
                    placeholder: 'Please Choose Course'
                });


        });




    </script>
@endsection
