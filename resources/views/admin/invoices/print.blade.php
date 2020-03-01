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

<body onload="printBatch()">

    
      <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Invoices List</div>
                </div>
                <div class="table-scrollable">
                    <center>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name </th>
                                    <th>Course </th>
                                    <th>Course_Fee </th>
                                    <th>Date </th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($invoices))
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->index +1 }}</td>

                                            <td>
                                                {{ $invoice->student_name }}</a>
                                            </td>
                                            
                                            <td>
                                                {{ $invoice->course_name }}
                                            </td>

                                            <td>
                                                {{ $invoice->course_fee }}
                                            </td>

                                            <td>
                                                {{ $invoice->date }}
                                            </td>

                                            <td>
                                                {{ $invoice->description }}
                                            </td>                                        
                                        
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </div>




</body>

<script>

function printInvoice(){
    window.print();
}
</script>