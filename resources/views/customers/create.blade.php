@extends('layouts.master-admin')

@section('title','Customer')

@section('content')
{{-- Vehicle Insert --}}

        <div class="row d-flex">
            <div class="col-md-8 mt-5 justify-content-center">
                <div class="card">
                    <div class="card-header bg-success text-white">Customer Add Form</div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.customers.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="label">First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter Customer First Name" />
                            </div>
                            <div class="form-group">
                                <label class="label">Last Name: </label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Customer Last Name" />
                            </div>
                            <div class="form-group">
                                <label class="label">Contact Number: </label>
                                <input type="text" name="contact_number" class="form-control" placeholder="Enter Customer Contact Number" />
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success text-uppercase" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection