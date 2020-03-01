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
                    <div class="page-title">All Teachers List</div>
                </div>
               
                                      
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> </th>
                                                        <th> Name </th>
                                                        <th> Phone </th>
                                                        <th> Courses </th>
                                                        <th> Teacher's Category </th>
                                                        <th> Timing </th>
                                                        <th> Email </th>
                                                        <th>Address</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($teachers as $teacher)
                                                        <tr class="odd gradeX">
                                                            <td class="patient-img">
                                                                @if(!empty($teacher->image))
                                                                    <img src="{{ asset('uploads/profile/'.$teacher->image) }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @else
                                                                    <img src="{{ asset('uploads/profile/profile.png') }}"
                                                                         alt="{{ $teacher->name }}">
                                                                @endif
                                                            </td>
                                                            <td class="left"> {{ $loop->index +1 }}</td>
                                                            <td>{{ $teacher->name }}</td>

                                                            <td>
                                                                @if(!empty($teacher->phone))

                                                                    {{ $teacher->phone }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <?php $teacher_courses = $teacher->courses->sortBy('name')->pluck('id'); ?>
                                                            <td>
                                                                @foreach($teacher_courses as $data)
                                                                    <li>
                                                                        {{ \App\Course::find($data)->name }}
                                                                    </li>
                                                                @endforeach
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->teacher_category_id))

                                                                    {{ $teacher->teacher_category->cat_name }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>


                                                            <td>
                                                                @if(!empty($teacher->timing))

                                                                    {{ $teacher->timing }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>



                                                            <td>{{ $teacher->email }} </td>
                                                            <td class="left">
                                                                @if(!empty($teacher->address))
                                                                    {{ $teacher->address }}
                                                                @else
                                                                    Not Available
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('editTeachers', $teacher->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>

                                                                    <a href="javascript:" rel="{{ $teacher->id }}" rel1="trash-teacher" class="btn btn-danger btn-xs deleteRecord">
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </a>

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
