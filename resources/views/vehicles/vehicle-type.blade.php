@extends('layouts.app')

@section('title','Vehicles')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Vehicle Type List</div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehicle Type Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicleTypes as $vType )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $vType->title }}
                                </td>
                                <td>
                                    {{ $vType->created_at }}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                </div>
            </div>
        </div>

        {{-- Vehicle Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Vehicle Type</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('vehicle-types.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="label">Vehicle Type: </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Vehicle Type" />
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
