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
								
								<li class="active">Teacher Profile</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							
								<div class="card ">
									<div class="card-body no-padding height-9">
										<div class="row">
											<div class="profile-userpic">
												@if(!empty($teachers->image))
                                                                    <img src="{{ asset('public/uploads/profile/'.$teachers->image) }}" class="img-responsive"
                                                                         alt="{{ $teachers->name }}">
                                                                @else
                                                                    <img src="{{ asset('public/uploads/profile/profile.png') }}"
                                                                         alt="{{ $teachers->name }}" class="img-responsive">
                                                                @endif 
											</div>
										</div>
										<div class="profile-usertitle">
											<div class="profile-usertitle-name"> {{$teachers->name}} </div>
											
                                        </div>
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
																<p class="text-muted">{{$teachers->name}}</p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
																<br>
																<p class="text-muted">{{$teachers->phone}}</p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Email</strong>
																<br>
																<p class="text-muted">{{$teachers->email}}</p>
															</div>
															<div class="col-md-3 col-6"> <strong>Address</strong>
																<br>
																<p class="text-muted">{{$teachers->address}}</p>
															</div>
														</div>
														
														<br>
														
														<br>

														
														
														<br>
														
														<br>
													</div>
												</div>
												
																
                                                            </div>
                                                            </div>
													</div>
                                                            
                                                    
								
                                                </div>
                                                
                                            </div>

                                            
								
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
															<div class="col-md-3 col-6 b-r"> <strong>Assigned Course</strong>
																<br>
																@foreach($course_teacher as $data)
                                                                    <li>
                                                                        {{ \App\Course::find($data)->name }}
                                                                    </li>
                                                                    @endforeach
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Assigned Batch</strong>
																<br>
																@foreach($batch as $batches)
																<li>{{$batches->batch_name}}</li>
																@endforeach
															</div>
															
															<div class="col-md-3 col-6"> <strong>Assigned Section</strong>
																<br>
																@foreach($batch as $batches)
																<li>{{$batches->sections->section_name}}</li>
																@endforeach
															</div>
														</div>
														
														<br>
														
														<br>

														
														
														<br>
														
														<br>
													</div>
												</div>
												
																
                                                            </div>
                                                            </div>
													</div>
                                                            
                                                    
								
                                                
                                                
                                            




                                          
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->
										
										<!-- END SIDEBAR BUTTONS -->
                                    </div>
                                    
                                   
								
								
								
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							
									
									</div>
								</div>
							</div>
							<!-- END PROFILE CONTENT -->
						</div>
					</div>
				</div>

            @endsection