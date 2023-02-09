<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(5);

        // $comments['comments'] = $comments;

        // return response()->json($comments);
        return view('comments.index',compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comment::create($input);
   
        return back();
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        // dd($comment);
        $user = auth()->user();
        $comment['post_title'] = $comment->post->title;
        // dd($comment->toArray());
        // return response()->json($comment);

        return view('comments.show',compact('comment'));
    }
}
