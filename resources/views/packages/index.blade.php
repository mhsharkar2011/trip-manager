@extends('layouts.master-admin')

@section('title','Packages')

@section('content')
<<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="page-title text-white">Welcome to Durojan ! </h3>
                    <ul class="breadcrumb bg-dark mt-2">
                        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.vehicles.create') }}">Add Vehicle</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">     
            <div class="col-md-10 d-flex">
                <div class="card card-table border-secondary flex-fill justify-content-center">
                    <div class="card-header bg-dark">
                        <h3 class="card-title  text-white mb-0">Vehicles <span class="badge bg-inverse-danger ml-2">#</span> </h3> </div>
                    <div class="card-body bg-dark">
                        <div class="table table-responsive md-5">

                <table class="table table-responsive table-bordered table-hover table-sm m-12">
                    <thead class="table-dark">
                        <tr style="font-size: 12px; text-align: center;vertical-align: middle;">
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $package->title}}
                                </td>
                                <td>
                                    {{ $package->created_at}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    

@endsection
