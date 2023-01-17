<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Mileage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MileagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mileages = Mileage::query();

        if ($with = request('with')) { //load relationships
            $mileages->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $mileages->filter(Mileage::parseRequest(request('query')));

        //set default sorting
        if (! Mileage::hasSorting(request('query'))) {
            $mileages->filter(Mileage::getDefaultSorting());
        }          
        
        $mileages = $mileages->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($mileages);
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
            Mileage::validation_rules(),
            Mileage::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $mileage = Mileage::create($request->all());

        return $this->respondCreated($mileage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Mileage $mileage)
    {
        return $this->respond($mileage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mileage $mileage)
    {
        $validation = Validator::make(
            $request->all(), 
            Mileage::validation_rules_for_update(),
            Mileage::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $mileage->update($request->all());

        return $this->respond($mileage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mileage $mileage)
    {
        $mileage->delete();

        return $this->respondDeleted();
    }
}
