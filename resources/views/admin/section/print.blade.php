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

<body onload="printSection()">

    
      <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Sections List</div>
                </div>
              
          
                                       
                <div class="table-scrollable">
                    <center>
                        <div id='printTable'>
                        
                            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Section Name </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $section)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{$section->section_name}}</td>
                                        
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

function printSection(){
    window.print();
}
</script>