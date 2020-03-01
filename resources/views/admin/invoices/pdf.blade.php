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
                    <div class="page-title">All Invoices List</div>
                                          
                                            <div class="table-scrollable">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student Name </th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($invoices))
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td>{{ $loop->index +1 }}</td>

                                                            <td>
                                                                {{ $invoice->student_name }}
                                                            </td>
                                                          
                                                            <td>
                                                                <a href="{{route('invoice.edit', $invoice->id)}}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button href="javascript:" rel="{{$invoice->id}}" rel1="delete-invoice" class="btn btn-danger btn-xs deleteRecord" >
                                                                    <i class="fa fa-trash-o "></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
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