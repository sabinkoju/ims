@extends('admin.layouts.admin_design')
@section('title') Enquiry @endsection
@section('content')

<div class="page-content">
     @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">{{ (isset($data)?'Update':'Add New') }} Enquiry</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">{{ (isset($data)?'Update':'Add New') }} Enquiry</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">{{ (isset($data)?'':'New') }} Enquiry Details</header>


                </div>
                <div class="card-body " id="bar-parent">
                    @if(isset($data))
                    <form method="post" action="{{ route('enquiry.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @else
                        <form method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
                            @csrf
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="enquiry_categories"> Select Category
                                            </label>
                                            <select id="enquiry_categories" class="form-control enquiry-category-multiselect" name="enquiry_categories[]" multiple data-validation="required" data-validation-error-msg="At Least a category is required">
                                                @if(isset($categories))
                                                @foreach($categories as $category)
                                                <option value="{{ @$category->id }}" @if(isset($enquiries_category)){{ in_array($category->id, $enquiries_category) ? 'selected' : '' }} @endif> {{ @$category->cat_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="source"> Select Source
                                            </label>
                                            <select id="source" class="form-control select2-multiple" name="source[]" multiple data-validation="required" data-validation-error-msg="At Least a source is required">
                                                @if(isset($sources))
                                                @foreach($sources as $source)
                                                <option value="{{ @$source->id }}" @if(isset($enquiries_source)){{ in_array($source->id, $enquiries_source) ? 'selected' : '' }} @endif> {{ @$source->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="shift">Please Select Category
                                        </label>
                                            <select id="shift" class="form-control select2-multiple" name="category" multiple data-validation="required"
                                                    data-validation-error-msg="At Least a category is required">
                                                 @if(isset($categories))
                                                    @foreach($categories as $category)
                                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" value="{{ @$data->name }} {{ old('name') }}" placeholder="Enter full Name" name="name" data-validation="length" data-validation-length="3-400" data-validation-error-msg="Name is required (3-50 chars)">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" value="{{ @$data->email }}" data-validation="required" placeholder="Enter email" name="email" autocomplete="email">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Phone</label>
                                            <input type="phone" class="form-control" id="phone" value="{{ @$data->phone }}" data-validation="required | length" placeholder="Enter phone number" data-validation-length="9-20" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Enquiry Date</label>
                                            <input type="date" class="form-control" id="date" value="{{ @$data->date }}" placeholder="Enter date" data-validation="required" name="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="enquiries_responses">Responded Through
                                            </label>
                                            <select id="enquiries_responses" class="form-control responses-multiselect" name="enquiries_responses[]" multiple>
                                                @if(isset($sources))
                                                @foreach($sources as $source)
                                                <option value="{{ @$source->id }}" @if(isset($enquiries_response)){{ in_array($source->id, $enquiries_response) ? 'selected' : '' }} @endif> {{ @$source->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" style="display:none;">
                                           
                                            <select id="enquiries_responses_hidden"  name="enquiries_responses_hidden[]" multiple>
                                                @if(isset($sources))
                                                    @foreach($sources as $source)
                                                    <option value="{{ @$source->id }}" @if(isset($enquiries_response)){{ in_array($source->id, $enquiries_response) ? 'selected' : '' }} @endif> {{ @$source->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="remarks">Remarks </label>
                                            <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control">
                                            {{ @$data->remarks }}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">


                                <input type="checkbox" id="Usercheck" name="visited"  @if(@$data->visited == 1) checked @endif>
                                    <span>Visited Office</span>
                                </div>
                            </div>
                                
                                 <input type="hidden" name="response_id[]" id="response_id" value="{{ @$data->enquiries->id }}">

                            <button type="submit" class="btn btn-primary">{{ (isset($data)?'Update':'Add New') }} Enquiry</button>

                            <a href="{{ route('enquiry.index') }}" class="btn btn-danger">Go Back</a>

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

<!-- select 2 js -->
<script src="{{asset('adminAssets/assets/plugins/select2/js/select2.js')}}"></script>
<script src="{{asset('adminAssets/assets/js/pages/select2/select2-init.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
    $.validate({
        lang: 'en',
        modules: 'file',
    });

    $(document).ready(function() {

        $('.enquiry-category-multiselect').select2({
            placeholder: 'Choose Category'
        });

        $('.select2-multiple').select2({
            placeholder: 'Choose Source'
        });

        $('.responses-multiselect').select2({
            placeholder: 'Responded Through'
        });

        
    });
</script>

<script src="{{ asset('adminAssets/assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/jquery.sweet-alert.custom.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script type="text/javascript">
    @if(session('flash_message'))
    swal("Success!", "{!! session('flash_message') !!}", "success")
    @endif

    @if(session('flash_error'))
    swal("Error", "{!! session('flash_error') !!}")
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
 <script>
        $(document).ready(function() {
            $('#remarks').summernote({
                placeholder: 'Remarks ',
                    toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['picture']
              ],
              dialogsInBody: true,
});
});
    </script>
@endsection