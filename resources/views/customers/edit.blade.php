@extends('layouts.master-admin')

@section('title','Customer')

@section('content')
<div class="page-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 justify-content-center">
            <div class="card">
                <div class="card-header bg-success text-white">Customer Profile Update</div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                <div class="card-body">
                    <form method="post" action="{{ route('admin.customers.update', $customer->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="label">First Name:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $customer->first_name }}" />
                        </div>
                        <div class="form-group">
                            <label class="label">Last Name: </label>
                            <input type="text" name="last_name" class="form-control" value="{{ $customer->last_name }}" />
                        </div>
                        <div class="form-group">
                            <label class="label">Contact Number: </label>
                            <input type="text" name="contact_number" class="form-control" value="{{ $customer->contact_number }}" />
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