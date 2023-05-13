@extends('layouts.master-admin')

@section('title','Trips | Package')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mt-4">
            <h3 class="page-title text-white mb-4">Trip Packages ! </h3>
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        {{-- <h3 class="page-title text-white">Welcome to Durojan ! </h3> --}}
                        <ul class="breadcrumb bg-dark mt-2">
                            <a style="float: right" class="btn btn-dark text-white text-right bg-inverse-success" href="{{ route('admin.trip-packages.create') }}">Add Package</a>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card card-table border-secondary flex-fill justify-content-center">
                            <div class="card-header bg-dark">
                                <h3 class="card-title  text-white mb-0">Packages <span class="badge bg-inverse-danger ml-2">{{ $packages->count() }}</span> </h3> </div>
                            <div class="card-body bg-dark">
                                <div class="table table-responsive md-5">
                                    <table class="table table-bordered table-dark text-white align-middle text-center">
                                        <thead class="border-secondary">
                                            <tr>
                                            <th>ID</th>
                                            <th>Packages</th>
                                            <th>Package Amount</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages as $package )
                                        <tr>
                                            <td>{{ ++$id}}</td>
                                            <td>{{ $package->title }}</td>
                                            <td>{{ $package->package_amount }}</td>
                                            <td>{{ $package->created_at }}</td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div>
    </div>            
</div>

@endsection
