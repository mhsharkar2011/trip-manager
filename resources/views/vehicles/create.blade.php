@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-success text-white">Add Vehicle</div>
                <div class="card-body">
                    <form method="post" action="{{ route('vehicles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="label">SL No. </label>
                            <input type="text" name="sl_no" class="form-control" placeholder="Enter Vehicle SL Numnber" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Vehicle Name: </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Vehicle Name" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Model: </label>
                            <input type="text" name="model" class="form-control" placeholder="Enter Model Number" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Tank Capacity: </label>
                            <input type="text" name="tank_capacity" class="form-control" placeholder="Enter Tank Capacity" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">License No. </label>
                            <input type="text" name="license_no" class="form-control" placeholder="Enter License Number" />
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