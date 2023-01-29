@extends('layouts.app')

@section('title','Fuel Types')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Fuel Type List</div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm m-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fuel Type Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fuelTypes as $fType )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $fType->name }}
                                </td>
                                <td>
                                    {{ $fType->created_at }}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $fuelTypes->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Vehicle Insert --}}
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Fuel Type</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('fuel-types.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="label">Fuel Type: </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Fuel Type" />
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
