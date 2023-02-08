<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task = Task::query();

        if ($with = request('with')) { //load relationships
            $task->with(explode(',', $with));
        }

        //filter, sorting, selective-columns
        $task->filter(Task::parseRequest(request('query')));

        //set default sorting
        if (! Task::hasSorting(request('query'))) {
            $task->filter(Task::getDefaultSorting());
        }

        $task = $task->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE),
            request('page', 1)
        );

        return $this->respond($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            Task::validation_rules(),
            Task::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $task = Task::create($request->all());

        $task->users()->sync($request->user_ids);

        return $this->respondCreated($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($with = request('with')) { //load relationships
            $task->with(explode(',', $with));
        }

        return $this->respond($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validation = Validator::make(
            $request->all(),
            Task::validation_rules_for_update(),
            Task::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $task->update($request->all());

        $task->users()->sync($request->user_ids);

        return $this->respond($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->respondDeleted();
    }
}
