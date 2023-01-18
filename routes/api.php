<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\UserController;

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


Route::middleware([
    'auth:sanctum'     
])
->group(function () { //auth required routes will go here
    Route::resource('users', UserController::class)->except(['edit', 'create']);
});
