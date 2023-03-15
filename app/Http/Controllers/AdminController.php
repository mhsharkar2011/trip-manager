<?php

namespace App\Http\Controllers;

use App\Charts\TripEarnChart;
use App\Models\Attendance;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Package;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $user_id = auth()->user()->id;
        $data['driverAvatar'] = Session::get('name');
        $data['usersName'] = auth()->user()->full_name;
        
        // Trips
        $data['trips'] = Trip::all();
        $data['topTrip'] = Trip::latest()->paginate();
        $data['tripCount'] = Trip::count();

        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;
        
        // New Trips
        $data['newTrip'] = Trip::where('status','pending')->get();
        $data['newTripCount'] = Trip::where('status','pending')->count();

        // Calculate the date range for the Current month
        $now = Carbon::now();
        $startOfTripMonth = $now->startOfMonth()->toDateTimeString();
        $endOfTripMonth = $now->endOfMonth()->toDateTimeString();
        $data['currentMonthTrips'] = Trip::where('status','completed')->where('booking_date','>=',$startOfTripMonth)->where('booking_date','<=',$endOfTripMonth)
                              ->count();

        // Calculate the date range for the last month
        $now = Carbon::now();
        $startOfTripLastMonth = $now->subMonth()->startOfMonth()->toDateTimeString();
        $endOfTripLastMonth = $now->endOfMonth()->toDateTimeString();
        $data['lastMonthTrips'] = Trip::where('status','completed')->where('booking_date','>=',$startOfTripLastMonth)->where('booking_date','<=',$endOfTripLastMonth)
                              ->count();
        // Earnings ------------------------------------------------------
        $data['totalEarn'] = Trip::where('status','completed')->sum('trip_earning');

        // Calculate the date range for the Current month
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString();
        $endOfMonth = $now->endOfMonth()->toDateTimeString();
        $data['currentMonthEarn'] = Trip::where('status','completed')->where('booking_date','>=',$startOfMonth)->where('booking_date','<=',$endOfMonth)
                              ->sum('trip_earning');

        // Calculate the date range for the last month
        $now = Carbon::now();
        $startOfLastMonth = $now->subMonth()->startOfMonth()->toDateTimeString();
        $endOfLastMonth = $now->endOfMonth()->toDateTimeString();
        $data['lastMonthEarn'] = Trip::where('status','completed')->where('booking_date','>=',$startOfLastMonth)->where('booking_date','<=',$endOfLastMonth)
                              ->sum('trip_earning');

        
        // Expenses ------------------------------------------------------
        $data['totalExpenses'] = Trip::where('status','completed')->sum('cost_amount');
        // Calculate the date range for the last month
        $now = Carbon::now();
        $startOfLastMonth = $now->subMonth()->startOfMonth()->toDateTimeString();
        $endOfLastMonth = $now->endOfMonth()->toDateTimeString();
        $data['lastMonthExpenses'] = Trip::where('status','completed')->where('booking_date','>=',$startOfLastMonth)->where('booking_date','<=',$endOfLastMonth)
                              ->sum('cost_amount');

        // Calculate the date range for the Current month
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString();
        $endOfMonth = $now->endOfMonth()->toDateTimeString();
        $data['currentMonthExpenses'] = Trip::where('status','completed')->where('booking_date','>=',$startOfMonth)->where('booking_date','<=',$endOfMonth)
                              ->sum('cost_amount');
        // Profit ---------------------------------------------------------
        $data['currentMonthProfit'] = $data['currentMonthEarn'] - $data['currentMonthExpenses'];
        $data['lastMonthProfit'] = $data['lastMonthEarn'] - $data['lastMonthExpenses'];
        $data['totalProfit'] = $data['totalEarn'] - $data['totalExpenses'];
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
        // Client
        $data['clients'] = Customer::all();
        $data['clientCount'] = Customer::count();
        $increase = $data['clientCount'] * 0.10;
        $data['totalClient'] = $data['clientCount'] + $increase;

        // Attendance
        $data['attendance'] = Attendance::all();
        $data['attendanceCount'] = Attendance::count();
        $increase = $data['tripCount'] * 0.10;
        $data['totalTrips'] = $data['tripCount'] + $increase;


        // Chart 
        // $today_users = User::whereDate('created_at', today())->count();
        // $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        // $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

        $chartTripEarn = new TripEarnChart();
        $chartTripEarn->labels(['Last Month','Current Month']);
        // $chartTripEarn->barWidth(0.9);
        $chartTripEarn->title($title = 'TOTAL REVENUE',$font_size = 24, $color = '#fff',$bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        
        $chartTripProfit = new TripEarnChart();
        $chartTripProfit->labels(['Last Month Profit','Current Month Profit']);
        $chartTripProfit->title($title = 'TOTAL PROFIT',$font_size = 24, $color = '#fff',$bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chartTripEarn->dataset('Earning', 'bar', [$data['lastMonthEarn'],$data['currentMonthEarn']])->backgroundColor('#f43b48');
        $chartTripEarn->dataset('Expenses', 'bar', [$data['lastMonthExpenses'],$data['currentMonthExpenses']])->backgroundColor('blue');
        $chartTripProfit->dataset('Profile', 'line', [$data['currentMonthProfit'],$data['lastMonthProfit']])->backgroundColor('darkgreen');

        return view('admin.dashboard',$data,['chartTripEarn'=>$chartTripEarn,'chartTripProfit'=>$chartTripProfit],);
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
