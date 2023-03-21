@extends('layouts.master-admin')

@section('title','Trips | List')

@section('content')
<div class="page-wrapper">
<!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
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

                            <x-form-input col="12" type="text" label="Package Name" for="package_id" id="package_id" name="package_id" class="" placeholder="" value="{{ str_limit($trip->package->title) }} - {{ $trip->package->package_amount }}"  readonly/>
                            <x-form-input col="6" type="text" label="Booking ID:" for="booking_id" id="booking_id" name="booking_id" class="" placeholder="" value="{{ $trip->booking_id }}"  />
                            <x-form-input col="6" type="datetime-local" label="Booking Date:" for="booking_date" id="booking_date" name="booking_date" class="" placeholder="" value="{{  $trip->booking_date  }}"  />
                            <x-form-input col="6" type="number" label="Booking Period:" for="booking_period" id="booking_period" name="booking_period" class="" placeholder="" value="{{ $trip->booking_period }}"  />
                            <x-form-input col="6" type="number" label="Advance Amount" for="advance_amount" id="advance_amount" name="advance_amount" class="" placeholder="" value="{{ $trip->advance_amount }}"  />
                            <x-form-input col="6" type="number" label="Bkash Charge" for="bkash_charge" id="bkash_charge" name="bkash_charge" class="" placeholder="" value="{{ $trip->bkash_charge }}"  />
                            @if ($trip->balance_in > 0)
                            <x-form-input col="6" type="number" label="Balance In" name="balance_in" id="balance_in" for="balance_in" placeholder="" class="form-control text-danger" value="{{ $trip->balance_in }}" />
                            @endif
                            @if ($trip->balance_in == 0)
                            <x-form-input col="6" type="number" label="Balance In" name="balance_in" id="balance_in" for="balance_in" placeholder="" class="form-control text-success" value="{{ $trip->balance_in }}" />
                            @endif
                            <!------------------------------ Expese Section Start----------------------------->
                            <x-form-input col="6" type="text" label="Fuel Name" for="fuel_name" id="fuel_name" name="fuel_name" class="" placeholder="" value="{{ $trip->fuel_name }}"  />
                            <x-form-input col="6" type="number" label="Fuel Amount" for="fuel_amount" id="fuel_amount" name="fuel_amount" class="" placeholder="" value="{{ $trip->fuel_amount }}"  />
                            <x-form-input col="6" type="text" label="Item Name (Other)" for="item_name" id="item_name" name="item_name" class="" placeholder="" value="{{ $trip->item_name }}"  />
                            <x-form-input col="6" type="number" label="Cost Amount" for="amount" id="amount" name="amount" class="" placeholder="" value="{{ $trip->amount }}"  />
            
                            <!------------------------------ Expese Section End ----------------------------->
                            <x-form-textarea label="From Area: " for="from_area" id="from_area" name="from_area" class="" placeholder="From Area" value="{{ $trip->from_area }}" style="width:487px; margin-right:10px"  />
                            <x-form-textarea label="To Area:" for="to_area" id="to_area" name="to_area" class="" placeholder="To Area" value="{{ $trip->to_area }}" style="width:489px; margin-left:4px"  />
                            

                            <x-form-input col="6" type="number" label="Mileages" for="distance" id="distance" name="distance" class="" placeholder="" value="{{ $trip->distance }}"  />
                            <x-form-input col="6" type="number" label="Trip Earning:" for="trip_earning" id="trip_earning" name="trip_earning" class="" placeholder="" value="{{ $trip->trip_earning }}"  />
                            <div class="form-group text-center mt-4">
                                <input type="submit" class="btn btn-success text-uppercase" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection