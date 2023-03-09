<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelTypesController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\VehicleTypesController;
use App\Http\Controllers\Web\TestController;
use Arcanedev\Support\Database\PrefixedModel;

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

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'storeLogin'])->name('storeLogin');
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('register',[AuthController::class,'storeRegister'])->name('storeRegister');

});


Route::group(['middleware'=>'auth'], function() {
    Route::prefix('/')->name('admin.')->group(function() {
        Route::resource('dashboard',AdminController::class);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
        Route::resource('drivers',DriverController::class);
        Route::resource('customers',CustomerController::class);
        Route::resource('vehicle-types',VehicleTypesController::class);
        Route::resource('vehicles',VehiclesController::class);
        Route::resource('trips',TripController::class);
        Route::resource('trip-packages', PackageController::class);
    });
});



Route::resource('fuel-types', FuelTypesController::class);
Route::resource('fuels', 'App\Http\Controllers\FuelsController', ['except' => ['create', 'edit']]);








// Route::resource('users', TestController::class);

// Route::resource('posts',PostController::class);
// Route::resource('comments',CommentController::class);