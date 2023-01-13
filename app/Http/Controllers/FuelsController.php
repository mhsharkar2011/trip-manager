<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fuels = Fuel::query();

        if ($with = request('with')) { //load relationships
            $fuels->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $fuels->filter(Fuel::parseRequest(request('query')));

        //set default sorting
        if (! Fuel::hasSorting(request('query'))) {
            $fuels->filter(Fuel::getDefaultSorting());
        }          
        
        $fuels = $fuels->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($fuels);
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
            Fuel::validation_rules(),
            Fuel::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuel = Fuel::create($request->all());

        return $this->respondCreated($fuel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        return $this->respond($fuel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel $fuel)
    {
        $validation = Validator::make(
            $request->all(), 
            Fuel::validation_rules_for_update(),
            Fuel::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuel->update($request->all());

        return $this->respond($fuel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuel $fuel)
    {
        $fuel->delete();

        return $this->respondDeleted();
    }
}
