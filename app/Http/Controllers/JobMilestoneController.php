<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JobMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        return $this->respond($job->milestones()->paginateWrap(
            $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        ));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $validation = Validator::make(
            $request->all(), 
            Milestone::validation_rules_for_update(),
            Milestone::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }  

        return $this->respondCreated($job->milestones()->create($request->all()));
        //return $this->respondCreated(Milestone::create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job, Milestone $milestone)
    {
        return $this->respond($milestone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job, Milestone $milestone)
    {
       
        $validation = Validator::make(
            $request->all(), 
            Milestone::validation_rules_for_update(),
            Milestone::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $milestone->update($request->all());
        //$milestone->update($validated);

        return $this->respond($milestone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job, Milestone $milestone)
    {
        $milestone->delete();

        return $this->respondDeleted();
    }
}
