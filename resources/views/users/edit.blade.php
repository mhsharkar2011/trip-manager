@extends('layouts.master-admin')

@section('title','User')

@section('content')
{{-- Vehicle Insert --}}
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
            <div class="row d-flex">
                <div class="col-sm-2">
                    <a class="btn btn-success text-start" href="{{ route('admin.users.create') }}">Add User</a>
                </div>
                <div class="row">
                    <div class="col-md-8 mt-5 justify-content-center">
                        <div class="card bg-dark">
                            <div class="card-header bg-success text-white">User Add Form</div>
                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.users.update',$user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="label">First Name:</label>
                                        <input type="text" name="first_name" class="form-control bg-dark text-white" value="{{ $user->first_name }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Last Name: </label>
                                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"/>
                                    </div>
                                    <div class="form-group"><input type="hidden" name="email" class="form-control" value="{{ $user->email }}"/></div>
                                    <div class="form-group text-center">
                                        <input type="submit" class="btn btn-success text-uppercase" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection