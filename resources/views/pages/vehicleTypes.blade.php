@extends('layouts.app')

@section('title','Vehicles')

@section('content')

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Car Name</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicletypes as $vType )
        <tr>
            <td>1</td>
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
