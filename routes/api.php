<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PasswordRecoveryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Fuel APIs
Route::resource('fuels', 'App\Http\Controllers\FuelsController', ['except' => ['create', 'edit']]);
Route::resource('fuel-types', 'App\Http\Controllers\FuelTypesController', ['except' => ['create', 'edit']]);

// Vehicles APIs
Route::resource('vehicles', 'App\Http\Controllers\VehiclesController', ['except' => ['create', 'edit']]);
Route::resource('vehicle-types', 'App\Http\Controllers\VehicleTypesController', ['except' => ['create', 'edit']]);

Route::prefix('v1')->group(function () {
    Route::post('register',[AuthController::class, 'store']);
    Route::post('login',[AuthController::class, 'login']);
    Route::post('forgotpassword', [PasswordRecoveryController::class,'passwordRecovery']);
    Route::post('change/password/{user}', [PasswordRecoveryController::class,'changePassword']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware([
    'auth:sanctum'
])
->group(function () {
    //auth required routes will go here
});
Route::resource('fuel-vehicle', 'App\Http\Controllers\FuelVehicleController', ['except' => ['create', 'edit']]);
Route::resource('driver', 'App\Http\Controllers\DriverController', ['except' => ['create', 'edit']]);
Route::post('driver/{id}',[DriverController::class,'avatarUpdate']);
Route::resource('attendances', 'App\Http\Controllers\AttendancesController', ['except' => ['create', 'edit']]);
Route::resource('leave-types', 'App\Http\Controllers\LeaveTypesController', ['except' => ['create', 'edit']]);
Route::resource('leave-configs', 'App\Http\Controllers\LeaveConfigsController', ['except' => ['create', 'edit']]);
Route::resource('leaves', 'App\Http\Controllers\LeavesController', ['except' => ['create', 'edit']]);
Route::resource('transports', 'App\Http\Controllers\TransportsController', ['except' => ['create', 'edit']]);
Route::resource('driver-vehicles', 'App\Http\Controllers\DriverVehiclesController', ['except' => ['create', 'edit']]);
Route::resource('mileages', 'App\Http\Controllers\MileagesController', ['except' => ['create', 'edit']]);