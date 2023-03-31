<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BikashChargeController;
use App\Http\Controllers\BikashController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiclesController;
use Arcanedev\Support\Database\PrefixedModel;
use Illuminate\Support\Facades\Request;

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

/** for side bar menu active */
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'storeLogin'])->name('storeLogin');
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('register',[AuthController::class,'storeRegister'])->name('storeRegister');

});


Route::group(['middleware'=>'auth'], function() {
    Route::prefix('/')->name('admin.')->group(function() {
        Route::resource('users',UserController::class);
        Route::resource('roles',UserController::class);
        Route::resource('dashboard',AdminController::class);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
        Route::resource('drivers',DriverController::class);
        Route::resource('customers',CustomerController::class);
        Route::resource('employees',EmployeeController::class);
        Route::get('all/employees/card',[EmployeeController::class,'cardAllEmployee'])->name('employee-card');
        Route::resource('vehicles',VehiclesController::class);
        Route::resource('trips',TripController::class);
        Route::resource('trip-packages', PackageController::class);
        Route::put('drivers/{driver}/update-status',[DriverController::class,'updateStatus'])->name('drivers.update-status');
        Route::resource('employees',EmployeeController::class);
    });
    
    Route::get('/roles', [RoleController::class, 'roles'])->name('roles.index');
    
    
    
    // ----------------------------- form employee ------------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('all/employee/card', 'cardAllEmployee')->name('employee.card');
    Route::post('all/employee/search', 'employeeSearch')->name('all/employee/search');
    Route::post('all/employee/list/search', 'employeeListSearch')->name('all/employee/list/search'); 
});

// ----------------------------- profile employee ------------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee/profile/{user_id}', 'profileEmployee')->middleware('auth');
});


Route::resource('fuels', 'App\Http\Controllers\FuelsController', ['except' => ['create', 'edit']]);
});

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate']);






// Testing API

// Bikash Charge Calculation
// Route::get('/bikash-charge', [BikashChargeController::class, 'index']);
// Route::post('/bikash-charge', [BikashChargeController::class, 'calculateCharge'])->name('calculate.charge');

Route::get('/bikash', [BikashController::class, 'index']);
Route::get('/bikash/charge', [BikashController::class, 'calculateCharge'])->name('bikash-charge');
