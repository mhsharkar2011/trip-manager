@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">This is Comment Section</h3>
                    <br/>
                     <a href="{{ route('posts.index') }}"><h4>Post</h4></a>
                    @include('comments.postsDisplay', ['posts' => $comment->post])
                    <hr />
                    <h4>{{ $comment->body }}</h4>
                   <p> Comment by:</p> <h6>{{ $comment->user->full_name }}</h6>
                    

                    {{-- @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id]) --}}
  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
