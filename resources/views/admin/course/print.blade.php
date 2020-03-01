<!DOCTYPE html>
<html>
<head>
  <title> Institute Management System (IMS)</title>

  <style type="text/css">
    table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 0.1px solid black;
  text-align: center;
}

  </style>
</head>

<body onload="printCourse()">

    
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Courses List</div>
                </div>
                <div class="table-scrollable">
                    <center>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> </th>
                                    <th> Course Code </th>
                                    <th> Course Name </th>
                                    <th> Fees </th>
                                    <th> Duration (in Weeks) </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>
                                        @if(empty($course->image))
                                            <img src="{{ asset('uploads/course/course.png') }}" width="150px">
                                            @else
                                            <img src="{{ asset('uploads/course/'. $course->image) }}" alt="" width="150px">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $course->code }}
                                    </td>
                                    <td>{{$course->name}}</td>
                                    <td> Rs. {{ $course->fees }}</td>
                                    <td>{{ $course->duration }}</td>
                                    <td>
                                        @if($course->status == 1)
                                            <span class="label label-rouded label-menu label-success">Active</span>
                                            @else
                                            <span class="label label-rouded label-menu label-danger">In Active</span>
                                        @endif
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </center>
                </div>    
            </div>
        </div>
    </div>
                                       




</body>

<script>

function printCourse(){
    window.print();
}
</script>