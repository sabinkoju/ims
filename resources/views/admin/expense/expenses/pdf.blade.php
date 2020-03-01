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
                    <div class="page-title">All Expenses List</div>
                </div>
               
                                            <div class="table-scrollable">
                                                <table
                                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        id="example4">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Expense Category </th>
                                                        <th> Received By </th>
                                                        <th> Amount </th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($expense as $expense)
                                                        <tr>
                                                            <td>{{ $loop->index +1 }}</td>
                                                            <td>{{$expense->expensecategory->expense_category_name}}</td>
                                                            <td>{{$expense->received_by}}</td>
                                                            <td>{{$expense->amount}}</td>
                                                            <td>
                                                                <a href="{{ route('editExpense', $expense->id) }}"
                                                                   class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                    <button href="javascript:" rel="{{ $expense->id }}" rel1="delete-expense" class="btn btn-danger btn-xs deleteRecord" >
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