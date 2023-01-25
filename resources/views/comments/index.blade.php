@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>All Comments</h1>
            {{-- <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right">Create Comment</a> --}}
            <table class="table table-bordered">
                <thead>
                    <th width="80px">Id</th>
                    <th>Title</th>
                    <th width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>
                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-primary">View Comments</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                
            </table>
            {{$comments->links()}}
        </div>
    </div>
</div>
@endsection    