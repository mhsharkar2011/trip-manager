@extends('layouts.app')

@section('title','Vehicles')

@section('content')
{{-- @php
    static $id = 1;
@endphp --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Vehicle List</div>
                <div class="card-body">
                    <table class="table table-dark table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Owner Name</th>
                                <th> Vehicle Name</th>
                                <th>Model</th>
                                <th>Tank Capacity</th>
                                <th>License No.</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle )
                            <tr>
                                <td>
                                    {{ $vehicle->sl_no}}
                                </td>
                                <td>
                                    {{-- {{ $vehicle->user->first_name}} --}}
                                </td>
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
                                    {{-- <td>
                                        @foreach ($vehicle->mileages as $mileage )
                                                {{ $mileage->total_mileage }}
                                        @endforeach
                                    </td> --}}
                                    <td>
                                        {{ $vehicle->created_at}}
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>

                </div>
            </div>
        </div>
        <div class="col-4">
            @once
                @include('vehicles.create');
            @endonce
        </div>
    </div>
</div>

@endsection
