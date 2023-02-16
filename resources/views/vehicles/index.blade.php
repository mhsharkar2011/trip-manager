@extends('layouts.master-admin')

@section('title','Vehicles')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Total Vehicle <span class="badge bg-danger"> {{ $vehicles->count() }} </span></div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SL No.</th>
                                <th>Owner Name</th>
                                <th> Vehicle Name</th>
                                <th>Model</th>
                                <th>ODO Meter</th>
                                <th>Tank Capacity</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $vehicle->sl_no}}
                                </td>
                                <td>
                                   @if ($vehicle->user == Null)
                                       {{ 'data not found' }}
                                       @else
                                       {{ $vehicle->user->full_name }}
                                   @endif
                                </td>
                                <td>
                                    {{ $vehicle->name}}
                                </td>
                                <td>
                                    {{ $vehicle->model}}
                                </td>
                                <td>
                                    @if ($vehicle->mileage == Null)
                                       {{ 'data not found' }}
                                       @else
                                       {{ $vehicle->mileage->total_mileage }}
                                   @endif
                                </td>
                                <td>
                                    {{ $vehicle->tank_capacity}}
                                </td>
                                <td>
                                    {{ $vehicle->created_at->format('Y-m-d')}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
