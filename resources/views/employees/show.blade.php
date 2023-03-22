@extends('layouts.app')

@section('title','Trips | User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>User Details</h2>
        </div>
        <div class="card-body text-secondary ">
            <h5 class="text-dark" >Full Name</h5><p class="card-body col-md-4 shadow-outline-indigo">{{ $user->first_name}} {{$user->larst_name }}</p>
            <h5 class="text-dark" >Email</h5><p class="card-body col-md-4 shadow-outline-indigo">{{ $user->email ?? 'No Data Found' }}</p>
            <h5 class="text-dark" >Contact Number</h5><p class="card-body col-md-4 shadow-outline-indigo">{{ $user->contact_number ?? 'No Data Found' }}</p>
            <h5 class="text-dark" >User Roles</h5><p class="card-body">{{ $user->role }}</p>
            <p class="card-text">{{ $user->avatar }}</p>
            <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.users.index') }}">Go Back</a>
        </div>
</div>
</div>   

@endsection
