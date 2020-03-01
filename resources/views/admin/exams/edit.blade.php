@extends('admin.layouts.admin_design')

@section('title')  Edit Exam  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Exam</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Exam</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Edit Exam Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exam_name">Exam Name</label>
                                    <input type="text" class="form-control" id="exam_name" value="{{ $exam->exam_name }}"
                                            name="exam_name" data-validation="length"
                                           data-validation-length="3-400"
                                           data-validation-error-msg="Last Name is required (3-50 chars)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_id">Select Course </label>
                                    <select name="course_id"  class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Course">
                                        <option selected hidden value="{{$exam->course_id}}">{{$exam->courses->name}}</option>

                                        @foreach($course as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="doe">Date Of Exam</label>
                                    <input type="date" class="form-control" id="doe"
                                           placeholder="Please Select Exam Date" name="exam_date" data-validation="required"
                                           data-validation-error-msg="Select Exam Date" value="{{ $exam->exam_date }}">
                                </div>

                            </div>




                            <button  type="submit" class="btn btn-primary">Schedule Exam</button>

                            <a href="{{ route('viewAllExams') }}" class="btn btn-info">View All</a>

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


    </script>
@endsection
