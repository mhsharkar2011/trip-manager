@extends('layouts.master-admin')

@section('title','Trips | Package')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mt-4">
            <h3 class="page-title text-white mb-4">Roles ! </h3>
            <div class="row">
                <div class="col-md-6">
                    {{-- Package Insert --}}
                    <div class="card border-secondary bg-dark text-white">
                        <div class="card-header bg-dark text-white">Add Role</div>
                            <div class="card-body">
                                <x-messages.alert :status="session('status')" :route="route('admin.roles.index')" />
                                <form method="post" action="{{ route('admin.roles.store') }}">
                                    @csrf
                                        <div class="row">
                                            <x-form-input col="" type="text" label="Package Name:" for="title" id="title" name="title" class="form-control bg-dark text-white" placeholder="Enter Package Type" value="" />
                                            <x-form-input col="" type="text" label="Package Amount:" for="package_amount" id="package_amount" name="package_amount" class="form-control bg-dark text-white" placeholder="Enter Package Amount" value="" />
                                        </div>
                                        <div class="form-group text-center mt-4">
                                            <input type="submit" class="btn btn-dark bg-inverse-success text-uppercase" />
                                        </div>
                                </form>
                            </div>
                    </div>
                </div>     
                    <div class="col-md-6 d-flex">
                        <div class="card card-table border-secondary flex-fill justify-content-center">
                            <div class="card-header bg-dark">
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
