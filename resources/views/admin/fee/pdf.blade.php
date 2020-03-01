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
                    <div class="page-title">All Fees List</div>
               
                
                                            <div class="table-scrollable">
                                                <table
                                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        
                                                        <th> Student  </th>
                                                        <th> Course  </th>
                                                        <th> Course_Fees </th>
                                                        <th> Fee Paid</th>
                                                        <th>Mode Of Payment</th>
                                                        <th>Received By</th> 
                                                                                                         
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                     <tbody>
                                                    @foreach($fees as $fee)
                                                        <tr>
                                                            <td>{{ $loop->index +1 }}</td>
                                                            
                                                            <td>
                                                                {{ $fee->students->fname }} {{ $fee->students->lname }}</td>
                                                                
                                                                  <td>  {{ $fee->courses->name }}</td>
                                                                
                                                                <td>
                                                            Rs. {{ $fee->course_fee }}</td>
                                                            <td>{{ $fee->fees_paid }}</td>
                                                            <td>{{ $fee->mode_of_payment }}</td>
                                                            <td>{{ $fee->received_by }}</td>
                                                            
                                                            <td>
                                                                <a href="{{ route('editFees', $fee->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                    <button href="javascript:" rel="{{$fee->id }}" rel1="delete-fee" class="btn btn-danger btn-xs deleteRecord" >
                                                                        <i class="fa fa-trash-o "></i>
                                                                    </button>
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