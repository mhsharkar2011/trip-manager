@extends('layouts.master-admin')

@section('title','User')

@section('content')
<div class="page-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">New User</div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="label">First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter  First Name" />
                            </div>
                            <div class="form-group">
                                <label class="label">Last Name: </label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter  Last Name" />
                            </div>
                            <div class="form-group">
                                <label class="label">Email: </label>
                                <input type="text" name="email" class="form-control" placeholder="Enter  Email" />
                            </div>
                            <div class="form-group">
                                <label class="label">Password: </label>
                                <input type="password" name="password" class="form-control" placeholder="Enter  Passwoprd" />
                            </div>
                                <x-select-field name="role" label="Select User Role" :options="$roles->pluck('name','name')" />
                            <br>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success text-uppercase" />
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection