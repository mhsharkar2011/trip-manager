<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use PharIo\Version\Version;

class ReportController extends Controller
{
    public function index()
    {
        $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE);

        $vehicleTypes = VehicleType::with('vehicles')->latest()->paginate($items_per_page);

        return view('pages.index',['vehicleTypes'=>$vehicleTypes]);
    }
}
