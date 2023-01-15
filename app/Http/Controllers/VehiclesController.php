<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE);

        $vehicles = Vehicle::with('vehiclesTypes')->latest()->paginate($items_per_page);

        return view('pages.vehicles',compact('vehicles'));
        // return $this->respond($vehicles);
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
            Vehicle::validation_rules(),
            Vehicle::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $vehicle = Vehicle::create($request->all());

        return $this->respondCreated($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return $this->respond($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validation = Validator::make(
            $request->all(), 
            Vehicle::validation_rules_for_update(),
            Vehicle::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $vehicle->update($request->all());

        return $this->respond($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return $this->respondDeleted();
    }
}
