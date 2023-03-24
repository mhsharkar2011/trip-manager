@extends('layouts.master-admin')
@section('title')
Dashboard- Admin Panel
@endsection

@section('content')

<!-- Loader -->
<div id="loader-wrapper">
    <div id="loader">
        <div class="loader-ellips">
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
        </div>
    </div>
</div>
<!-- /Loader -->

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title text-white">Welcome {{ $usersName }} ! </h3>
                    <ul class="breadcrumb bg-dark">
                        {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Top Cards -->
        <div class="row">
            <x-card count="{{ $tripCount ?? '0' }}"     label="Total Trips"        icon="fa-solid fa-truck-plane" />
            <x-card count="{{ $driverCount ?? '0' }}"   label="Total Driver"       icon="fa fa-user" />
            <x-card count="{{ $vehicleCount ?? '0' }}"  label="Total Vehicles"     icon="fa fa-car" />
            <x-card count="{{ $totalEarn ?? '0' }}"     label="Total Earning"      icon="fa fa-usd" />
        </div>
        <!-- Page Chart -->
        <div class="row">
            <div class="col-md-6 d-flex">
                {!! $chartTripEarn->container() !!}
                {!! $chartTripEarn->script() !!}
            </div>
            <div class="col-md-6 d-flex"> 
                {!! $chartTripProfit->container() !!}
                {!! $chartTripProfit->script() !!}
            </div>
        </div>
                
        <!-- Page Progress Bar -->
        <div class="row mt-4">
            <x-card-progress-bar col="3" bgdark="dark" color="white" title="Trips"    headerValue="{{ $totalTripsAmount ?? '0' }}" totalValue="{{ $currentMonthTrips }}"    footerTitle="Previous Month Trips" footerValue="{{ $lastMonthTrips }}" />
            <x-card-progress-bar col="3" bgdark="dark" color="white" title="Earnings" headerValue="{{ $totalEarn ?? '0' }}"        totalValue="{{ $currentMonthEarn }}"     footerTitle="Previous Month"       footerValue="{{ $lastMonthEarn }}" />
            <x-card-progress-bar col="3" bgdark="dark" color="white" title="Expenses" headerValue="{{ $totalExpenses ?? '0' }}"    totalValue="{{ $currentMonthExpenses }}" footerTitle="Previous Month"       footerValue="{{ $lastMonthExpenses }}" />
            <x-card-progress-bar col="3" bgdark="dark" color="white" title="Profit  " headerValue="{{ $totalProfit ?? '0' }}"      totalValue="{{ $currentMonthProfit }}"   footerTitle="Previous Month"       footerValue="{{ $lastMonthProfit }}" />
        </div>

        <!-- Statistics Widget -->
        <div class="row">
            <!-- Statistics Start-->
            <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill dash-statistics border-secondary text-white">
                    <div class="card-body bg-dark">
                        <h5 class="card-title text-white">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info bg-dark border-dark">
                                <p>Today Leave <strong>4 <small>/ 65</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info bg-dark border-dark ">
                                <p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <x-progress-bar bg="success" label="Completed Trips" value="{{ $completedTrips }}" totalValue="{{ $tripCount }}" />
                            <x-progress-bar bg="warning" label="Pending Trips" value="{{ $pendingTrips }}" totalValue="{{ $tripCount }}" />
                            <div class="stats-info bg-dark border-dark">
                                <p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info bg-dark border-dark">
                                <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistics Start-->

            <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill bg-dark text-white border-secondary">
                    <div class="card-body">
                        <h4 class="card-title text-white">Trip Statistics</h4>
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box bg-dark mb-4 border-secondary">
                                        <p>Total Trips</p>
                                        <h3>{{ $trips->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box bg-dark mb-4 border-secondary">
                                        <p>Pending Trips</p>
                                        <h3>{{ $pendingTrips }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress mb-4">
                            {{-- <x-progress-bar bg="purple" label="" value="30" totalValue="{{ $tripCount }}">30%</x-progress-bar> --}}
                            <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $completedTrips }}" aria-valuenow="{{ $completedTrips}}" aria-valuemin="0" aria-valuemax="100">{{ $completedTrips }}%</div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
                        </div>
                        <div>
                            <p><i class="fa fa-dot-circle-o text-purple mr-2"></i> Completed Trips <span class="float-right">{{ $completedTrips }}</span></p>
                            <p><i class="fa fa-dot-circle-o text-warning mr-2"></i> Inprogress Trips <span class="float-right">0</span></p>
                            <p><i class="fa fa-dot-circle-o text-success mr-2"></i> On Hold Trips <span class="float-right">0</span></p>
                            <p><i class="fa fa-dot-circle-o text-danger mr-2"></i> Pending Trips <span class="float-right">{{ $pendingTrips }}</span></p>
                            <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i> Review Trips <span class="float-right">0</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill border-secondary text-white">
                    <div class="card-body bg-dark text-white">
                        <h4 class="card-title total text-white">Today Absent <span class="badge bg-inverse-danger ml-2">0</span></h4>
                        @foreach ($drivers as $driver )
                        <div class="leave-info-box border-secondary">
                            <div class="media align-items-center">
                                <x-driver-avatar :user="$driver->avatar" width="38" height="38" class="rounded-circle" />
                                <div class="media-body">
                                    <div class="text-sm my-0">{{ $driver->full_name }}</div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-6">
                                    <h6 class="mb-0">{{ $driver->created_at }}</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                                <div class="col-6 text-right"> <span class="badge bg-inverse-danger">{{ $driver->status }}</span> </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="load-more text-center"> <a class="text-white text-decoration-none bg-dark" href="javascript:void(0);">Load More</a> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Statistics Widget -->

        <!-- Report Section Start-->
        <div class="row">
            <!-- Invoices Start -->
            <div class="col-md-6 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Invoices</h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-dark">
                            <table class="table table-dark text-white">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Client</th>
                                        <th>Due Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="invoice-view.html">#INV-0001</a></td>
                                        <td>
                                            <h2 ><a class="text-white text-decoration-none" href="#">Global Technologies</a></h2>
                                        </td>
                                        <td>11 Mar 2019</td>
                                        <td>$380</td>
                                        <td> <span class="badge bg-inverse-warning ">Partially Paid</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-dark">
                        <a class="text-white text-decoration-none" href="invoices.html">View all invoices</a>
                    </div>
                </div>
            </div>
            <!-- Invoices End -->
            <!-- Payment Start -->
            <div class="col-md-6 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Payment</h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table-responsive">
                            <table class="table table-dark text-white">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Client</th>
                                        <th>Payment Type</th>
                                        <th>Paid Date</th>
                                        <th>Paid Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="invoice-view.html">#INV-0001</a></td>
                                        <td>
                                            <h2 ><a class="text-white text-decoration-none" href="#">Global Technologies</a></h2>
                                        </td>
                                        <td>Bikash</td>
                                        <td>8 Feb 2019</td>
                                            <td>$380</td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-dark">
                        <a class="text-white text-decoration-none" href="invoices.html">View all Payment</a>
                    </div>
                </div>
            </div>
            <!-- Payment End -->
            <!-- Client Start -->
            <div class="col-md-6 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">New Clients</h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-dark">
                            <table class="table table-dark text-white">
                                <thead class="border-secondary">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact number</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)   
                                    <tr>
                                        <td><x-client-avatar :user="$client->avatar" width="48" height="48" class="rounded-circle" /></td>
                                        <td>{{ $client->full_name }}</td>
                                        <td>
                                            <h2 ><a class="text-white text-decoration-none" href="#">{{ $client->user->email }}</a></h2>
                                        </td>
                                        <td>{{ $client->contact_number }}</td>
                                        <td>{{ $client->status }}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editClient({{ $client->id }})">
                                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.customers.destroy', $client->id) }}" method="post">
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
                    </div>
                    <div class="card-footer bg-dark">
                        <a class="text-white text-decoration-none" href="{{ route('admin.customers.index') }}">View all client</a>
                    </div>
                </div>
            </div>
            <!-- Client End -->
            <!-- Recent Trips Start -->
            <div class="col-md-6 d-flex">
                <div class="card card-table border-secondary flex-fill">
                    <div class="card-header bg-dark">
                        <h3 class="card-title text-white mb-0">Recent Trips</h3> 
                    </div>
                    <div class="card-body bg-dark">
                        <div class="table-responsive">
                            <table class="table table-dark custom-table mb-0">
                                <thead class="border-secondary text-white">
                                    <tr>
                                        <th>Packages</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white">
                                    @foreach ($trips as $trip)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a class="text-white text-decoration-none hover-danger" href="{{ route('admin.trips.index') }}">{{ $trip->booking_id }}</a>
                                            </h2>
                                            <small class="block text-ellipsis">   
                                                <span>{{ $tripCount }}</span> <span class="text-muted">Booking Request, </span>
                                                <span>{{ $trip->booking_id }}</span> <span class="text-muted">Trips Completed</span>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
                                            </div>
                                        </td>
                                        <td> <span class="badge bg-inverse-warning text-end">{{ $trip->status }}</span></td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="pagination justify-content-center">{{ $trips->links() }}</div> --}}
                    </div>
                    <div class="card-footer bg-dark">
                        <a class="text-white text-decoration-none" href="{{ route('admin.trips.index') }}">View all trips</a>
                    </div>
                </div>
            </div>
            <!-- Recent Trips End -->
        </div>
        <!-- Report Section End -->

    </div>
</div>
<script>
    function editClient(id) {
    // Redirect to the edit trip page with the trip ID as a parameter
    window.location.href = '/customers/' + id + '/edit';
}
</script>

@endsection
