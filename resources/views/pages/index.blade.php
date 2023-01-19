@extends('layouts.app')

@section('title','Vehicles')

@section('content')
@php
    static $id = 1;
@endphp

<table border="1" width="900px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle No.</th>
            <th>Name</th>
            <th>Model</th>
            <th>Tank Capacity</th>
            <th>License No.</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicleTypes as $vType )
        <tr>
            <td>{{ $id++ }}</td>
                <td>
                    {{ $vType->sl_no}}
                </td>
                <td>
                    {{ $vType->title}}
                    <div>
                        <table border="1">

                            @foreach ($vType->vehicles as $vehicle )
                            <tr>
                                <td>
                                    {{ $vehicle->name }}
                                </td>
                                <td>
                                    {{ $vehicle->model }}
                                </td>
                                <td>
                                    {{ $vehicle->tank_capacity }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </td>
                <td>
                    {{ $vType->model}}
                </td>
                <td>
                    {{ $vType->tank_capacity}}
                </td>
                <td>
                    {{ $vType->license_no}}
                </td>
                <td>
                    {{ $vType->created_at}}
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
@endsection
