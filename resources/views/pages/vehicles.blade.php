@extends('layouts.app')

@section('title','Vehicles')

@section('content')
@php
    static $id = 1;
@endphp
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle No.</th>
            <th>Name</th>
            <th>License No.</th>
            <th>Model</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle )
        <tr>
            <td>{{ $id++ }}</td>
                <td>
                    {{ $vehicle->sl_no}}
                </td>
                <td>
                    {{ $vehicle->name}}
                </td>
                <td>
                    {{ $vehicle->license_no}}
                </td>
                <td>
                    {{ $vehicle->model}}
                </td>
                <td>
                    {{ $vehicle->details}}
                </td>

            </tr>
            @endforeach
    </tbody>
</table>
@endsection