@extends('admin.layouts.admin_design')

@section('title')  Edit Course  - Institute Management System (IMS) @endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit  Expense -  {{ $expense->expense_category }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Expense</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>New Expense Details</header>


                    </div>
                    <div class="card-body " id="bar-parent">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf


                            <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cat_id">Select Expense Category</label>
                                    <select name="cat_id" id="cat_id" class="form-control" data-validation="required"
                                            data-validation-error-msg="Select Expense Category">
                                        <option selected disabled="">Select Expense Category</option>
                                        @foreach($expensecategories as $expensecategory)
                                        <option value="{{ $expensecategory->id }}"@if($expensecategory->id == $expense->expense_category) selected @endif>{{ @$expensecategory->expense_category_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="received_by">Received by</label>
                                            <input type="text" value="{{$expense->received_by}}" class="form-control" id="received_by"
                                                   placeholder="Enter name" name="received_by" data-validation="length"
                                                   data-validation-length="2-400"
                                                   data-validation-error-msg="Please Enter the name">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fees">Amount </label>
                                            <input type="number" value="{{$expense->amount}}"class="form-control" id="amount"
                                                   placeholder="Enter Amount" name="amount" data-validation="required"
                                                   data-validation-error-msg="Amount is required">
                                        </div>
                                    </div>
                            </div>

                            <button  type="submit" class="btn btn-primary">Update Expense Category</button>

                            <a href="{{ route('viewExpenseCategory') }}" class="btn btn-danger">Go Back</a>

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
            $('#description').summernote({
                'height' : 130
            });
        });
    </script>
@endsection