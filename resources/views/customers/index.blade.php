@extends('layouts.master-admin')

@section('title','customers')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="page-title text-white">Welcome to Durojan ! </h3>
                    <ul class="breadcrumb bg-dark mt-2">
                        {{-- <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.customers.create') }}">Add Client</a> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Clients <span class="badge bg-inverse-danger ml-2"> {{ $customers->count() }}</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">
                            <table class="table table-bordered table-dark text-white align-middle text-center">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                        </thead>
                            <tbody>
                                @foreach ($customers as $customer )
                                <tr>
                                    <td>{{ $customer->id}}</td>
                                    <td class="text-start">
                                        <x-avatars.customers :userAvatar="$customer->avatar" width="48" height="48" class="rounded-circle" />
                                        <span style="margin-left:20px">
                                        {{ $customer->first_name}} {{ $customer->last_name}}
                                        </span>                                        
                                    </td>
                                    <td>{{ $customer->address}}</td>
                                    <td>{{ $customer->contact_number}}</td>
                                    <td>
                                        <form action="{{ route('admin.customers.update-status', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                                <div>
                                                    <select style="display:none" name="status" id="status" class="badge bg-inverse-primary ml-2">
                                                        @if ($customer->status == 1)
                                                        <div class=" badge bg-inverse-success ml-2">
                                                        <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}></option>
                                                        </div>
                                                        @else
                                                        <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}></option>
                                                        @endif
                                                    </select>
                                                </div>
                                    
                                            <button type="submit" class="btn">
                                                @if ($customer->status != 1)
                                                <span class="badge bg-inverse-warning ml-2">INACTIVE</span>
                                                @else
                                                <span class="badge bg-inverse-success ml-2">ACTIVE</span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="editClient({{ $customer->id }})">
                                                     <i class="fa fa-pencil m-r-5"></i>  Edit
                                                </a>
                                                <form id="delete-form-{{ $customer->id }}" action="{{ route('admin.customers.destroy', $customer->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData({{ $customer->id }})">
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
                        <div class="pagination bg-dark justify-content-center">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function editClient(id) {
    // Redirect to the edit trip page with the trip ID as a parameter
    window.location.href = '/customers/' + id + '/edit';
}
</script>

@endsection
