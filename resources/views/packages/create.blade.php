@extends('layouts.app')

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
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Packages Name</th>
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
                                    {{ $package->title }}
                                </td>
                                <td>
                                    {{ $package->created_at }}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                </div>
            </div>
        </div>

        {{-- Package Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Package Type</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.Package-types.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="label">Package Type: </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Package Type" />
                        </div>
                        <br>

                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-success text-uppercase" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
