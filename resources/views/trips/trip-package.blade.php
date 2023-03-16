@extends('layouts.master-admin')

@section('title','Trips | Package')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="page-title text-white">Welcome to Trip Packages ! </h3>
                    {{-- Package Insert --}}
                    <div class="card bg-dark text-white">
                        <div class="card-header bg-dark text-white">Add Trip Package</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('admin.trip-packages.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label">Package Type: </label>
                                    <input type="text" name="title" class="form-control bg-dark" placeholder="Enter Package Type" />
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-secondary text-uppercase" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 mt-4 d-flex">
                    <div class="card card-table border-secondary flex-fill justify-content-center">
                        <div class="card-header bg-dark">
                            <h3 class="card-title  text-white mb-0">Packages</h3> </div>
                        <div class="card-body bg-dark">
                            <div class="table table-responsive md-5">
                                <table class="table text-white m-12">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Package Type</th>
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
                </div> 
            </div>   
        </div>
    </div>            
</div>

@endsection
