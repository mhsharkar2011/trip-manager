@extends('layouts.master-admin')

@section('title','Trips | List')

@section('content')
<div class="page-wrapper">
<!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3 class="page-title text-white">Welcome to Durojan ! </h3>
                    <ul class="breadcrumb bg-dark">
                        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.trips.create') }}">Add Trips</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Recent Trips <span class="badge bg-inverse-danger ml-2">#</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table-responsive">
                            <table class="table table-dark text-white">
                                <thead class="border-secondary">
                                        <tr style="font-size: 12px; text-align: center;vertical-align: middle;">
                                            {{-- <th>SL No.</th> --}}
                                            <th>Booking ID</th>
                                            <th>Customer Name</th>
                                            <th>Driver Name</th>
                                            <th>Vehicle Name</th>
                                            {{-- <th>Package Details</th> --}}
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
                                            <th colspan="3" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trips as $trip )
                                        <tr>
                                            {{-- <td>{{ ++$id }}</td> --}}
                                            <td>
                                            {{ $trip->booking_id}}
                                            </td>
                                            <td>
                                                {{ $trip->customer->first_name ?? '' }}
                                                {{ $trip->customer->last_name ?? '' }}
                                            </td>

                                            <td>
                                                {{ $trip->driver->first_name ?? '' }}
                                                {{ $trip->driver->last_name ?? '' }}
                                            </td>

                                            <td>
                                                {{$trip->vehicle->name}}
                                            </td>

                                            {{-- <td>
                                                {{ str_limit($trip->package_details,'5') }}
                                            </td> --}}
                                            <td>
                                                {{ $trip->package_amount }}
                                            </td>
                                            {{-- <td>
                                                {{ Carbon\Carbon::parse($trip->booking_date)->format('Y/m/d h:i A') }}
                                                
                                            </td> --}}
                                            <td>
                                                {{ $trip->booking_period }}
                                            </td>
                                            <td>
                                                {{ $trip->advance_amount }}
                                            </td>
                                            <td>
                                                {{ $trip->bkash_charge }}
                                            </td>
                                            <td>
                                                {{ str_limit($trip->cost_details,'10') }}
                                            </td>
                                            <td>
                                                {{ $trip->cost_amount }}
                                            </td>
                                            <td>
                                                {{ $trip->balance_in }}
                                            </td>
                                            <td>
                                                {{ str_limit($trip->from_area,'5') }}
                                            </td>
                                            <td>
                                            {{ str_limit($trip->to_area,'5') }}
                                                
                                            </td>
                                            <td>
                                                {{ $trip->distance }}
                                            </td>
                                            <td>
                                                {{ $trip->trip_earning }}
                                            </td>
                                            <td>
                                                {{ $trip->status}}
                                            </td>
                                            <td>
                                                <a  class="btn btn-success mr-3" href="{{ route('admin.trips.show', $trip->id) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                        
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('admin.trips.edit', $trip->id)  }}"><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td>

                                                <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                
                                                    <button type="submit" class="btn btn-danger mr-3"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="pagination justify-content-center">{{ $trips->links() }}</div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection