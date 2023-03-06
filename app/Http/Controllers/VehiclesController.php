<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Mileage;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

use function PHPUnit\Framework\returnSelf;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $vTypes = VehicleType::all();

        $vehicles = Vehicle::query();
        
        if ($with = request('with')) { //load relationships
            $vehicles->with(explode(',', $with));
        }        
        
        //filter, sorting, selective-columns
        $vehicles->filter(Vehicle::parseRequest(request('query')));

        //set default sorting
        if (! Vehicle::hasSorting(request('query'))) {
            $vehicles->filter(Vehicle::getDefaultSorting());
        }          
        
        $vehicles = $vehicles->paginateWrap(
            request('columns', self::ITEMS_PER_PAGE),
            request('page', 1)
        );

        if( request()->is('api/*')){
            return $this->respond($vehicles);
        }else{
            return view('vehicles.index',['vehicles'=>$vehicles,'vTypes'=>$vTypes])->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
        }
        // return $this->respond($vehicles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['vTypes'] = VehicleType::all();
        return view('vehicles.create',$data);
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

        $input = $request->all();
        $input['owner_id'] = auth()->user()->id;
        $vehicle = Vehicle::create($input);

        $mileage = new Mileage();
        $mileage->vehicle_id = $vehicle->id;
        $mileage->total_mileage = $request->total_mileage;

        $odoMileage = $mileage->total_mileage;
        $mileage->total_mileage = $odoMileage;
        $vehicle->mileage()->save($mileage);

        if( request()->is('api/*')){
            return $this->respond($vehicle);
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
    public function show(Vehicle $vehicle)
    {
        $vehicle = $vehicle->with('mileage')->find($vehicle);
        if( request()->is('api/*')){
            return $this->respond($vehicle);
        }else{
            return back()->with('status','Data inserted successfully');
        }
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
