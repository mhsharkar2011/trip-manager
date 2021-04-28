<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CrudGenerateController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityFieldController;
use App\Models\InsuranceType;
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

/**
 * One endpoint used by all entities for retrieving, uploading attachments
 */
Route::get('{entity}/{id}/attachments', [AttachmentController::class, 'get'])
->where('entity', '[a-z-A-Z]+')->whereNumber('id');

Route::post('{entity}/{id}/attachments', [AttachmentController::class, 'upload'])
->where('entity', '[a-z-A-Z]+')->whereNumber('id');
