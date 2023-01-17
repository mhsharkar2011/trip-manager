@extends('layouts.app')

@section('title','Driver')

@section('content')
<ul>
    @foreach ($drivers as $driver )
        <li>
            {{ $driver}}
        </li>
    @endforeach
    </ul>
@endsection
