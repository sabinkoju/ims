@extends('admin.layouts.admin_design')

@section('title')

        EMAIL Staff  - Institute Management System (IMS)

@endsection

@section('content')

    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">

                            All Staffs List


                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{ route('admin.dashboard') }}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="javascript:">Staffs</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">


                            View All Staffs

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
                                    <form method="post" id="myForm" action="{{route('sendemail')}}">
                                        @csrf

                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>

                                                    All Staffs List

                                            </header>


                                        </div>
                                        <div class="card-body ">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">





                                                            <label for="email_name">Select Email Template</label>
                                                        <select name="email_name" id="email_name" class="form-control"  onchange="emailcheck()">

                                                            <option selected disabled hidden>Select Email Template</option>
                                                            <option value="other">Other</option>

                                                            @foreach($email as $data)
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
                                                            <label for="description">Email</label>
                                                            <textarea name="email_message" id="email_message" cols="30" rows="10" class="form-control" data-validation="required"
                                                                      data-validation-error-msg="Please Select Email"  ></textarea>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>


                                            <div class="row ">
                                                <div class="col-12 ">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary btn-lg" style="float: right;" >Send <i class="fa fa-paper-plane"></i> </button>  </div>
                                            </div>



                                            <div class="row">
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover  order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="selectall"></th>
                                                        <th> </th>
                                                        <th> Name </th>
                                                        <th> Gender </th>
                                                        <th> Staff's Email </th>
                                                        <th> Phone </th>
                                                        <th> Address </th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($staff as $std)
                                                        <tr class="odd gradeX">

                                                            <td><input type="checkbox" id="email" value="{{ $std->email }}" name="email[]"></td>

                                                            </form>
                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td>{{ $std->name }}</td>
                                                            <td>{{ $std->gender }}</td>
                                                            <td>{{ $std->email }}</td>
                                                            <td>{{ $std->phone }}</td>
                                                            <td>{{ $std->address }}</td>
                                                            


                                                           
                                                           



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

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#email_message').summernote({
                placeholder: 'Please Select Mail Template Or Type ',
                tabsize: 2,
                height: 100
            });
        });
    </script>
    <script>

function emailcheck(){

        var x = document.getElementById("email_name").value;



    if (x != "other") {


        $('#email_message').summernote('code', x);



    } else {
        $('#email_message').summernote('code', " ");
        $('#email_message').summernote({
            placeholder: 'Please Select Mail Template Or Type '
         });

    }



};

$(document).ready(function(){
    $("#selectall").click(function(){


        if($('#selectall').is(':checked')){
            $('input[name="email[]"]').prop('checked', true);


        }
        else {
            $('input[name="email[]"]').prop('checked', false);
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
