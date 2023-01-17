<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\LeaveConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leaveconfigs = LeaveConfig::query();

        if ($with = request('with')) { //load relationships
            $leaveconfigs->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $leaveconfigs->filter(LeaveConfig::parseRequest(request('query')));

        //set default sorting
        if (! LeaveConfig::hasSorting(request('query'))) {
            $leaveconfigs->filter(LeaveConfig::getDefaultSorting());
        }          
        
        $leaveconfigs = $leaveconfigs->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($leaveconfigs);
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
            LeaveConfig::validation_rules(),
            LeaveConfig::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leaveconfig = LeaveConfig::create($request->all());

        return $this->respondCreated($leaveconfig);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveConfig $leaveconfig)
    {
        return $this->respond($leaveconfig);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveConfig $leaveconfig)
    {
        $validation = Validator::make(
            $request->all(), 
            LeaveConfig::validation_rules_for_update(),
            LeaveConfig::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leaveconfig->update($request->all());

        return $this->respond($leaveconfig);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveConfig $leaveconfig)
    {
        $leaveconfig->delete();

        return $this->respondDeleted();
    }
}
