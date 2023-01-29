@extends('layouts.app')

@section('title','Trips | List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <a class="btn btn-success" href="">Trips List</a>
                    {{-- <a style="float: right" class="btn btn-success text-right" href="{{ asset('trips/create') }}">Create New Trips</a> --}}
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Driver Name</th>
                                <th>Vehicle Name</th>
                                <th>From Area</th>
                                <th>To Area</th>
                                <th>Mileages</th>
                                <th>Rate</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $trip )
                            <tr>
                                <td>
                                {{ ++$id}}
                                </td>
                                
                                
                                <td>
                                    {{ $trip->users->full_name }}
                                </td>

                                <td>
                                    {{$trip->vehicles->name}}
                                </td>

                                <td>
                                    {{ str_limit($trip->from_area,'10') }}
                                </td>
                                <td>
                                    {{ $trip->to_area}}
                                </td>
                                <td>
                                    {{ $trip->mileages}}
                                </td>
                                <td>
                                    {{ $trip->rate}}
                                </td>
                                <td>
                                    {{ $trip->created_at->format('Y-m-d')}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>

                    </table>
                    <div class="pagination justify-content-center">
                        {{ $trips->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <a style="float: center" class="btn btn-success text-center" href="">Trips Form</a>
                    {{-- <a style="float:right" class="btn btn-success text-center" href="{{ asset('trips') }}">Trips List</a> --}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('trips.store') }}">
                        @csrf
                        <div class="form-group">Driver Name
                            <select class="form-select" name="user_id">
                                <option value="">Select Driver</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" >
                                        {{ $user->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
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
                            <input type="number" name="mileages" class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Rate</label>
                            <input type="number" name="rate" class="form-control" />
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
