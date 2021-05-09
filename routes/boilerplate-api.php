<?php

use App\Devpanel\Controllers\AttachmentController;
use App\Devpanel\Controllers\CrudGenerateController;
use App\Devpanel\Controllers\EntityController;
use App\Devpanel\Controllers\EntityFieldController;
use App\Http\Controllers\InsuranceTypesController;
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

Route::delete('{entity}/{id}/attachments/{attachment_id}', [AttachmentController::class, 'delete'])
->where('entity', '[a-z-A-Z]+')->whereNumber('id')->whereNumber('attachment_id');