@extends('layouts.master-admin')

@section('title','Vehicles')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="page-title text-white">Welcome to Durojan ! </h3>
                    <ul class="breadcrumb bg-dark">
                        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.vehicles.create') }}">Add Vehicle</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Vehicles <span class="badge bg-inverse-danger ml-2">#</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">
                            <table class="table table-dark text-white">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle Type</th>
                                        <th>SL No.</th>
                                        <th>Owner Name</th>
                                        <th>Vehicle Name</th>
                                        <th>Model</th>
                                        <th>ODO Meter</th>
                                        <th>Tank Capacity</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle )
                                    <tr>
                                        <td>{{ ++$id}}</td>
                                        <td>{{ $vehicle->vehicleType->title}}</td>
                                        <td>{{ $vehicle->sl_no}}</td>
                                        <td>
                                            @if ($vehicle->user == Null)
                                                {{ 'data not found' }}
                                                @else
                                                {{ $vehicle->user->full_name }}
                                            @endif
                                        </td>
                                        <td>{{ $vehicle->name}}</td>
                                        <td>{{ $vehicle->model}}</td>
                                        <td>
                                            @if ($vehicle->mileage == Null)
                                                {{ 'data not found' }}
                                                @else
                                                {{ $vehicle->mileage->total_mileage }}
                                            @endif
                                        </td>
                                        <td>{{ $vehicle->tank_capacity}}</td>
                                        <td>{{ $vehicle->created_at->format('Y-m-d')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">{{ $vehicles->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
