@extends('admin.layouts.admin_design')

@section('title')  Profile - Institute Management System (IMS) @endsection

@section('content')

<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">My Profile</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>

								<li class="active">Student Profile</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<div class="card ">
									<div class="card-body no-padding height-9">
										<div class="row">
											<div class="profile-userpic">
											@if(!empty($studentd->image))
                                                                    <img src="{{ asset('uploads/profile/'.$std->image) }}"
                                                                         alt="{{ $student->fname }} {{ $studentd->lname }}">
                                                                @else
                                                                    <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                         alt="{{ $student->fname }} {{ $student->lname }}">
                                                                @endif </div>
										</div>

										<div class="profile-usertitle">
											<div class="profile-usertitle-name"> {{$student->fname}}{{$student->lname}} </div>

										</div>
										<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
												<b>Courses</b>

                                            <?php $student_courses = $student->courses->sortBy('name')->pluck('id'); ?>

                                                @foreach($student_courses as $data)
                                                    <a class="pull-right">
                                                        {{ \App\Course::find($data)->name }}
                                                    
												@endforeach
												</a>
												</li>

											<li class="list-group-item">
												<b>Batch</b> <a class="pull-right">{{@$student->batches->batch_name}}</a>
											</li>
											<li class="list-group-item">
											    
											   
												<b>Shift</b> <a class="pull-right">@foreach(@$shift as $shifts){{@$shifts->shift_available}}@endforeach</a>
											</li>
											
											<li class="list-group-item">
												<b>Section</b> <a class="pull-right">{{@$student->sections->section_name}}</a>
											</li>
											

										</ul>
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->

										<!-- END SIDEBAR BUTTONS -->
									</div>
								</div>



							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="card col-md-12">

										<div class="white-box">
											<!-- Nav tabs -->
											<div class="p-rl-20">
												<ul class="nav customtab nav-tabs" role="tablist">


												</ul>
											</div>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active fontawesome-demo" id="tab1">
													<div id="biography">
														<div class="row">
															<div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
																<br>
																<p class="text-muted">{{$student->fname}}  {{$student->fname}} </p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
																<br>
																<p class="text-muted">{{$student->phone}}</p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Email</strong>
																<br>
																<p class="text-muted">{{$student->email}}</p>
															</div>
															<div class="col-md-3 col-6"> <strong>Address</strong>
																<br>
																<p class="text-muted">{{$student->address}}</p>
															</div>
														</div>

														<br>
														<h4 class="font-bold">Payment History</h4>
														<b>DUE:{{$student->due}}</b>
														<table class="table">
															
														<th>Paid On</th>
														<th>Paid Amount</th>
														<th>Mode of Payment</th>
														
														@foreach($payment as $payments)
														<tr>
														<td>{{$payments->created_at}}</td>
														<td>{{$payments->amount_paid}}</td>
														<td>{{$payments->mode_of_payment}}</td>
														</tr>
														@endforeach
														</table>
														<hr>
														<ul>
															
														</ul>
														
														<br>
														<h4 class="font-bold">Attendance History</h4>
														<table class="table">
															
														<th>Date</th>
														<th>Attendance</th>
														
														
														@foreach($attendance as $attendances)
														<tr>
														<td>{{$attendances->created_at}}</td>
														<td>{{$attendances->attendance}}</td>
														
														</tr>
														@endforeach
														</table>
														<hr>

														<h4 class="font-bold">Result History</h4>
														
														<table class="table">
															<th>Exam Name</th>
															<th>Result</th>
															@foreach($result as $results)
															<tr>
												<td>{{@$results->exam->exam_name}}</td> 
												<td>@if(@$results->result==1)<?php echo "Passed"?> @endif
												@if(@$results->result==0)<?php echo "Failed"?> @endif 
												@if(@$results->result==3)<?php echo "Absent"?> @endif</td>
													</tr>
												
											
											@endforeach
											</table>
										
										<hr>

														<br>

														<br>
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
							<!-- END PROFILE CONTENT -->
						</div>
					</div>
				</div>

            @endsection
