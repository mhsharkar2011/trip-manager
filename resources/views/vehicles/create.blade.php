@extends('layouts.master-admin')

@section('title','Vehicles')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title text-white"></h3>
                        {{-- <ul class="breadcrumb bg-dark"></ul> --}}
                    </div>
                </div>
            </div>

        <div class="row justify-content-center">
            <div class="col-md-6 justify-content-center">
                <div class="card mb-3">
                    <div class="card-header bg-dark text-white col-md-12"> 
                            <div class="row m-2">
                            <div class="col-md-6 float-left">
                                Create New Vehicle
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="bg-inverse-info rounded p-2 text-decoration-none text-white" href="{{ route('admin.vehicles.index') }}">Vehicle List</a>
                            </div>
                        </div>
                    </div>
                    
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.vehicles.store') }}">
                            @csrf
                            <div class="row">
                                <x-form-select class="col-md-12" name="vehicle_type_id" label="Select Vehicle Type" :options="$vTypes->pluck('title', 'id')" />
                                <x-form-select class="col-md-6" name="owner_id" label="Select Owner" :options="$user->pluck('full_name', 'id')" />
                                <x-form-input col="6" type="text" label="Vehicle Name" name="name" id="name" placeholder="Enter Vehicle Name Here" class="" value="" />
                                <x-form-input col="6" type="text" label="Vehicle Model" name="model" id="model" placeholder="Enter Vehicle Model Here" class="" value="" />
                                <x-form-input col="6" type="number" label="ODO Mileages:" name="total_mileage" id="total_mileage" placeholder="Enter ODO Mileages Here" class="" value="" />
                                <x-form-input col="6" type="number" label="Vehicle Tank Capacity:" name="tank_capacity" id="tank_capacity" placeholder="Enter Tank Capacity" class="" value="" />
                                <x-form-input col="6" type="text" label="Vehicle License No." name="license_no" id="license_no" placeholder="Enter License Number" class="" value="" />
                            </div>
                            <div class="form-group text-center mt-4">
                                <input type="submit" class="btn btn-dark text-uppercase" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection