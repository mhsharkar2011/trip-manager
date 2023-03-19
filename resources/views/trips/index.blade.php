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
                                <thead class="border-secondary text-wrap">
                                        <tr style="font-size: 14px; text-align: center;vertical-align: middle;">
                                            <th>SL No.</th>
                                            <th>Booking ID</th>
                                            <th>Booking Date </th>
                                            <th>Booking Period</th>
                                            <th>Package Name</th>
                                            <th>Package Amount</th>
                                            <th>Vehicle Name</th>
                                            <th>Driver Name</th>
                                            <th>Customer Name</th>
                                            <th>Advance</th>
                                            <th>Bkash Charge</th>
                                            <th>Total Bkash Charge</th>
                                            <th>Balance In</th>
                                            <th colspan="2" >Trip From/TO</th>
                                            <th >Distance</th>
                                            <th>Cost Details</th>
                                            <th>Total Cost</th>
                                            <th>Trip Earning</th>
                                            <th >Status</th>
                                            <th colspan="3" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($trips as $trip )
                                        <tr class="text-center">
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $trip->booking_id}}</td>
                                            <td class="text-wrap">{{ Carbon\Carbon::parse($trip->booking_date)->format('Y/m/d h:i A') }}</td>
                                            <td>{{ $trip->booking_period }}</td>
                                            <td>{{ str_limit($trip->package->title,'200') }}</td>
                                            <td>{{ $trip->package->package_amount }}</td>
                                            <td>{{$trip->vehicle->name}}</td>
                                            <td>{{ $trip->driver->first_name ?? '' }}{{ $trip->driver->last_name ?? '' }}</td>
                                            <td>{{ $trip->customer->first_name ?? '' }}{{ $trip->customer->last_name ?? '' }}</td>
                                            <td>{{ $trip->advance_amount }}</td>
                                            <td>{{ $trip->bkash_charge }}</td>
                                            <td>{{ $totalBkashCharge ?? '0' }}</td>
                                            <td>{{ $trip->balance_in }}</td>
                                            <td>{{ str_limit($trip->from_area,'5') }}</td>
                                            <td>{{ str_limit($trip->to_area,'5') }}</td>
                                            <td>{{ $trip->distance }}</td>
                                            <td>{{ str_limit($trip->cost_details,'10') }}</td>
                                            <td>{{ $trip->cost_amount }}</td>
                                            <td>{{ $trip->trip_earning }}</td>
                                            <td>{{ $trip->status}}</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editTrip({{ $trip->id }})">
                                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                                        </a>
                                                        </form>
                                                    </div>
                                                </div>
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
<script>
    function editTrip(id) {
    // Redirect to the edit trip page with the trip ID as a parameter
    window.location.href = '/trips/' + id + '/edit';
}

</script>

@endsection