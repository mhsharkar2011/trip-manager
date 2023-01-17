<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leavetypes = LeaveType::query();

        if ($with = request('with')) { //load relationships
            $leavetypes->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $leavetypes->filter(LeaveType::parseRequest(request('query')));

        //set default sorting
        if (! LeaveType::hasSorting(request('query'))) {
            $leavetypes->filter(LeaveType::getDefaultSorting());
        }          
        
        $leavetypes = $leavetypes->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($leavetypes);
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
            LeaveType::validation_rules(),
            LeaveType::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leavetype = LeaveType::create($request->all());

        return $this->respondCreated($leavetype);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveType $leavetype)
    {
        return $this->respond($leavetype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leavetype)
    {
        $validation = Validator::make(
            $request->all(), 
            LeaveType::validation_rules_for_update(),
            LeaveType::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leavetype->update($request->all());

        return $this->respond($leavetype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leavetype)
    {
        $leavetype->delete();

        return $this->respondDeleted();
    }
}
