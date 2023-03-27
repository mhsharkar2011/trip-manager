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
                    {{-- <h3 class="page-title text-white">Welcome to Durojan ! </h3> --}}
                    <ul class="breadcrumb bg-dark">
                        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.trips.create') }}">Add Trips</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark ">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title  text-secondary mb-0">Total Trips <span class="badge bg-inverse-danger ml-2">{{ $trips->count() }}</span> </h3> 
                            </div>
                            <div class="col-md-3">
                                <x-form-search /> 
                            </div>
                            <div class="col-md-3 text-end">
                                <h3 class="card-title  text-success mb-0">Completed Trips <span class="badge bg-inverse-danger ml-2">{{ $trips->where('status','Completed')->count() }}</span> </h3> 
                            </div>
                            <div class="col-md-3 text-end">
                                <h3 class="card-title  text-warning mb-0">Pending Trips <span class="badge bg-inverse-danger ml-2">{{ $trips->where('status','Pending')->count() }}</span> </h3> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="table-responsive md-5">
                            <table class="table table-striped table-dark table-sm align-middle text-white" id="tripDataTable">
                                <thead class=" text-wrap align-middle text-center font-bold">
                                    <tr>
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
                                        {{-- <th colspan="2" >Trip From/TO</th> --}}
                                        {{-- <th >Distance</th> --}}
                                        <th>Trip Earning</th>
                                        {{-- <th>Fuel Cost</th>
                                        <th>Other Cost</th> --}}
                                        <th>Total Expenses</th>
                                        <th>Total Profit</th>
                                        <th >Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trips as $trip )
                                    <tr class="text-center">
                                        <td>{{ ++$id }}</td>
                                        <td>{{ $trip->booking_id}}</td>
                                        <td class="text-wrap">{{ Carbon\Carbon::parse($trip->booking_date)->format('Y/m/d h:i A') }}</td>
                                        <td>{{ $trip->booking_period }}</td>
                                        <td>{{ str_limit($trip->package->title,'200') }}</td>
                                        <td>{{ $trip->package->package_amount }}</td>
                                        <td>{{$trip->vehicle->name}}</td>
                                        <td>{{ $trip->driver->first_name ?? '' }} {{ $trip->driver->last_name ?? '' }}</td>
                                        <td>{{ $trip->customer->first_name ?? '' }} {{ $trip->customer->last_name ?? '' }}</td>
                                        <td>{{ $trip->advance_amount }}</td>
                                        <td>{{ $trip->bkash_charge }}</td>
                                        <td>{{ $totalBkashCharge = ($trip->advance_amount/1000) * $trip->bkash_charge }}</td>
                                        <td>{{ $trip->balance_in }}</td>
                                        {{-- <td>{{ str_limit($trip->from_area,'5') }}</td>
                                        <td>{{ str_limit($trip->to_area,'5') }}</td> --}}
                                        {{-- <td>{{ $trip->distance }}</td> --}}
                                        <td>{{ $trip->trip_earning }}</td>
                                        {{-- <td>{{ str_limit($trip->fuel_amount,'10') }}</td>
                                        <td>{{ $trip->amount }}</td> --}}
                                        <td>{{ $trip->trip_expenses }}</td>
                                        <td>{{ $tripProfit = $trip->trip_earning - $trip->trip_expenses  }}</td>
                                        @if ($trip->status !== 'Pending')
                                            <td class="text-success">{{ $trip->status}}</td>
                                        @else
                                            <td class="text-warning">{{ $trip->status}}</td>
                                        @endif
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="showTrip({{ $trip->id }})">
                                                        <i class="fa fa-info m-r-5"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editTrip({{ $trip->id }})">
                                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <form id="delete-trip-form-{{ $trip->id }}" action="{{ route('admin.trips.destroy', $trip->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteTrip({{ $trip->id }})">
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

@section('script')
<script>
    function editTrip(edit) {
    // Redirect to the edit trip page with the trip ID as a parameter
    window.location.href = '/trips/' + edit + '/edit';
    }

    function showTrip(show) {
        // Redirect to the edit trip page with the trip ID as a parameter
        window.location.href = '/trips/' + show;
    }

    function deleteTrip(tripId) {
        if (confirm('Are you sure you want to delete this trip?')) {
            // Submit the form
            document.getElementById('delete-trip-form-' + tripId).submit();
        }
    }
    $("input:checkbox").on('click', function()
    {
        var $box = $(this);
        if ($box.is(":checked"))
        {
            var group = "input:checkbox[class='" + $box.attr("class") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        }
        else
        {
            $box.prop("checked", false);
        }
    });
    // select auto id and email
    $('#name').on('change',function()
    {
        $('#employee_id').val($(this).find(':selected').data('employee_id'));
        $('#email').val($(this).find(':selected').data('email'));
    });
</script> 

<script type="text/javascript">
    $(document).ready(function() {
        $('#tripDataTable').DataTable({
            "paging": true,
            "searching": false,
            "ordering": true,
            "drawCallback": function (settings) {
                var pagination = $(this).closest('.dataTables_wrapper').find('.pagination');
                pagination.toggle(this.api().page.info().pages > 1);
                if (pagination.children().length !== 0) {
                    pagination.twbsPagination('destroy');
                }
                pagination.twbsPagination({
                    totalPages: this.api().page.info().pages,
                    visiblePages: 5,
                    onPageClick: function (event, page) {
                        this.api().page(page - 1).draw(false);
                    }.bind(this)
                });
            }
        });
    });
</script>


    @endsection
@endsection