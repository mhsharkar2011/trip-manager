<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Fuel;
use App\Enums\FuelTypes;
use App\Models\Package;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data['packages'] = Package::all();
        $data['fuelTypes'] = [FuelTypes::PETROL,FuelTypes::DIESEL,FuelTypes::CNG,FuelTypes::LPG]; // Enum class
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

        $package = Package::findOrFail($request->package_id);
        $packageAmount = $package->package_amount;
        $advanceAmount = $request->advance_amount;
        $balanceIn = $packageAmount - $advanceAmount;
        $bkashCharge = $request->bkash_charge;
        $totalCharge = ($advanceAmount / 1000) * $bkashCharge;
        // After deduction by bkash charge advance amount
        $tripEarning = $advanceAmount-$totalCharge;
        $fuelName = $request->fuel_name;
        $fuelAmount = $request->fuel_amount;
        $itemName = $request->item_name;
        $itemAmount = $request->amount;
        $balanceIn = $packageAmount - $advanceAmount;
        
        $tripExpenses = $fuelAmount+$itemAmount;

        if ($advanceAmount < $balanceIn) {
            $status = 'Pending';
        } else {
            $status = 'Completed';
        }
        
        Trip::create([
            'booking_id' => $request->booking_id,
            'driver_id' => $request->driver_id,
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'package_id' => $request->package_id,
            'booking_date' => $request->booking_date,
            'booking_period' => $request->booking_period,
            'advance_amount' => $advanceAmount,
            'bkash_charge'=>$bkashCharge,
            'balance_in' => $balanceIn,
            'fuel_name' => $fuelName,
            'fuel_amount' => $fuelAmount,
            'item_name' =>$itemName,
            'amount' =>$itemAmount,
            'trip_earning' =>$tripEarning,
            'trip_expenses' =>$tripExpenses,
            'status' =>$status,
        ]
        );
        


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
        $validation = Validator::make(
            $request->all(), 
            Trip::validation_rules_for_update(),
            Trip::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   
        $advanceAmount = $request->advance_amount;
        $bkashCharge = $request->bkash_charge;
        $totalCharge = ($advanceAmount / 1000) * $bkashCharge;
        $packageAmount = $request->package_amount;
        // After deduction by bkash charge advance amount
        $tripEarning = $advanceAmount-$totalCharge;
        $fuelCost = $request->fuel_cost;
        $otherCost = $request->other_cost;
        $balanceIn = $packageAmount - $advanceAmount;
        
        $totalProfit = $tripEarning-($fuelCost+$otherCost);

        $Trip->update([
            'booking_date' => $request->booking_date,
            'advance_amount' => $advanceAmount,
            'balance_in' => $balanceIn,
            'trip_earning' => $totalProfit,
            'status'=>$request->status,
            'bkash_charge'=>$bkashCharge,
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
