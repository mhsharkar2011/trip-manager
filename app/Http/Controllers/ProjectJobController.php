<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return $this->respond($project->jobs()->paginateWrap(
            $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        ));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $validation = Validator::make(
            $request->all(), 
            Job::validation_rules_for_update(),
            Job::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }  

        return $this->respondCreated($project->jobs()->create($request->all()));
        //return $this->respondCreated(Job::create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Job $job)
    {
        return $this->respond($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Job $job)
    {
       
        $validation = Validator::make(
            $request->all(), 
            Job::validation_rules_for_update(),
            Job::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $job->update($request->all());
        //$job->update($validated);

        return $this->respond($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Job $job)
    {
        $job->delete();

        return $this->respondDeleted();
    }
}
