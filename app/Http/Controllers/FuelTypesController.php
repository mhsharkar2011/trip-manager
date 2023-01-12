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
        dd('ok');
        $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE);

        $fueltypes = FuelType::latest()->paginate($items_per_page);

        return $this->respond($fueltypes);
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

        $fueltype = FuelType::create($request->all());

        return $this->respondCreated($fueltype);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(FuelType $fueltype)
    {
        return $this->respond($fueltype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelType $fueltype)
    {
        dd($fueltype);
        $validation = Validator::make(
            $request->all(), 
            FuelType::validation_rules_for_update(),
            FuelType::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $fueltype->update($request->all());

        return $this->respond($fueltype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuelType $fueltype)
    {
        $fueltype->delete();

        return $this->respondDeleted();
    }
}
