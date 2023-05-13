@extends('layouts.master-admin')

@section('title','Users')

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
                        <a style="float: right" class="btn btn-dark bg-inverse-success text-right" href="{{ route('admin.users.create') }}">Add User</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Users <span class="badge bg-inverse-danger ml-2">{{ $totalUsers }}</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">
                            <table class="table table-bordered table-dark text-white align-middle text-center">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user )
                                    <tr>
                                        <td>{{ ++$id}}</td>
                                        <td class="text-start">{{ $user->full_name}}</td>
                                        <td class="text-start">{{ $user->email}}</td>
                                        <td>{{ $user->role}}</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editUser({{ $user->id }})"><i class="fa fa-pencil m-r-5"></i>  Edit</a>
                                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="dropdown-item" href="#" onclick="deleteUser({{ $user->id }})">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination justify-content-center">
            {{-- {{ $users->links() }}  --}}
            {{ $users->links('components.pagination') }}
        </div>
    </div>
</div>


<script>
function editUser(id) {
    window.location.href = '/users/' + id + '/edit';
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        document.getElementById('delete-form-' + userId).submit();
    }
}

</script>
@endsection
