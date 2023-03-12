<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Package;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['driverAvatar'] = Session::get('name');
        $data['usersName'] = auth()->user()->full_name;
        $data['trips'] = Trip::all();
        $data['tripCount'] = Trip::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        // Customer
        $data['customers'] = Customer::all();
        $data['customerCount'] = Customer::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        // Vehicles
        $data['vehicles'] = Vehicle::all();
        $data['vehicleCount'] = Vehicle::count();
        $increase = $data['vehicleCount'] * 0.10;
        $data['totalVehicles'] = $data['vehicleCount'] + $increase;
        // Drivers
        $data['drivers'] = Driver::all();
        $data['driverCount'] = Driver::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        // Package
        $data['packages'] = Package::all();
        $data['packageCount'] = Package::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        // Attendance
        $data['attendance'] = Attendance::all();
        $data['attendanceCount'] = Attendance::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        
        return view('admin.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
