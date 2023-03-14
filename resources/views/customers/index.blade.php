@extends('layouts.master-admin')

@section('title','customers')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.customers.create') }}">Add customer</a>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered text-white table-sm m-12">
                        <thead class="table-dark text-center align-middle font-bold border-white">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Customer Name</th>
                                <th>Contact Number</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($customers as $customer )
                                <tr>
                                    <td>{{ $customer->id}}</td>
                                    <td>{{ $customer->avatar}}</td>
                                    <td>{{ $customer->first_name}}{{ $customer->last_name}}</td>
                                    <td>{{ $customer->contact_number}}</td>
                                    <td><a href="{{ route('admin.customers.show', $customer->id) }}"> <i class="fas fa-eye text-info"></i></a></td>
                                    <td><a href="{{ route('admin.customers.destroy', $customer->id) }}"><i class="fas fa-times-circle text-danger"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination bg-dark justify-content-center">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
