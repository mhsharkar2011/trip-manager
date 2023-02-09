<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\FuelVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuelVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fuelvehicle = FuelVehicle::query();

        if ($with = request('with')) { //load relationships
            $fuelvehicle->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $fuelvehicle->filter(FuelVehicle::parseRequest(request('query')));

        //set default sorting
        if (! FuelVehicle::hasSorting(request('query'))) {
            $fuelvehicle->filter(FuelVehicle::getDefaultSorting());
        }          
        
        $fuelvehicle = $fuelvehicle->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($fuelvehicle);
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
            FuelVehicle::validation_rules(),
            FuelVehicle::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuelvehicle = FuelVehicle::create($request->all());

        return $this->respondCreated($fuelvehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(FuelVehicle $fuelvehicle)
    {
        return $this->respond($fuelvehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelVehicle $fuelvehicle)
    {
        $validation = Validator::make(
            $request->all(), 
            FuelVehicle::validation_rules_for_update(),
            FuelVehicle::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuelvehicle->update($request->all());

        return $this->respond($fuelvehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuelVehicle $fuelvehicle)
    {
        $fuelvehicle->delete();

        return $this->respondDeleted();
    }
}
