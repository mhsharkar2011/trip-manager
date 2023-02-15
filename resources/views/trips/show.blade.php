@extends('layouts.app')

@section('title','Trips | List')

@section('content')
<div class="container">
            <div class="card">
        <div class="card-header">
            Trip Details
        </div>
        <div class="card-body">
            <h5>Customer Name</h5><p class="card-title">{{ $trip->user->full_name }}</p>
            <h5>Vehicle Name</h5><p class="card-title">{{ $trip->vehicle->name }}</p>
            <p class="card-text">{{ $trip->booking_date }}</p>
            <a style="float: right" class="btn btn-success text-right" href="{{ route('trips.index') }}">Go Back</a>
        </div>
        </div>
</div>   

@endsection
