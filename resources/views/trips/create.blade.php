{{-- @extends('layouts.app')

@section('title','Trips | Form')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <a class="btn btn-success" href="">Trips Form</a>
                    <a style="float: right" class="btn btn-success text-right" href="{{ asset('trips') }}">Trips List</a>
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
@endsection   --}}