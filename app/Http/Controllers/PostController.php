<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // $posts['posts'] = $posts;
        // return response()->json($posts);
        return view('posts.index',compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);
    
        Post::create($request->all());
    
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->find($id);
            $post['comments'] = $post->comments;
            
        return view('posts.show', compact('post'));
    }
}
