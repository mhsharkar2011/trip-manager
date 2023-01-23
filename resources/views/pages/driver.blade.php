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
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user )
        <tr>
            <td>{{ $id++ }}</td>
            <td>
                {{ $user->full_name}}
            </td>
            <td>{{ $user->created_at }}</td>
               
            </tr>
            <tr>
                <td>
                    <table class="table table-dark table-striped table-bordered table-hover table-sm m-12">
                        @foreach ($user->vehicles as $vehicle )
                            <tr>
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
                    </table>
                </td>
            </tr>
            @endforeach
    </tbody>
    
</table>
@endsection
