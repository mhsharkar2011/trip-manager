@extends('layouts.master-admin')

@section('title','Users')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
            <div class="row d-flex">
                <div class="col-sm-2">
                    <a class="btn btn-success text-start" href="{{ route('admin.users.create') }}">Add User</a>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class=" text-white border-secondary">
                                <tr class="text-center">
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white border-secondary align-middle">
                                    @foreach ($users as $user )
                                    <tr>
                                        <td>{{ ++$id}}</td>
                                        <td>{{ $user->full_name}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->role}}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editUser({{ $user->id }})"><i class="fa fa-pencil m-r-5"></i>  Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
                            <div class="pagination justify-content-center">
                                {{ $users->links() }} 
                            </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    function editUser(id) {
    window.location.href = '/users/' + id + '/edit';
}
</script>
@endsection
