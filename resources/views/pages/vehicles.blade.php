@extends('layouts.app')

@section('title','Vehicles')

@section('content')
<ul>
    @foreach ($vehicles as $data )
        <li>
            {{ $data}}
        </li>
    @endforeach
    </ul>
@endsection
