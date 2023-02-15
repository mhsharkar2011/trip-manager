<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $format = 'view')
    {

        $Trips = Trip::query();
        $search = $request->input('q');
        if ($with = request('with')) { //load relationships
            $Trips->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $Trips->filter(Trip::parseRequest(request('query')));

        //set default sorting
        if (! Trip::hasSorting(request('query'))) {
            $Trips->filter(Trip::getDefaultSorting());
        }          
        
        $Trips = $Trips->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );


        if( request()->is('api/*')){
            //an api call
            return $this->respond($Trips);
        }else{
            //a web call
            return view('trips.index',['trips'=>$Trips])->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
        }
    }

   
    public function create(Request $request)
    {
        $users = User::all();
        $vehicles = Vehicle::all();

        return view('trips.create-trips',['users'=>$users,'vehicles'=>$vehicles]);
    }

    public function store(Request $request)
    {

        $validation = Validator::make(
            $request->all(), 
            Trip::validation_rules(),
            Trip::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $input = $request->all();
        $Trip = Trip::create($input);
        


        return back()->with('status','Trip created successfully');
    }


    public function show(Trip $trip)
    {
        // return $trip;

        return view('trips.show',['trip'=>$trip]);
    }

    public function edit(Trip $trip, User $user)
    {

        $users = User::all();
        $vehicles = Vehicle::all();
        return view('trips.edit',['trip'=>$trip,'users'=>$users,'vehicles'=>$vehicles]);
    }

 
    public function update(Request $request, Trip $Trip)
    {
        $validation = Validator::make(
            $request->all(), 
            Trip::validation_rules_for_update(),
            Trip::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $Trip->update($request->all());

        return back()->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $Trip)
    {
        // $trip = Trip::find($Trip);
        $Trip->delete();

        return redirect('trips.index')->with('status','Item deleted successfully');
    }
}
