@extends('layouts.master-admin')

@section('title')
Dashboard- Admin Panel
@endsection

@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
        <div class="row">
            <x-card col="3" color="white" linkcolor="white"  bgcolor="primary" count="{{ $trips->count() }}" label="Total Trips" link="{{ route('admin.trips.index') }}" linktext="View Details" />
            <x-card col="3" color="white" linkcolor="white"  bgcolor="success" count="{{ $customers ?? '0' }}" label="Total Customer" link="#" linktext="View Details" />
            <x-card col="3" color="white" linkcolor="white"  bgcolor="danger" count="{{ $vehicles->count() }}" label="Total Vehicles" link="{{ route('admin.vehicles.index') }}" linktext="View Details" />
            <x-card col="3" color="dark" linkcolor="dark"  bgcolor="warning" count="{{ $earning ?? '0' }}" label="Total Earning" link="#" linktext="View Details" />
            <x-card col="3" color="white" linkcolor="white"  bgcolor="info" count="{{ $drivers ?? '0' }}" label="Drivers" link="#" linktext="View Details" />
            <x-card col="3" color="white" linkcolor="white"  bgcolor="secondary" count="{{ $packages ?? '0' }}" label="Packages" link="#" linktext="View Details" />
            <x-card col="3" color="white" linkcolor="white"  bgcolor="dark" count="{{ $attendance ?? '0' }}" label="Today Attendence" link="#" linktext="View Details" />
            <x-card col="3" color="dark" linkcolor="dark"   bgcolor="light" count="{{ $leaved ?? '0' }}" label="Leaved Records" link="#" linktext="View Details" />
        </div>
        @endsection
