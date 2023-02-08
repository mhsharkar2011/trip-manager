<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleTypesController;
use Whoops\Util\Misc;

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



Route::prefix('v1')->group(function () {
    Route::post('register',[AuthController::class, 'store']);
    Route::post('login',[AuthController::class, 'login']);
    Route::post('forgotpassword', [PasswordRecoveryController::class,'passwordRecovery']);
    Route::post('change/password/{user}', [PasswordRecoveryController::class,'changePassword']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->middleware([
    'auth:sanctum'
])
->group(function () {
    //auth required routes will go here
    Route::apiResource('users',UserController::class);

});

// Driver API

Route::post('user-avatar/{id}',[DriverController::class,'avatarUpdate']);
// Vehicles APIs
Route::apiResource('vehicles', 'App\Http\Controllers\VehiclesController',['names'=>'api/vehicles'], ['except' => ['create', 'edit']]);
Route::apiResource('vehicle-types', 'App\Http\Controllers\VehicleTypesController', ['names'=>'api/vehicle-types'], ['except' => ['create', 'edit']]);
Route::resource('user-vehicles', 'App\Http\Controllers\DriverVehiclesController', ['except' => ['create', 'edit']]);
// Fuel APIs
Route::resource('fuels', 'App\Http\Controllers\FuelsController', ['names'=>'api/fuels'], ['except' => ['create', 'edit']]);
Route::resource('fuel-types', 'App\Http\Controllers\FuelTypesController',['names'=>'api/fuel-types'], ['except' => ['create', 'edit']]);
Route::resource('fuel-vehicle', 'App\Http\Controllers\FuelVehicleController', ['except' => ['create', 'edit']]);
// Attendance APIs
Route::resource('attendances', 'App\Http\Controllers\AttendancesController', ['except' => ['create', 'edit']]);
Route::resource('leave-types', 'App\Http\Controllers\LeaveTypesController', ['except' => ['create', 'edit']]);
Route::resource('leave-configs', 'App\Http\Controllers\LeaveConfigsController', ['except' => ['create', 'edit']]);
Route::resource('leaves', 'App\Http\Controllers\LeavesController', ['except' => ['create', 'edit']]);

// Transport APIs
Route::apiResource('trips', 'App\Http\Controllers\TransportsController', ['names'=>'api/trips'], ['except' => ['create', 'edit']]);

Route::apiResource('mileages', 'App\Http\Controllers\MileagesController',['names'=>'api/mileages'], ['except' => ['create', 'edit']]);

Route::get('reports',[ReportController::class,'index']);
Route::resource('roles', 'App\Http\Controllers\RolesController', ['except' => ['create', 'edit']]);
Route::resource('role-users', 'App\Http\Controllers\RoleUsersController', ['except' => ['create', 'edit']]);


// Route::apiResource('posts',PostController::class);
// Route::apiResource('comments',CommentController::class);


Route::resource('package', 'App\Http\Controllers\PackageController',['names'=>'api/package'], ['except' => ['create', 'edit']]);