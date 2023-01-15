<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE);

        $vehicletypes = VehicleType::with('vehicles')->latest()->paginate($items_per_page);
        
        return view('pages.vehicleTypes',compact('vehicletypes'));
        // return $this->respond($vehicletypes);
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
            VehicleType::validation_rules(),
            VehicleType::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $vehicletype = VehicleType::create($request->all());

        return $this->respondCreated($vehicletype);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicletype)
    {
        return $this->respond($vehicletype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleType $vehicletype)
    {
        $validation = Validator::make(
            $request->all(), 
            VehicleType::validation_rules_for_update(),
            VehicleType::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $vehicletype->update($request->all());

        return $this->respond($vehicletype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicletype)
    {
        $vehicletype->delete();

        return $this->respondDeleted();
    }
}
