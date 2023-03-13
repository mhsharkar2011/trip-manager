@extends('layouts.app')

@section('title','Trips | Customer')

@section('content')
<div class="container">
            <div class="card">
        <div class="card-header">
            Customer Details
        </div>
        <div class="card-body">
            <h5>Customer Name</h5><p class="card-title">{{ $customer->first_name}} {{$customer->lirst_name }}</p>
            <h5>Contact Number</h5><p class="card-title">{{ $customer->contact_number }}</p>
            <p class="card-text">{{ $customer->avatar }}</p>
            <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.customers.edit',$customer->id) }}">Edit</a>
            <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.customers.index') }}">Go Back</a>
        </div>
        </div>
</div>   

@endsection
