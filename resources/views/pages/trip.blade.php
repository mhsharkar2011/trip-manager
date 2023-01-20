@extends('layouts.app')

@section('title','Vehicles')

@section('content')
@php
    static $id = 1;
@endphp

<table class="table table-dark table-striped table-bordered table-hover table-sm m-12">
    <thead>
        <tr>
            <th>ID</th>
            <th>Driver Name</th>
            <th>Vehicle Name</th>
            <th>Tank Capacity</th>
            <th>From Area</th>
            <th>To Area</th>
            <th>Mileages</th>
            <th>Cost</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trips as $trip )
        <tr>
            <td>{{ $id++ }}</td>
                @foreach ($trip->users as $user )
                    <td>
                        {{ $user->full_name}}
                    </td>
                @endforeach

                @foreach ($trip->vehicles as $vehicle )
                <td>
                    {{ $vehicle->name}}
                </td>
                <td>
                    {{ $vehicle->tank_capacity}}
                </td>
                @endforeach
            <td>
                {{ $trip->from_area}}
            </td>
            <td>{{ $trip->to_area }}</td>

            @foreach ($trip->vehicles as $vehicle )
            <td>
                @foreach ($vehicle->mileages as $mileage )
                    {{ $mileage->total_mileage }}
                @endforeach
            </td>
            @endforeach
            </tr>
            @endforeach
    </tbody>
    
</table>
@endsection
