<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = Project::query();

        if ($with = request('with')) { //load relationships
            $project->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $project->filter(Project::parseRequest(request('query')));

        //set default sorting
        if (! Project::hasSorting(request('query'))) {
            $project->filter(Project::getDefaultSorting());
        }          
        
        $project = $project->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($project);
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
            Project::validation_rules(),
            Project::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $project = Project::create($request->all());

        return $this->respondCreated($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $this->respond($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validation = Validator::make(
            $request->all(), 
            Project::validation_rules_for_update(),
            Project::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $project->update($request->all());

        return $this->respond($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return $this->respondDeleted();
    }
}
