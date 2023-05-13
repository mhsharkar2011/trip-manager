@extends('layouts.master-admin')

@section('title','Trips | Package')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mt-4">
            <div class="mb-4"><span><a class="btn btn-dark text-white text-right bg-inverse-success" href="{{ route('admin.trip-packages.index') }}">All Packages</a></span>
            </div>
            <div class="row">
                <div class="col-md-8">
                    {{-- Package Insert --}}
                    <div class="card border-secondary bg-dark text-white">
                        <div class="card-header  bg-inverse-secondary text-white">
                            <div class="row">
                                <div class="col-md-6"><span>Create New Package</span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <x-messages.alert :status="session('status')" :route="route('admin.trip-packages.index')" />
                            <form method="post" action="{{ route('admin.trip-packages.store') }}">
                                @csrf
                                <div class="row">
                                    <x-form-input col="" type="text" label="Package Name:" for="title" id="title" name="title" class="form-control bg-dark text-white" placeholder="Enter Package Name" value="" />
                                    <x-form-input col="" type="number" label="Package Amount:" for="package_amount" id="package_amount" name="package_amount" class="form-control bg-dark text-white" placeholder="Enter Package Amount" value="" />
                                    <x-form-textarea class="mt-4" label="Package Details" for="package_details"  id="package_details" name="package_details" placeholder="Enter Package Details" value="" style="height:200px; width:100%"/>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <input type="submit" class="btn btn-dark bg-inverse-success text-uppercase" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>        
            </div>   
        </div>
    </div>            
</div>
@endsection
