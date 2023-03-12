@extends('layouts.master-admin')
@section('title')
Dashboard- Admin Panel
@endsection

@section('content')
 {{-- message --}}
 {!! Toastr::message() !!}
 <!-- Statistics Widget -->
<div class="page-wrapper">
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title text-white">Welcome {{ $usersName }} ! </h3>
                <ul class="breadcrumb bg-dark">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <x-card  count="{{ $totalCount ?? '0' }}" label="Total Trips" link="{{ route('admin.trips.index') }}" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $customerCount ?? '0' }}" label="Total Customer" link="#" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $vehicles->count() ?? '0' }}" label="Total Vehicles" link="{{ route('admin.vehicles.index') }}" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $earning ?? '0' }}" label="Total Earning" link="#" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $drivers->count() ?? '0' }}" label="Drivers" link="#" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $packages->count() ?? '0' }}" label="Packages" link="#" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $attendance->count() ?? '0' }}" label="Today Attendence" link="#" linktext="View Details" icon="fa fa-cubes" />
            <x-card  count="{{ $left ?? '0' }}" label="Leaved Records" link="#" linktext="View Details" icon="fa fa-cubes" /> --}}

            <x-card count="{{ $tripCount ?? '0' }}"     label="Total Trips"        icon="fa fa-cubes" />
            <x-card count="{{ $customerCount ?? '0' }}" label="Total Client"     icon="fa fa-user" />
            <x-card count="{{ $vehicleCount ?? '0' }}"  label="Total Vehicles"     icon="fa fa-car" />
            <x-card count="{{ $earning ?? '0' }}"            label="Total Earning"      icon="fa fa-usd" />

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <x-chart color="text-white" title="Total Revenue" chartId="bar-charts" />
                <x-chart color="text-white" title="Sales Overview<" chartId="line-charts" />
            </div>
        </div>
    </div>

    <div class="row">
        <x-progress-bar col="3" bgdark="dark" color="white" title="New Trips" percent="{{ $totalTrips }}" totalValue="{{ $tripCount }}" footerTitle="Overall Employee"  />
        <x-progress-bar col="3" bgdark="dark" color="white" title="New Client" percent="{{ $totalTrips }}" totalValue="{{ $customerCount }}" footerTitle="Overall Client"  />
        <x-progress-bar col="3" bgdark="dark" color="white" title="New Vehicle" percent="{{ $totalVehicles }}" totalValue="{{ $vehicleCount }}" footerTitle="Overall Vehicle"  />
        <x-progress-bar col="3" bgdark="dark" color="white" title="Current Month Earning" percent="{{ $totalTrips }}" totalValue="{{ $earningCount ?? '0' }}" footerTitle="Overall Earning"  />
    </div>

    <!-- Statistics Widget -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
            <div class="card flex-fill dash-statistics border-secondary text-white">
                <div class="card-body bg-dark border-secondary">
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
                        <div class="stats-info bg-dark border-dark">
                            <p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
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

        <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
            <div class="card flex-fill bg-dark text-white">
                <div class="card-body">
                    <h4 class="card-title text-white">Task Statistics</h4>
                    <div class="statistics">
                        <div class="row">
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box bg-dark mb-4">
                                    <p>Total Tasks</p>
                                    <h3>385</h3>
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box bg-dark mb-4">
                                    <p>Overdue Tasks</p>
                                    <h3>19</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
                    </div>
                    <div>
                        <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="float-right">166</span></p>
                        <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks <span class="float-right">115</span></p>
                        <p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span class="float-right">31</span></p>
                        <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span class="float-right">47</span></p>
                        <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span class="float-right">5</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body bg-dark text-white">
                    <h4 class="card-title total text-white">Today Absent <span class="badge bg-inverse-danger ml-2">5</span></h4>
                    <div class="leave-info-box">
                        <div class="media align-items-center">
                            <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
                            <div class="media-body">
                                <div class="text-sm my-0">Martin Lewis</div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-6">
                                <h6 class="mb-0">4 Sep 2019</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                            <div class="col-6 text-right"> <span class="badge bg-inverse-danger">Pending</span> </div>
                        </div>
                    </div>
                    <div class="leave-info-box">
                        <div class="media align-items-center">
                            <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
                            <div class="media-body">
                                <div class="text-sm my-0">Martin Lewis</div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-6">
                                <h6 class="mb-0">4 Sep 2019</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                            <div class="col-6 text-right"> <span class="badge bg-inverse-success">Approved</span> </div>
                        </div>
                    </div>
                    <div class="load-more text-center"> <a class="text-dark" href="javascript:void(0);">Load More</a> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Statistics Widget -->

</div>
</div>

@endsection
