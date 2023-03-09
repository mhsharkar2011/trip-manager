@extends('layouts.master-admin')

@section('title','Drivers')

@section('content')
<div class="container">
    <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.drivers.create') }}">Add driver</a>
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-hover table-sm m-12">
                    <thead class="table-dark">
                        <tr style="font-size: 12px; text-align: center;vertical-align: middle;">
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Driver Name</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver )
                            <tr>
                                <td>
                                   {{ $driver->id}}
                                </td>
                                <td>
                                    {{ $driver->avatar}}
                                 </td>
                                <td>
                                    {{ $driver->first_name}}
                                    {{ $driver->last_name}}
                                </td>
                                <td>
                                    {{ $driver->contact_number}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $drivers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
