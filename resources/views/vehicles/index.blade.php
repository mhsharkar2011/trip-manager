@extends('layouts.app')

@section('title','Vehicles')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Vehicle List</div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SL No.</th>
                                <th>Owner Name</th>
                                <th> Vehicle Name</th>
                                <th>Model</th>
                                <th>Tank Capacity</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $vehicle->sl_no}}
                                </td>
                                <td>
                                   @if ($vehicle->user == Null)
                                       {{ 'data not found' }}
                                       @else
                                       {{ $vehicle->user->full_name }}
                                   @endif
                                </td>
                                <td>
                                    {{ $vehicle->name}}
                                </td>
                                <td>
                                    {{ $vehicle->model}}
                                </td>
                                <td>
                                    {{ $vehicle->tank_capacity}}
                                </td>
                                <td>
                                    {{ $vehicle->created_at->format('Y-m-d')}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Vehicle Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Vehicle</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('vehicles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="label">SL No. </label>
                            <input type="text" name="sl_no" class="form-control" placeholder="Enter Vehicle SL Numnber" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Vehicle Name: </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Vehicle Name" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Model: </label>
                            <input type="text" name="model" class="form-control" placeholder="Enter Model Number" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Tank Capacity: </label>
                            <input type="text" name="tank_capacity" class="form-control" placeholder="Enter Tank Capacity" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">License No. </label>
                            <input type="text" name="license_no" class="form-control" placeholder="Enter License Number" />
                        </div>
                        {{-- <input type="hidden" name="vehicle_type_id" value="{{ $input }}" /> --}}
                        <br>
                        <div class="form-group">
                            <select class="form-select" name="vehicle_type_id">
                                <option value="">Select Vehicle Type</option>
                                @foreach ($vTypes as $vType)
                                    <option value="{{ $vType->id }}" >
                                        {{ $vType->title }}
                                    </option>
                                @endforeach
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
