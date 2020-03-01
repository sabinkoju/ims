@extends('admin.layouts.admin_design')

@section('title')  Invoice  - Institute Management System (IMS) @endsection

@section('content')



<div class="page-content-wrapper"  >
				<div class="page-content" style="min-height:583.8889px " >
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Student Invoice</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li><li><a class="parent-item" href="">Fees</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Invoice</li>
							</ol>
						</div>
				</div>

				<div class="white-box" style="box-shadow: 10px 10px 6px -5px black;  padding:0px 50px">
						<div class="row" >
							<div class="col-md-6">
								<div class="pull-left">
									<address style="margin-top: 20px;">
										<img src="{{ asset('adminAssets\assets\img\logo.png')}}" alt="logo" class="logo-default" style="height:9vh; width:auto;">
									</address>
								</div>
							</div>

							<div class=" col-md-6 ">
								<div class=" pull-right">
										<address>
													<td class="align-right">
														<h2 colspan=2; style="color:#2d862d">Invoice</h2>
														<p style="float:right;">
															Invoice no  :{{$lastpayment->payment_code}}<br>
															Invoice Date:{{$lastpayment->created_at}}</br>
															Student Id  :{{$student->id}}
														</p>
													</td>
										</address>
								</div>
							</div>
						</div>

					<div class="row container">
							<div class="col-md-6">
								<div class="pull-left">
									To <br>
									<strong style="font-size: 22px;">{{$student->fname}}  {{$student->lname}}</strong> <br>
            						<p style="font-size: 14px;">{{$student->address}}</br>
                                        {{$student->email}}</br>
									{{$student->phone}}</p>
								</div>
							</div>

							<div class="col-md-6">
								<div class="pull-right" >
										</br>
										<h3 style="color:black ;float: right;">Total Due: </br>
                                            Rs. {{$student->due}}
                                        </h3>
								</div>
							</div>
					</div>
					<div class="col-md-12">
							<div class="table-responsive m-t-40">
								<table class="table table-hover">
									<thead style="background-image:linear-gradient(to right, rgba(180, 230, 2,0.5), rgba(54, 212, 6,1));">
										<tr style="font-size:16px;">
											<th class="text-center">#</th>
											<th class="text-right">Fee Title</th>
											<th class="text-right">Amount</th>
										</tr>
									</thead>
									<tbody>

										<tr>
											<td class="text-center">#</td>
											<td class="text-right">{{$lastpayment->payment_title}}</td>
											<td class="text-right">Rs. {{$lastpayment->amount_paid}}</td>
										</tr>


									</tbody>
								</table>
							</div>
						</div>
						<div class=" row ">
                 		    	<div class="col-md-12">
								    <div class="pull-left">
										<p><b>Payment Method:</b></p>
										<p>{{$lastpayment->mode_of_payment}}</br>
										</p> </br></br>
                                        <p><b>Received By:</b></p>
                                        <p>{{$lastpayment->received_by}}</br>
                                    </div>

									<div class="pull-right m-t-40 text-right ">
										<div class="total">
											<hr>
										</div>
										<div>

                                            <h3 style="background-image:linear-gradient(to right, rgba(180, 230, 2,0.5), rgba(54, 212, 6,1))"><b>Total Amount Paid:</b> {{$totalamountpaid}}</h3>
                                            <h3 style="background-image:linear-gradient(to right, rgba(180, 230, 2,0.5), rgba(54, 212, 6,1))"><b>Amount Paid:</b> {{$lastpayment->amount_paid}}</h3>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<hr>
							<div class="md-6" style="font-size:20px">
								<i class="fa fa-phone">+977-47347937</i></br>
								<i class="fa fa-at"> urname@email.com</i></br>
								<i class="fa fa-search">  www.gcn.com.np </i></br>
								<i class="fa fa-map-marker" >Anamnagar,Kathmandu</i>
							</div>
                    		<div class="text-right"style="background:#eee;">
								<button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
							</div>
						</div>
				   </div>
				</div>
</div>

@endsection

@section('css')

<link href="{{asset('adminAssets/assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('adminAssets/assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('adminAssets/assets/plugins/select2/css/invoice.css')}}" rel="stylesheet" type="text/css" />
    @endsection




    @section('scripts')
<script src="{{asset('adminAssets/assets/plugins/select2/js/select2.js')}}"></script>
<script src="{{asset('adminAssets/assets/js/pages/select2/select2-init.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
 <script>
    $.validate({
        lang: 'en',
        modules: 'file',
    });

    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: 'Please Choose Course'
        });

        $('.select2-shift').select2({
            placeholder: 'Please Choose Shifts'
        });
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

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <script>
    $(document).ready(function() {
       $('#description').summernote({
           'height' : 130
       });
    });
    </script>






@endsection


