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


Route::get('drivers',[DriverController::class,'index']);

Route::resource('vehicles',VehiclesController::class);

Route::get('vehicle-types',[VehicleTypesController::class,'index']);
Route::get('index',[DriverController::class,'index']);

Route::resource('posts',PostController::class);
Route::resource('comments',CommentController::class);
//  Route::get('posts',[PostController::class,'index'])->name('posts.index');
//  Route::get('posts',[PostController::class,'create'])->name('posts.create');
//  Route::post('posts',[PostController::class,'store'])->name('posts.store');
//  Route::get('posts/{id}',[PostController::class,'show'])->name('posts.show');


Route::resource('users', TestController::class);