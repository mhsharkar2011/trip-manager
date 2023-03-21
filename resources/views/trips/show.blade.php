@extends('layouts.master-admin')

@section('title','Trips | List')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
            <!-- Page Header -->
        <div class="page-header">
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded ">
                    <div class="card-header bg-dark  text-white text-center pt-4">
                        <h1 class="text-uppercase">Trip Details</h1>
                    </div>
                    <div class="card-body text-center justify-content-start">
                        <div class="row">
                            <div class="col-lg-12 justify-content-center">
                                <div class="row">
                                    <div class="col-md-4">
                                    
                                    </div>
                                    <div class="col-md-8 text-start">
                                    <h2><span class=" font-bold text-info">Package &nbsp;&nbsp;:&nbsp;</span> <span class="text-success">{{ $trip->package->title }} - {{ $trip->package->package_amount }}</span></h2>
                                    <h4><span class=" font-bold text-info">Vehicle Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; </span> <span class="text-success">{{ $trip->vehicle->name }}</span></h4>
                                    <h4><span class=" font-bold text-info">Driver Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; </span> <span class="text-success">{{ $trip->driver->first_name }} {{ $trip->driver->last_name }}</span></h4>
                                    <h4><span class=" font-bold text-info">Customer Name :&nbsp;</span> <span class="text-success">{{ $trip->customer->full_name }}</span></h4>
                                    <h4><span class=" font-bold text-info">Booking Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</span> <span class="text-success">{{ $trip->booking_date }}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-dark text-white border-0 text-center pt-3">
                        @if ($trip->status != 'Pending')
                        <h4>
                            Trip Completed @ {{\Carbon\Carbon::parse($trip->booking_date)->diff(Carbon\Carbon::now())->format('%y years, %m months, %d days') }} 
                        </h4>
                        
                        @endif

                        @if ($trip->status == 'Pending')
                        <h4>
                            Trip Pending @ {{\Carbon\Carbon::parse($trip->booking_date)->diff(Carbon\Carbon::now())->format('%y years, %m months, %d days') }} 
                        </h4>
                        
                        @endif
                    </div>
                </div>
                <a style="float: right" class="btn btn-white text-right" href="{{ route('admin.trips.index') }}">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
