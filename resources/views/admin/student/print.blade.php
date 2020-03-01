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

<body onload="printStudent()">

    
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Students List</div>
                </div>
                <div class="table-scrollable">
                    <center>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Gender </th>
                                    <th> Date Of Birth </th>
                                    <th> Students's Email </th>
                                    <th> Phone </th>
                                    <th> Address </th>
                                    <th>Category</th>
                                    <th>Courses</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $std)
                                <tr class="odd gradeX">

                                    <td class="left"> {{ $loop->index +1 }}</td>
                                    <td class="patient-img">  @if(!empty($std->image))
                                            <img src="{{ asset('uploads/profile/'.$std->image) }}"
                                                    alt="{{ $std->fname }} {{ $std->lname }}">
                                        @else
                                            <img src="{{ asset('uploads/profile/profile.png') }}"
                                                    alt="{{ $std->fname }} {{ $std->lname }}">
                                        @endif</td>
                                    <td><a href="{{route('studentprofile',$std->id)}}">{{ $std->fname }}</a></td>
                                    <td>{{ $std->lname }}</td>
                                    <td>{{ $std->gender }}</td>
                                    <td>{{ $std->dob }}</td>
                                    <td>{{ $std->email }}</td>
                                    <td>{{ $std->phone }}</td>
                                    <td>{{ $std->address }}</td>
                                    <td>{{ $std->student_category->name }}</td>


                                    <?php $student_courses = $std->courses->sortBy('name')->pluck('id'); ?>
                                    <td>
                                        @foreach($student_courses as $data)
                                            <li>
                                                {{ \App\Course::find($data)->name }}
                                            </li>
                                        @endforeach
                                    </td>
                                
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                     </center>
                </div>    
            </div>
        </div>
    </div>
                                       




</body>

<script>

function printStudent(){
    window.print();
}
</script>