@extends('layouts.master-admin')

@section('title','Customer | Profile')

@section('content')

{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 justify-content-center">
            <div class="card">
                <div class="card-header bg-success text-white">Customer Profile Update</div>
                    
                <div class="card-body">
                    <form method="post" action="{{ route('admin.customers.update', $customer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <x-avatars.customers :userAvatar="$customer->avatar" width="200" height="200" class="rounded-circle" />
                            </div>
                            <div class="col-sm-12 text-center">
                                <input style="margin-left:215px" type="file" name="avatar" accept="image">
                            </div>
                        </div>
                        <div class="row">
                            <x-form-input col="6" type="text" label="Full Name" for="first_name" id="first_name" name="first_name" class="" placeholder="" value="{{ $customer->first_name }}"  />
                            <x-form-input col="6" type="text" label="" for="last_name" id="last_name" name="last_name" class="mt-2" placeholder="" value="{{ $customer->last_name }}"  />
                        <x-form-textarea col="12" style="" label="Address" for="address" id="address" name="address" class="mt-2" placeholder="" value="{{ $customer->address }}"  />
                            <x-form-input col="6" type="text" label="Contact Number" for="contact_number" id="contact_number" name="contact_number" class="mt-2" placeholder="" value="{{ $customer->contact_number }}"  />
                            @if($customer->status == '1')
                                <div class="col-lg-6 text-success" style="margin-top:56px;">Active</div>
                                @else
                                <div class="col-lg-6 text-warning" style="margin-top:56px;">Inactive</div>
                            @endif
                            <x-form-button col="12" type="submit" class="btn btn-success text-uppercase">Submit</x-form-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection