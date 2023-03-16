<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BikashController extends Controller
{
    public function index()
    {
        return view('bikash.index');
    }

    public function calculateCharge(Request $request)
    {
        $amount = $request->input('amount');

        $charge = ($amount / 1000) * 20;
        $total = $amount + $charge;

        return response()->json([
            'charge' => $charge,
            'total' => $total
        ]);

        return response()->json([
            'charge' => $charge,
            'total' => $total
        ]);
    }
}
