@extends('layouts.app')

@section('title','Trips | From')

@section('content')

{{-- Trip Update From --}}
<div class="container">
    <div class="row justify-content-center">
        {{-- Trip From --}}
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <a style="float:right" class="btn btn-success text-center" href="{{ asset('trips') }}">Trips List</a>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="{{ route('admin.trips.update',$trip->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label class="label">Booking ID: </label>
                            <input type="number" name="booking_id" class="form-control" value="{{ $trip->booking_id }}"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Booking Date: </label>
                            <input type="datetime-local" name="bookig_date" class="form-control" value="{{ $trip->booking_date }}" />
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="label">Booking Period: </label>
                            <input type="number" name="booking_period" class="form-control" value="{{ $trip->booking_period }}" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Advance </label>
                            <input type="number" name="advance_amount" class="form-control" value="{{ $trip->advance_amount }}"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Bkash Charge </label>
                            <input type="number" name="bkash_charge" class="form-control" value="{{ $trip->bkash_charge }}"/>
                        </div>
                        <br>

                        <div class="col-md-6">
                            <label class="label">Other Cost </label>
                            <input type="number" name="cost_amount" class="form-control" value="{{ $trip->cost_amount }}"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Cost Details </label>
                            <input type="text" name="cost_details" class="form-control" value="{{ str_limit($trip->cost_details,'10') }}"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Package Details </label>
                            <input type="text" name="package_details" class="form-control" value="{{ str_limit($trip->package_details,'5') }}"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="label">Package Amount</label>
                            <input type="number" name="package_amount" class="form-control" value="{{ $trip->package_amount }}"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Balance In </label>
                            <input type="number" name="balance_in" class="form-control" value="{{ $trip->balance_in }}"/>
                        </div>
                        <br>
                        
                        
                        
                        <div class="form-group">
                            <label class="label">From Area: </label>
                            <input type="textarea" row="5" name="from_area" class="form-control" value="{{ str_limit($trip->from_area,'5') }}"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">To Area: </label>
                            <input type="textarea" row="5" name="to_area" class="form-control" value="{{ str_limit($trip->to_area,'5') }}"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Mileages</label>
                            <input type="number" name="distance" class="form-control" value="{{ $trip->distance }}"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Trip Earning:</label>
                            <input type="number" name="trip_earning" class="form-control" value="{{ $trip->trip_earning }}"/>
                        </div>
                        <br>

                        <div class="col-md-12">
                            <label for="status" class="form-label">Trip Status</label>
                            <select class="form-select" name="status">
                                <option value="{{ $trip->status}}">{{ $trip->status}}</option>
                                @if ($trip->status !== "Pending")
                                    <option value="Pending">Pending</option>
                                @endif
                                @if ($trip->status !== "Completed")
                                    <option value="Completed">Completed</option>
                                @endif
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