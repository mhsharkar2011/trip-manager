@extends('layouts.master-admin')
@section('content')
  
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title text-white">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active text-secondary">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="{{ route('employee.card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('admin.employees.index') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('all/employee/list/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="row col-sm-6 col-md-9" style="margin-top: -32px">
                     <x-form-input  col="4" label="" id="id" for="id" name="id" type="text" class="floating form-focus -mt-4" style="height:50px" placeholder="Employee ID" value=""  />
                     <x-form-input  col="4" label="" id="name" for="name" name="name" type="text" class="floating form-focus" style="height:50px" placeholder="Employee Name" value=""  />
                     <x-form-input  col="4" label="" id="email" for="email" name="email" type="text" class="floating form-focus" style="height:50px" placeholder="Email" value=""  />
                    </div>
                     <div class="col-sm-6 col-md-3">  
                         <button type="sumit" class="btn btn-success btn-block" style="width:100%"> Search </button>  
                     </div>
                 </div>
            </form>
            <!-- Search Filter -->
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark text-white custom-table datatable">
                            <thead>
                                <tr class="text-white">
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>
                                    <th>Email</th>
                                    <th class="text-nowrap">Join Date</th>
                                    {{-- <th>Role</th> --}}
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-white">
                                @foreach ($employees as $employee )
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/'.$employee->id) }}" class="avatar"> <x-employee-avatar :userAvatar="$employee->avatar" width="38" height="38" /> </a>
                                            <a class="text-white text-decoration-none" href="{{ url('employee/profile/'.$employee->id) }}">{{ $employee->name }}<span></span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->birth_date }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->created_at }}</td>
                                    {{-- <td>{{ $employee->role_name }}</td> --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('all/employee/view/edit/'.$employee->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <form id="delete-form-{{ $employee->id }}" action="{{ route('admin.employees.destroy', $employee->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="dropdown-item" href="#" onclick="deleteData({{ $employee->id }})"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.employees.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name</label>
                                        <select class="form-select" id="full_name" name="name">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user )
                                                <option value="{{ $user->first_name . ' ' . $user->last_name }}" data-user_id={{ $user->id }} data-employee_email={{ $user->email }}>{{ $user->first_name . ' ' . $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="employee_email" name="email" placeholder="Auto email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="birth_date" name="birth_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-select form-control" id="gender" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Auto id employee" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Module Permission</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Write</th>
                                            <th class="text-center">Create</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Import</th>
                                            <th class="text-center">Export</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $key = 0;
                                            $key1 = 0;
                                        ?>
                                        {{-- @foreach ($permission_lists as $lists )
                                        <tr>
                                            <td>{{ $lists->permission_name }}</td>
                                            <input type="hidden" name="permission[]" value="{{ $lists->permission_name }}">
                                            <input type="hidden" name="id_count[]" value="{{ $lists->id }}">
                                            <td class="text-center">
                                                <input type="checkbox" class="read{{ ++$key }}" id="read" name="read[]" value="Y"{{ $lists->read =="Y" ? 'checked' : ''}} >
                                                <input type="checkbox" class="read{{ ++$key1 }}" id="read" name="read[]" value="N" {{ $lists->read =="N" ? 'checked' : ''}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="write{{ ++$key }}" id="write" name="write[]" value="Y" {{ $lists->write =="Y" ? 'checked' : ''}}>
                                                <input type="checkbox" class="write{{ ++$key1 }}" id="write" name="write[]" value="N" {{ $lists->write =="N" ? 'checked' : ''}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="create{{ ++$key }}" id="create" name="create[]" value="Y" {{ $lists->create =="Y" ? 'checked' : ''}}>
                                                <input type="checkbox" class="create{{ ++$key1 }}" id="create" name="create[]" value="N" {{ $lists->create =="N" ? 'checked' : ''}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="delete{{ ++$key }}" id="delete" name="delete[]" value="Y" {{ $lists->delete =="Y" ? 'checked' : ''}}>
                                                <input type="checkbox" class="delete{{ ++$key1 }}" id="delete" name="delete[]" value="N" {{ $lists->delete =="N" ? 'checked' : ''}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="import{{ ++$key }}" id="import" name="import[]" value="Y" {{ $lists->import =="Y" ? 'checked' : ''}}>
                                                <input type="checkbox" class="import{{ ++$key1 }}" id="import" name="import[]" value="N" {{ $lists->import =="N" ? 'checked' : ''}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="export{{ ++$key }}" id="export" name="export[]" value="Y" {{ $lists->export =="Y" ? 'checked' : ''}}>
                                                <input type="checkbox" class="export{{ ++$key1 }}" id="export" name="export[]" value="N" {{ $lists->export =="N" ? 'checked' : ''}}>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>
    <script>
        // select auto id and email
        $('#full_name').on('change',function()
        {
            $('#user_id').val($(this).find(':selected').data('user_id'));
            $('#employee_email').val($(this).find(':selected').data('employee_email'));
        });
    </script>
    @endsection
@endsection
