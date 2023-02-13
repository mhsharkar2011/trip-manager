@extends('layouts.app')

@section('title','Trips | List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <a class="btn btn-success" href="#">Total Trip <span class="badge bg-danger"> {{ $trips->count() }} </span></a>
                    <a style="float: right" class="btn btn-success text-right" href="{{ asset('trips/create') }}">Create New Trips</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover table-sm m-12">
                            <thead>
                                <tr style="font-size: 12px; text-align: center;vertical-align: middle;">

                                    <th>SL No.</th>
                                    <th>Booking ID</th>
                                    <th>Customer Name</th>
                                    <th>Vehicle Name</th>
                                    <th>Package Details</th>
                                    <th>Trip Amount</th>
                                    <th>Booking Date</th>
                                    <th>Booking Period</th>
                                    <th>Advance</th>
                                    <th>Bkash Charge</th>
                                    <th>Cost Details</th>
                                    <th>Total Cost</th>
                                    <th>Balance In</th>
                                    <th colspan="2" >Trip From/TO</th>
                                    <th >Distance</th>
                                    <th>Trip Earning</th>
                                    <th >Status</th>
                                    <th colspan="2" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trips as $trip )
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>
                                    {{ $trip->booking_id}}
                                    </td>
                                    <td>
                                        {{ $trip->user->full_name }}
                                    </td>

                                    <td>
                                        {{$trip->vehicle->name}}
                                    </td>

                                    <td>
                                        {{ str_limit($trip->package_details,'5') }}
                                    </td>
                                    <td>
                                        {{ $trip->package_amount}}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($trip->bookig_date)->format('Y/m/d') }}
                                        {{-- {{ $trip->bookig_date->format('Y-m-d')}} --}}
                                        
                                    </td>
                                    <td>
                                        {{ $trip->booking_period}}
                                    </td>
                                    <td>
                                        {{ $trip->advance_amount}}
                                    </td>
                                    <td>
                                        {{ $trip->bkash_charge}}
                                    </td>
                                    <td>
                                        {{ str_limit($trip->cost_details,'10')}}
                                    </td>
                                    <td>
                                        {{ $trip->cost_amount}}
                                    </td>
                                    <td>
                                        {{ $trip->balance_in}}
                                    </td>
                                    <td>
                                        {{ str_limit($trip->from_area,'5')}}
                                    </td>
                                    <td>
                                       {{ str_limit($trip->to_area,'5')}}
                                        
                                    </td>
                                    <td>
                                        {{ $trip->distance}}
                                    </td>
                                    <td>
                                        {{ $trip->trip_earning}}
                                    </td>
                                    <td>
                                        {{ $trip->status}}
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ url('trips/edit-trip/'.$trip->id) }}">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ url('trips/destroy/'.$trip->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        </a>
                                    </td>
                                    </tr>
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="pagination justify-content-center">
                        {{ $trips->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
