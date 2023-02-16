@extends('layouts.app')

@section('title','Trips | Package')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Packages</div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
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

        {{-- Package Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Trip Package</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('package.store') }}">
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
