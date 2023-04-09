@extends('layouts.master-admin')

@section('title','Profile')

@section('content')
<div class="page-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 justify-content-center">
            <div class="card">
                <div class="card-header bg-success text-white">Driver Profile Update</div>
                {!! Toastr::message() !!}
                <div class="card-body">
                    <form method="post" action="{{ route('admin.drivers.update', $driver->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <x-driver-avatar :userAvatar="$driver->avatar" width="200" height="200" class="rounded-circle" />
                            </div>
                            <div class="col-sm-12 text-center">
                                <input style="margin-left:215px" type="file" name="avatar" accept="image">
                            </div>
                        </div>
                        <div class="row">
                            <x-form-input col="6" type="text" label="Full Name" for="first_name" id="first_name" name="first_name" class="" placeholder="" value="{{ $driver->first_name }}"  />
                            <x-form-input col="6" type="text" label="" for="last_name" id="last_name" name="last_name" class="mt-2" placeholder="" value="{{ $driver->last_name }}"  />
                            <x-form-input col="6" type="text" label="Driving License" for="driving_license" id="driving_license" name="driving_license" class="mt-2" placeholder="" value="{{ $driver->driving_license }}"  />
                            <x-form-input col="6" type="text" label="Contact Number" for="contact_number" id="contact_number" name="contact_number" class="mt-2" placeholder="" value="{{ $driver->contact_number }}"  />
                            <x-form-input col="6" type="text" label="Address" for="address" id="address" name="address" class="mt-2" placeholder="" value="{{ $driver->address }}"  />
                            <x-form-input col="6" type="number" label="Status" for="status" id="status" name="status" class="mt-2" placeholder="" value="{{ $driver->status }}" readonly />
                            <x-form-button col="12" type="submit" class="btn btn-success text-uppercase">Submit</x-form-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection