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
use Brian2694\Toastr\Facades\Toastr;
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
        $search = $request->input('search');
        if($search){
            // $Trips = Trip::query();
            $Trips->with('package')->whereHas('package', function($q)use ($search){
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('package_amount', 'LIKE',"%{$search}%" )
                ->orWhere('status','LIKE',"%{$search}%")
                ->orWhere('booking_period','LIKE',"%{$search}%");
            });
        }

        if ($with = request('with')) { //load relationships
            $Trips->with(explode(',', $with));
        }        
        
        //filter, sorting, selective-columns
        $Trips->filter(Trip::parseRequest(request('query')));
        
        //set default sorting
        if (! Trip::hasSorting(request('query'))) {
            $Trips->filter(Trip::getDefaultSorting());
        }          
        
        $Trips = $Trips->paginate();

        if( request()->is('api/*')){
            //an api call
            return $this->respond($Trips);
        }else{
            //a web call
            return view('trips.index',['trips'=>$Trips])->with('id');
        }
    }

   
    public function create(Request $request)
    {
        $data['drivers'] = Driver::all();
        $data['customers'] = Customer::all();
        $data['vehicles'] = Vehicle::all();
        $data['packages'] = Package::all();
        $data['fuelTypes'] = [FuelTypes::PETROL,FuelTypes::DIESEL,FuelTypes::CNG,FuelTypes::LPG]; // Enum class
        return view('trips.create',$data);
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
        
        $tripExpenses = $fuelAmount+$itemAmount;

        if ($advanceAmount < $packageAmount) {
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
            'from_area' =>$request->from_area,
            'to_area' =>$request->to_area,
            'distance' =>$request->distance,
            'trip_earning' =>$tripEarning,
            'trip_expenses' =>$tripExpenses,
            'status' =>$status,
        ]
        );
        

        Toastr::success('success','Trips Created Successfully');
        return back()->with('status','Trip created successfully');
    }


    public function show(Trip $trip)
    {
        // return $trip;
        $data['tripStatus'] = $trip->where('status','Pending')->orWhere('status','Completed')->get();
        // dd($data['tripStatus']);
        return view('trips.show',['trip'=>$trip],$data);
    }

    public function edit(Trip $trip)
    {
        $data['fuelTypes'] = [FuelTypes::PETROL,FuelTypes::DIESEL,FuelTypes::CNG,FuelTypes::LPG]; // Enum class
        return view('trips.edit',['trip'=>$trip],$data);
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

        $packageAmount = $Trip->package->package_amount;;
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
        
        $tripExpenses = $fuelAmount+$itemAmount;

        if ($advanceAmount < $packageAmount) {
            $status = 'Pending';
        } else {
            $status = 'Completed';
        }

        $Trip->update([
            // 'booking_id' => $request->booking_id,
            // 'driver_id' => $request->driver_id,
            // 'customer_id' => $request->customer_id,
            // 'vehicle_id' => $request->vehicle_id,
            // 'package_id' => $request->package_id,
            'booking_date' => $request->booking_date,
            'booking_period' => $request->booking_period,
            'advance_amount' => $advanceAmount,
            'bkash_charge'=>$bkashCharge,
            'balance_in' => $balanceIn,
            'fuel_name' => $fuelName,
            'fuel_amount' => $fuelAmount,
            'item_name' =>$itemName,
            'amount' =>$itemAmount,
            'from_area' =>$request->from_area,
            'to_area' =>$request->to_area,
            'distance' =>$request->distance,
            'trip_earning' =>$tripEarning,
            'trip_expenses' =>$tripExpenses,
            'status' =>$status,
        ]);
        Toastr::success('success','Trip Updated Successfully');
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

        Toastr::success('success','Trip Deleted Successfully');
        return redirect()->route('admin.trips.index')->with('status','Item deleted successfully');
    }


}
