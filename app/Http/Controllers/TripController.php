<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Driver;
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
        $data['drivers'] = Driver::all();
        $data['customers'] = Customer::all();
        $data['vehicles'] = Vehicle::all();
        return view('trips.create-trips',$data);
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

    public function edit(Trip $trip)
    {
        return view('trips.edit',['trip'=>$trip]);
    }

 
    public function update(Request $request, Trip $Trip)
    {
        // $validation = Validator::make(
        //     $request->all(), 
        //     Trip::validation_rules_for_update(),
        //     Trip::validation_messages_for_update(),
        // );

        // if ($validation->fails()) {
        //     return $this->respondValidationError($validation->errors());
        // }   
        $amount = $request->input('advance_amount');

        $charge = ($amount / 1000) * 20;


        $packageAmount = $request->package_amount;
        $advanceAmount = $request->advance_amount;
        $balanceIn = $packageAmount - $advanceAmount;

        $Trip->update([
            'package_amount' => $packageAmount,
            'advance_amount' => $advanceAmount,
            'balance_in' => $balanceIn,
            'trip_earning' => $advanceAmount,
            'status'=>$request->status,
            'bkash_charge'=>$charge,
        ]);

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
