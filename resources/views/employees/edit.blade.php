@extends('layouts.master-admin')

@section('title','Profile')

@section('content')
<div class="page-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 justify-content-center">
            <div class="card">
                <div class="card-header bg-success text-white">Employee Profile Update</div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                <div class="card-body">
                    <form method="post" action="{{ route('admin.employees.update', $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <x-employee-avatar :userAvatar="$driver->avatar" width="200" height="200" />
                            </div>
                            <div class="col-sm-12 text-center">
                                <input style="margin-left:215px" type="file" name="avatar" accept="image">
                            </div>
                        </div>
                        <div class="row">
                            <x-form-input col="6" type="text" label="Full Name" for="name" id="name" name="name" class="" placeholder="" value="{{ $employee->name }}"  />
                            <x-form-input col="6" type="text" label="Email" for="email" id="email" name="email" class="mt-2" placeholder="" value="{{ $employee->email }}"  />
                            <x-form-input col="6" type="text" label="Date Of Birth" for="birth_date" id="birth_date" name="birth_date" class="mt-2" placeholder="" value="{{ $employee->birth_date }}"  />
                            <x-form-input col="6" type="text" label="Gender" for="gender" id="gender" name="gender" class="mt-2" placeholder="" value="{{ $employee->gender }}"  />
                            <x-form-input col="6" type="number" label="Contact Number" for="contact_number" id="contact_number" name="contact_number" class="mt-2" placeholder="" value="{{ $employee->contact_number }}" readonly />
                            <x-form-button col="12" type="submit" class="btn btn-success text-uppercase">Submit</x-form-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection