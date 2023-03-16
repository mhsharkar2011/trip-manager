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
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($customers as $customer )
                                <tr>
                                    <td>{{ $customer->id}}</td>
                                    <td>{{ $customer->avatar}}</td>
                                    <td>{{ $customer->first_name}}{{ $customer->last_name}}</td>
                                    <td>{{ $customer->contact_number}}</td>
                                    <td class="text-center">{{ $customer->is_active}}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="editClient({{ $customer->id }})">
                                                    <i class="fa fa-pencil m-r-5"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <i class="fa fa-trash-o m-r-5"></i> Delete
                                                </a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
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

<script>
    function editClient(id) {
    // Redirect to the edit trip page with the trip ID as a parameter
    window.location.href = '/customers/' + id + '/edit';
}

</script>

@endsection
