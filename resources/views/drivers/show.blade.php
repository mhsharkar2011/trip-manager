@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    {{-- <h3 class="page-title text-white">Welcome to Durojan ! </h3> --}}
                    <ul class="breadcrumb bg-dark mt-2">
                        {{-- <a style="float: right" class="btn btn-success text-right" href="{{ route('admin.drivers.create') }}">Add Driver</a> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $driver->full_name ?? 'No Name Found' }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.drivers.updateStatus', $driver) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Driver Status') }}</label>

                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class="form-control @error(session('status')) is-invalid @enderror" name="status" value="{{ old('status') ?? $driver->status }}" {{ $driver->status ? 'ACTIVE' : '' }}>

                                    @error(session('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Status') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
