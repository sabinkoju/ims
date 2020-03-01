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

<body>
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">
                       
                        All Students List
                           
               
      
                                                                                      
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
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
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($student as $std)
                                                        <tr class="odd gradeX">

                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td></td>
                                                            <td>{{ $std->fname }}</td>
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
                                                            <td>

                                                                @if(!empty($trashed))
                                                                <a href="{{ route('restoreStudent', $std->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-undo"></i>
                                                                </a>


                                                                <a href="javascript:" rel="{{ $std->id }}" rel1="delete-student" class="btn btn-danger btn-xs deleteRecord">
                                                                    <i class="fa fa-trash-o "></i>
                                                                </a>



                                                                    @else
                                                                <a href="{{ route('editStudent', $std->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button href="javascript:" rel="{{ $std->id }}" rel1="trash-student" class="btn btn-danger btn-xs deleteRecord" >
                                                                    <i class="fa fa-trash-o "></i>
                                                                </button>

                                                                @endif
                                                            </td>



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



</body>
</html>