@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>        
        <hr>
        <p>{{ $comment->body }}</p>
         
        <strong> <span style="font-size: 14px; font-weight:400">Commented By: </span> {!!  $comment['user'] = $comment->user['full_name'] !!} </strong>
        <hr>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <br>
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        
        @include('posts.commentsDisplay', ['comments'=>$comment->replies,'parent_id'=>$comment->id])
    </div>
@endforeach  