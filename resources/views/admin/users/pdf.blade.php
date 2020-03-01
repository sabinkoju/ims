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
                <div class="page-title">All Users List</div>
            </div>
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> </th>
                            <th> Name </th>
                            <th> User Role </th>
                            <th> Phone </th>
                            <th> Email </th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="odd gradeX">
                                <td class="patient-img">
                                    @if(!empty($user->image))
                                        <img src="{{ asset('uploads/profile/'.$user->image) }}"
                                            alt="{{ $user->name }}">
                                        @else
                                        <img src="{{ asset('uploads/profile/profile.png') }}"
                                                alt="{{ $user->name }}">
                                    @endif
                                </td>
                                <td class="left"> {{ $loop->index +1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="left">{{ $user->role->name }}</td>
                                <td>
                                    @if(!empty($user->phone))

                                            {{ $user->phone }}
                                        @else
                                        Not Available
                                    @endif
                                </td>
                                <td>{{ $user->email }} </td>
                                <td class="left">
                                    @if(!empty($user->address))
                                        {{ $user->address }}
                                    @else
                                        Not Available
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
                            
</body>
</html>
