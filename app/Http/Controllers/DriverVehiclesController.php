<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\DriverVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverVehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drivervehicles = DriverVehicle::query();

        if ($with = request('with')) { //load relationships
            $drivervehicles->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $drivervehicles->filter(DriverVehicle::parseRequest(request('query')));

        //set default sorting
        if (! DriverVehicle::hasSorting(request('query'))) {
            $drivervehicles->filter(DriverVehicle::getDefaultSorting());
        }          
        
        $drivervehicles = $drivervehicles->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($drivervehicles);
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
            DriverVehicle::validation_rules(),
            DriverVehicle::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $drivervehicle = DriverVehicle::create($request->all());

        return $this->respondCreated($drivervehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(DriverVehicle $drivervehicle)
    {
        return $this->respond($drivervehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverVehicle $drivervehicle)
    {
        $validation = Validator::make(
            $request->all(), 
            DriverVehicle::validation_rules_for_update(),
            DriverVehicle::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $drivervehicle->update($request->all());

        return $this->respond($drivervehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverVehicle $drivervehicle)
    {
        $drivervehicle->delete();

        return $this->respondDeleted();
    }
}
