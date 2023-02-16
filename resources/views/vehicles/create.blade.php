{{-- Vehicle Insert --}}
<div class="col-md-4 mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">Add Vehicle</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('vehicles.store') }}">
                @csrf
                <div class="form-group">
                    <label class="label">SL No. </label>
                    <input type="text" name="sl_no" class="form-control" placeholder="Enter Vehicle SL Numnber" />
                </div>
                <div class="form-group">
                    <label class="label">Vehicle Name: </label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Vehicle Name" />
                </div>
                <div class="form-group">
                    <label class="label">Model: </label>
                    <input type="text" name="model" class="form-control" placeholder="Enter Model Number" />
                </div>
                <div class="form-group">
                    <label class="label">ODO Mileages: </label>
                    <input type="number" name="total_mileage" class="form-control" placeholder="Enter Total Odo" />
                </div>
                <div class="form-group">
                    <label class="label">Tank Capacity: </label>
                    <input type="number" name="tank_capacity" class="form-control" placeholder="Enter Tank Capacity" />
                </div>
                <div class="form-group">
                    <label class="label">Vehicle License No. </label>
                    <input type="text" name="license_no" class="form-control" placeholder="Enter License Number" />
                </div>
                {{-- <input type="hidden" name="vehicle_type_id" value="{{ $input }}" /> --}}
                <div class="form-group"> Vehicle Type:
                    <select class="form-select" name="vehicle_type_id">
                        <option value="">Select Vehicle Type</option>
                        @foreach ($vTypes as $vType)
                            <option value="{{ $vType->id }}" >
                                {{ $vType->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success text-uppercase" />
                </div>
            </form>
        </div>
    </div>
</div>