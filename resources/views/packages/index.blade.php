@extends('layouts.master-admin')

@section('title','Packages')

@section('content')
<div class="container">
    <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.packages.create') }}">Add Vehicle</a>
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-hover table-sm m-12">
                    <thead class="table-dark">
                        <tr style="font-size: 12px; text-align: center;vertical-align: middle;">
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package )
                            <tr>
                                <td>
                                   {{ ++$id}}
                                </td>
                                <td>
                                    {{ $package->title}}
                                </td>
                                <td>
                                    {{ $package->created_at}}
                                </td>
                                </tr>
                                @endforeach
                        </tbody>
    
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
