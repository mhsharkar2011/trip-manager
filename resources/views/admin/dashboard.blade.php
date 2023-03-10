@extends('layouts.master-admin')

@section('title')
Dashboard- Admin Panel
@endsection

@section('content')


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
        <x-progress-bar col="4" bgdark="dark" color="white" title="New Trips" percent="{{ $totalTrips }}" totalValue="{{ $tripCount }}" footerTitle="Overall Employee"  />
    </div>
</div>

@endsection
