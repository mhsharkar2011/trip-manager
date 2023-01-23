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
            <th>Vehicle Name</th>
            <th>Driver Name</th>
            <th>Vehicle Model</th>
            <th>Tank Capacity</th>
            <th>License No.</th>
            <th>Mileages</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle )
        <tr>
            <td>{{ $id++ }}</td>
            <td>
                {{ $vehicle->name}}
            </td>
            <td>
                @foreach ($vehicle->users as $user )
                        {{ $user}}
                @endforeach
            </td>
                <td>
                    {{ $vehicle->model}}
                </td>
                <td>
                    {{ $vehicle->tank_capacity}}
                </td>
                <td>
                    {{ $vehicle->license_no}}
                </td>
                <td>
                    @foreach ($vehicle->mileages as $mileage )
                            {{ $mileage->total_mileage }}
                    @endforeach
                </td>
                <td>
                    {{ $vehicle->created_at}}
                </td>
            </tr>
            @endforeach
    </tbody>
    
</table>
@endsection
