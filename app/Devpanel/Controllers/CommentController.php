<?php

namespace App\Devpanel\Controllers;

use App\Devpanel\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment = Comment::query()->with('commentBy');

        if ($with = request('with')) { //load relationships
            $comment->with(explode(',', $with));
        }

        //filter, sorting, selective-columns
        $comment->filter(Comment::parseRequest(request('query')));

        //set default sorting
        if (! Comment::hasSorting(request('query'))) {
            $comment->filter(Comment::getDefaultSorting());
        }

        $comment = $comment->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE),
            request('page', 1)
        );

        return response()->json($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $entity, $id)
    {
        $validation = Validator::make(
            $request->all(),
            Comment::validation_rules(),
            Comment::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->type = $request->type;
        $comment->project_id = $request->project_id ?? null;
        $comment->comment_by = auth()->user()->id;

        $comment = (new $model)::find($id)->comments()->save($comment);

        return $this->respondCreated($comment->load('commentBy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $this->respond($comment->load('commentBy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validation = Validator::make(
            $request->all(),
            Comment::validation_rules_for_update(),
            Comment::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $comment->update($request->all());

        return $this->respond($comment->load('commentBy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->respondDeleted();
    }

    /**
     * Display a listing of comment type resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function commentType()
    {
        return response()->json([
            "status" => true,
            "data" => \App\Models\Comment::getCommentTypes()
        ], 200);
    }

    /**
     * Display a listing of entity comment resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEntityComment(Request $request, $entity, $id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $comment = (new $model)::find($id)->comments;

        return $this->respond($comment->load('commentBy'), 200);
    }
}
