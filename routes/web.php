<?php

use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransportsController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\VehicleTypesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::get('vehicles',[VehiclesController::class,'index']);
Route::get('vehicle-types',[VehicleTypesController::class,'index']);
Route::get('index',[DriverController::class,'index']);
Route::get('transports',[TransportsController::class,'index']);