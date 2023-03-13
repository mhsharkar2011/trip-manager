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
            <div class="col-md-8 justify-content-center">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header bg-success text-white">Create New Vehicle </div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.vehicles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="label">SL No. </label>
                                <input type="text" name="sl_no" class="form-control bg-dark text-white" placeholder="Enter Vehicle SL Numnber" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                    <x-select-field name="owner_id" label="Select Owner" :options="$user->pluck('full_name', 'id')" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                    <x-select-field name="vehicle_type_id" label="Select Vehicle Type" :options="$vTypes->pluck('title', 'id')" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label">Vehicle Name: </label>
                                <input type="text" name="name" class="form-control bg-dark text-white" placeholder="Enter Vehicle Name" />
                            </div>


                            <div class="form-group">
                                <label class="label">Model: </label>
                                <input type="text" name="model" class="form-control bg-dark text-white" placeholder="Enter Model Number" />
                            </div>
                            <div class="form-group">
                                <label class="label">ODO Mileages: </label>
                                <input type="number" name="total_mileage" class="form-control bg-dark text-white" placeholder="Enter Total Odo" />
                            </div>
                            <div class="form-group">
                                <label class="label">Tank Capacity: </label>
                                <input type="number" name="tank_capacity" class="form-control bg-dark text-white" placeholder="Enter Tank Capacity" />
                            </div>
                            <div class="form-group">
                                <label class="label">Vehicle License No. </label>
                                <input type="text" name="license_no" class="form-control bg-dark text-white" placeholder="Enter License Number" />
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
@endsection