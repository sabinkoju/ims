@extends('admin.layouts.admin_design')

@section('title')  Edit Email  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit  Email Template -  {{ $emailtemplate->name }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Email Template</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New Email Template</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf


                            <div class="row">

<div class="col-md-6">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Template Name</label>
                <input type="text" class="form-control" id="name" value="{{$emailtemplate->name}}"
                       placeholder="Enter name" name="name" data-validation="length"
                       data-validation-length="3-400"
                       data-validation-error-msg="Template Name is required (3-50 chars)">
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label for="message">Email Template </label>
                <textarea name="message"   id='message' cols="30" rows="10" class="form-control">{{$emailtemplate->message}}</textarea>
                
                

            </div>
        


       
    </div>
</div>
</div>


<button  type="submit" class="btn btn-primary">Update Email Template</button>

<a href="{{ route('viewEmailTemplate') }}" class="btn btn-danger">Go Back</a>

</form>
</div>
</div>
</div>

</div>

</div>

@endsection




@section('scripts')
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



<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script>
$(document).ready(function() {
$('#message').summernote({
'height' : 130
});
});
</script>


@endsection