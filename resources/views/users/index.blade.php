@extends('layouts.master-admin')

@section('title','Users')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="page-title text-white">Welcome ! </h3>
                    <ul class="breadcrumb bg-dark">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                    
                </div>
            </div>
        </div>
            <div class="row d-flex">
                
                <div class="col-lg-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class=" text-white border-secondary">
                                <tr class="text-center">
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white border-secondary align-middle">
                                    @foreach ($users as $user )
                                    <tr>
                                        <td>
                                           {{ $user->id}}
                                        </td>
                                        <td>
                                            {{ $user->full_name}}
                                            
                                        </td>
                                        <td>
                                            {{ $user->email}}
                                        </td>
                                        <td>
                                            {{ $user->role}}
                                        </td>
                                        <td>
                                            <x-link-button route="{{ route('admin.users.show', $user->id) }}" label="" icon="fas fa-eye" class="btn btn-info" />
                                            <x-link-button route="{{ route('admin.users.edit', $user->id) }}" label="" icon="fas fa-pencil" class="btn btn-danger" />
                                        </td>
                                        {{-- <td><x-delete-button route="{{ route('admin.users.destroy', $user->id) }}" label="" icon="fas fa-trash" class="btn btn-danger" /></td> --}}
                                        </tr>
                                        @endforeach
                                </tbody>
            
                            </table>
                            <div class="pagination justify-content-center">
                                {{-- {{ $Users->links() }} --}}
                            </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-success text-start" href="{{ route('admin.users.create') }}">Add User</a>
                </div>
            </div>
    </div>
</div>
@endsection
