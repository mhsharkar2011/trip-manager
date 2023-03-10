@extends('layouts.master-admin')

@section('title','Users')

@section('content')
<div class="container">
    <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.users.create') }}">Add User</a>
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-sm m-12">
                    <thead class="table-dark">
                        <tr class="text-center" style="font-size: 22px;">
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td><x-link-button route="{{ route('admin.users.show', $user->id) }}" label="" icon="fas fa-eye" class="btn btn-info" /></td>
                                <td><x-link-button route="{{ route('admin.users.edit', $user->id) }}" label="" icon="fas fa-pencil" class="btn btn-danger" /></td>
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
        </div>
    </div>
</div>

@endsection
