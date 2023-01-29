<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuelTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fuelTypes = FuelType::query();

        if ($with = request('with')) { //load relationships
            $fuelTypes->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $fuelTypes->filter(FuelType::parseRequest(request('query')));

        //set default sorting
        if (! FuelType::hasSorting(request('query'))) {
            $fuelTypes->filter(FuelType::getDefaultSorting());
        }          
        
        $fuelTypes = $fuelTypes->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page',1)
        );

        
        if( request()->is('api/*')){
            //an api call
            return $this->respond($fuelTypes);
        }else{
            //a web call
            return view('fuels.fuel-types',['fuelTypes'=>$fuelTypes])->with('id',(request()->input('page',1)-1) * self::ITEMS_PER_PAGE);
        }

    }

    public function create()
    {
        return view('fuels.fuel-types');
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
            FuelType::validation_rules(),
            FuelType::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuelType = FuelType::create($request->all());

        // return $this->respondCreated($fueltype);

        if( request()->is('api/*')){
            //an api call
            return $this->respond($fuelType);
        }else{
            //a web call
            return back()->with('status','Fuel Type added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(FuelType $fuelType)
    {
        return $this->respond($fuelType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelType $fuelType)
    {
        $validation = Validator::make(
            $request->all(), 
            FuelType::validation_rules_for_update(),
            FuelType::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fuelType->update($request->all());

        return $this->respond($fuelType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuelType $fuelType)
    {
        $fuelType->delete();

        return $this->respondDeleted();
    }
}
