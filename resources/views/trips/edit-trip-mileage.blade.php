{{-- Trip Update From --}}
<div class="col-md-4 mt-5">
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <a style="float: center" class="btn btn-success text-center" href="">Trips Form</a>
            {{-- <a style="float:right" class="btn btn-success text-center" href="{{ asset('trips') }}">Trips List</a> --}}
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('trips.update') }}">
                @csrf
                <div class="form-group">Driver Name
                    <select class="form-select" name="user_id">
                        <option value="">Select Driver</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" >
                                {{ $user->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">Vehicle Name
                    <select class="form-select" name="vehicle_id">
                        <option value="">Select Vehicle</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" >
                                {{ $vehicle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label class="label">From Area: </label>
                    <input type="textarea" row="5" name="from_area" class="form-control" />
                </div>
                <br>
                <div class="form-group">
                    <label class="label">To Area: </label>
                    <input type="textarea" row="5" name="to_area" class="form-control" />
                </div>
                <br>
                <div class="form-group">
                    <label class="label">Mileages</label>
                    <input type="number" name="mileages" class="form-control" />
                </div>
                <br>
                <div class="form-group">
                    <label class="label">Cost:</label>
                    <input type="number" name="rate" class="form-control" />
                </div>
                <br>
                
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success text-uppercase" />
                </div>
            </form>
        </div>
    </div>
</div>