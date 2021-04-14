<?php

use App\Http\Controllers\CrudGenerateController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityFieldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('entities', EntityController::class);
Route::apiResource('entities.fields', EntityFieldController::class);

Route::post('entities/{entity}/crud-generate', CrudGenerateController::class);