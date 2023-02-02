@extends('layouts.app')

@section('title','Fuel | List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5" id="fuel-list">
            <div class="card">
                <div class="card-header bg-success text-white">Fuel List <span class="badge bg-danger">{{ $fuels->count() }}</span></div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Filling Date</th>
                                <th>Quantity</th>
                                <th>Price (Taka) </th>
                                <th>Gas Station</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fuels as $fuel )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $fuel->refueling}}

                                </td>
                                <td>
                                    {{ $fuel->volume }}
                                </td>
                                <td>
                                    {{ $fuel->cost }}
                                </td>
                                <td>
                                    {{ $fuel->gas_station}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $fuels->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Vehicle Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Fuel Type</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('fuels.store') }}">
                        @csrf
                        <div class="form-group">Vehicle Name
                            <select class="form-select" name="vehicle_id">
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" >
                                        {{ $vehicle->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">Fuel Type
                            <select class="form-select" name="fuel_type_id">
                                <option value="">Select Fuel</option>
                                @foreach ($fuelTypes as $fType)
                                    <option value="{{ $fType->id }}" >
                                        {{ $fType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Refueling Date: </label>
                            <input type="datetime-local" name="refueling" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Fuel Quantity: </label>
                            <input type="number" name="volume" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Amount (Taka): </label>
                            <input type="number" name="cost" class="form-control" placeholder="Enter Fuel Cost" />
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="label">Gas Station: </label>
                            <input type="text" name="gas_station" class="form-control" placeholder="Enter Gas Station Name" />
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
