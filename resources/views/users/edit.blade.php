@extends('layouts.master-admin')

@section('title','User')

@section('content')
{{-- Vehicle Insert --}}

        <div class="row d-flex">
            <div class="col-md-8 mt-5 justify-content-center">
                <div class="card">
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
                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"/>
                            </div>
                            <div class="form-group">
                                <label class="label">Last Name: </label>
                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"/>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="email" class="form-control" value="{{ $user->email }}"/>
                            </div>
                            <div class="form-group">
                                <x-select-field name="role" label="Select Role" :options="$roles->pluck('name', 'id')"  />
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success text-uppercase" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection