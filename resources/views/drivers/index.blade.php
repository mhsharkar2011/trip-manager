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
                        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.drivers.create') }}">Add Driver</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Drivers <span class="badge bg-inverse-danger ml-2">{{ $drivers->count() }}</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">
                            <table class="table table-bordered table-dark text-white align-middle text-center">
                                <thead class="border-secondary">
                                    <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Driver Name</th>
                                    <th>Contact Number</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                                <tbody class="text-white">
                                    @foreach ($drivers as $driver )
                                    <tr>
                                        <td>{{ ++$id}}</td>
                                        <td><x-client-avatar :user="$driver->avatar" width="48" height="48" class="rounded-circle" /></td>
                                        <td>{{ $driver->first_name}} {{ $driver->last_name}}</td>
                                        <td>{{ $driver->contact_number}}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editDriver({{ $driver->id }})"><i class="fa fa-pencil m-r-5"></i>  Edit</a>
                                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
    function editDriver(id) {
    window.location.href = '/drivers/' + id + '/edit';
}
</script>

@endsection
