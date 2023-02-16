<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attendances = Attendance::query();

        if ($with = request('with')) { //load relationships
            $attendances->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $attendances->filter(Attendance::parseRequest(request('query')));

        //set default sorting
        if (! Attendance::hasSorting(request('query'))) {
            $attendances->filter(Attendance::getDefaultSorting());
        }          
        
        $attendances = $attendances->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($attendances);
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
            Attendance::validation_rules(),
            Attendance::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $attendance = Attendance::create($request->all());

        return $this->respondCreated($attendance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return $this->respond($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validation = Validator::make(
            $request->all(), 
            Attendance::validation_rules_for_update(),
            Attendance::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $attendance->update($request->all());

        return $this->respond($attendance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return $this->respondDeleted();
    }
}
