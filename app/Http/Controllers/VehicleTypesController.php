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
        $vehicleTypes = VehicleType::with('vehicles')->latest()->get();
        
        return view('vehicles.vehicle-type',['vehicleTypes'=>$vehicleTypes])->with('id');
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
        // $validation = Validator::make(
        //     $request->all(), 
        //     VehicleType::validation_rules(),
        //     VehicleType::validation_messages(),
        // );

        // if ($validation->fails()) {
        //     return $this->respondValidationError($validation->errors());
        // }   

        $input = $request->all();

        $vehicleType = VehicleType::create($input);

        if( request()->is('api/*')){
            return $this->respondCreated($vehicleType);
        }else{
            return back()->with('status','Data inserted successfully');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicleType)
    {
        return $this->respond($vehicleType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $validation = Validator::make(
            $request->all(), 
            VehicleType::validation_rules_for_update(),
            VehicleType::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $vehicleType->update($request->all());

        return $this->respond($vehicleType);
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
