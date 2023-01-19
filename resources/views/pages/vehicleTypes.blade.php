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
            <th>Vehicle Type</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicleTypes as $vType )
        <tr>
            <td>{{ $id++ }}</td>
                <td>
                    {{ $vType->title}}
                </td>
                <td>
                    {{ $vType->created_at}}
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
@endsection
