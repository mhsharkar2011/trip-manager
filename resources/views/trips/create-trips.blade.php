@extends('layouts.master-admin')

@section('title','Trips | From')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- Trip From --}}
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <a style="float: center" class="btn btn-success text-center" href="">Trips Form</a>
                    <a style="float:right" class="btn btn-success text-center" href="{{ asset('trips') }}">Trips List</a>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="{{ route('admin.trips.store') }}">
                        @csrf

                        <div class="col-md-6">
                            <label class="form-label">Packages</label>
                            <select class="form-select" name="package_id">
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" >
                                        {{ $package->title }} {{ '-' }} {{ $package->package_amount }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="label">Booking ID: </label>
                            <input type="number" name="booking_id" class="form-control" />
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Booking Date: </label>
                            <input type="datetime-local" id="date" name="booking_date" class="form-control" />
                        </div>
                        <br>

                        <div class="col-md-6">
                            <label class="form-label">Driver Name</label>
                            <select class="form-select" name="driver_id">
                                <option value="">Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" >
                                        {{ $driver->first_name }}
                                        {{ $driver->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <select class="form-select" name="customer_id">
                            <option value="">Select customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" >
                                    {{ $customer->first_name }}
                                    {{ $customer->last_name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                          
                        <div class="col-md-6">
                        <label class="form-label">Vehicle Name</label>
                        <select class="form-select" name="vehicle_id">
                            <option value="">Select Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" >
                                    {{ $vehicle->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="label">Booking Period: </label>
                                <input type="number" name="booking_period" class="form-control" />
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <label class="label">Advance </label>
                            <input type="number" name="advance_amount" class="form-control" />
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label class="label">Bkash Charge </label>
                            <input type="number" name="bkash_charge" class="form-control" />
                        </div> --}}
                        <br>

                        <div class="col-md-6">
                            <label class="label">Other Cost </label>
                            <input type="number" name="cost_amount" class="form-control" />
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Cost Details </label>
                            <input type="text" name="cost_details" class="form-control" />
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label class="label">Balance In </label>
                            <input type="number" name="balance_in" class="form-control" />
                        </div>
                        <br> --}}
                        
                        
                        
                        <div class="form-group">
                            <label class="label">From Area: </label>
                            <input type="textarea" row="5" name="from_area" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">To Area: </label>
                            <input type="textarea" row="5" name="to_area" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Mileages</label>
                            <input type="number" name="distance" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Trip Earning:</label>
                            <input type="number" name="trip_earning" class="form-control" />
                        </div>
                        <br>

                        <div class="col-md-12">
                            <label for="status" class="form-label">Trip Status</label>
                            <select class="form-select" name="status">
                                <option value="">Select Trip Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                          </div>
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
