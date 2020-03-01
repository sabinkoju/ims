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
                    <div class="page-title">All Batches List</div>
                </div>
                <div class="table-scrollable">
                    <center>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Batch Name </th>
                                <th> Year </th>
                                <th> Month </th>
                                <th>Courses</th>
                                <th> Shift </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($batch as $batch)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>

                                    <td>
                                        {{ $batch->batch_name }}
                                    </td>
                                    <td>{{$batch->year}}</td>
                                    <td> {{ $batch->month }}</td>
                                    <?php $batch_courses = $batch->courses->sortBy('name')->pluck('id'); ?>
                                    <td>
                                        @foreach($batch_courses as $data)
                                            <li>
                                                {{ \App\Course::find($data)->name }}
                                            </li>
                                            @endforeach
                                    </td>
                                        <?php $batch_shifts = $batch->shifts->sortBy('shift_available')->pluck('id'); ?>
                                    <td>
                                        @foreach($batch_shifts as $data)
                                            <li>
                                                {{ \App\Shift::find($data)->shift_available }}
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

function printBatch(){
    window.print();
}
</script>