@extends('layouts.master-admin')

@section('title','Drivers')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    {{-- <h3 class="page-title text-white">Welcome to Durojan ! </h3> --}}
                    <ul class="breadcrumb bg-dark mt-2">
                        {{-- <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.drivers.create') }}">Add Driver</a> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Drivers <span class="badge bg-inverse-danger ml-2">{{ $drivers->count() }}</span> 
                        </h3>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif 
                    </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">
                            <table class="table table-bordered table-dark text-white align-middle text-center">
                                <thead class="border-secondary">
                                    <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Driver Name</th>
                                    <th>Driver License</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                                <tbody class="text-white">
                                    @foreach ($drivers as $driver )
                                    <tr>
                                        <td>{{ ++$id}}</td>
                                        <td> <x-driver-avatar :userAvatar="$driver->avatar" width="68" height="68" /> </td>
                                        <td>{{ $driver->first_name}} {{ $driver->last_name}}</td>
                                        <td>{{ $driver->driving_license}}</td>
                                        <td>{{ $driver->contact_number}}</td>
                                        <td>{{ $driver->address}}</td>
                                        <td>
                                            <form action="{{ route('admin.drivers.update-status', $driver->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    <div>
                                                        <select style="display:none" name="status" id="status" class="badge bg-inverse-primary ml-2">
                                                            @if ($driver->status == 1)
                                                            <div class=" badge bg-inverse-success ml-2">
                                                            <option value="0" {{ $driver->status == 0 ? 'selected' : '' }}></option>
                                                            </div>
                                                            @else
                                                            <option value="1" {{ $driver->status == 1 ? 'selected' : '' }}></option>
                                                            @endif
                                                        </select>
                                                    </div>
                                        
                                                <button type="submit" class="btn">
                                                    @if ($driver->status != 1)
                                                    <span class="badge bg-inverse-warning ml-2">INACTIVE</span>
                                                    @else
                                                    <span class="badge bg-inverse-success ml-2">ACTIVE</span>
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="showDriver({{ $driver->id }})">
                                                        <i class="fa fa-info m-r-5"></i> View
                                                    </a>                                                    
                                                    <a class="dropdown-item" href="#" onclick="editDriver({{ $driver->id }})"><i class="fa fa-pencil m-r-5"></i>  Edit</a>
                                                    <form id="delete-form-{{ $driver->id }}" action="{{ route('admin.drivers.destroy', $driver->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    <a class="dropdown-item" href="#" onclick="deleteDriver({{ $driver->id }})">
                                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                                    </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        <div class="pagination justify-content-center">{{ $drivers->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    function showDriver(show) {
        // Redirect to the edit trip page with the trip ID as a parameter
        window.location.href = '/drivers/' + show;
    }
    function editDriver(id) {
    window.location.href = '/drivers/' + id + '/edit';
}
function deleteDriver(driverId) {
    if (confirm('Are you sure you want to delete this driver?')) {
        document.getElementById('delete-form-' + driverId).submit();
    }
}
</script>

@endsection
