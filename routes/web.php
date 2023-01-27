<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransportsController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('vehicles',VehiclesController::class);
Route::resource('vehicle-types',VehicleTypesController::class);

Route::resource('trips',TransportsController::class);






// Route::resource('users', TestController::class);

// Route::resource('posts',PostController::class);
// Route::resource('comments',CommentController::class);