@extends('layouts.app')

@section('title','Trips | List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <a class="btn btn-success" href="">Trips List</a>
                    <a style="float: right" class="btn btn-success text-right" href="{{ asset('trips/create') }}">Create New Trips</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>Booking Date</th>
                                <th>Customer Name</th>
                                <th>Booking ID</th>
                                <th>Package</th>
                                <th>Vehicle</th>
                                <th>Booking Period</th>
                                <th>Status</th>
                                <th>Advance</th>
                                <th>Advance</th>
                                <th>Bkash Charge</th>
                                <th>Fuel</th>
                                <th>Toll</th>
                                <th>Other Cost</th>
                                <th>Total Bill</th>
                                <th>Balance In</th>
                                <th>Trip Earning</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $trip )
                            <tr>
                                <td>
                                {{ ++$id}}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                                <td>
                                    {{ $trip->user->full_name }}
                                </td>

                                <td>
                                    {{$trip->vehicle->name}}
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
                                    <a class="btn btn-success" href="#">Edit</a>
                                    <a class="btn btn-danger" href="#">delete</a>
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
    </div>
</div>

@endsection
