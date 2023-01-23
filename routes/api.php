<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;

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

    Route::get('forgot-password', [PasswordRecoveryController::class, 'send_recovery_email']);
    Route::post('forgot-password', [PasswordRecoveryController::class, 'update_password']);
    // Route::post('change/password/{user}', [PasswordRecoveryController::class,'changePassword']);
});


Route::prefix('v1')
->middleware([
    'auth:sanctum'
])
->group(function () { //auth required routes will go here
    Route::resource('users', UserController::class)->except(['edit', 'create']);
    Route::get('roles', [UserController::class, 'get_roles']);

    Route::get('my-profile', [UserProfileController::class, 'get']);
    Route::put('my-profile', [UserProfileController::class, 'update']);
    Route::put('my-password-change', [UserProfileController::class, 'change_password']);


// Comment feature apis lists
    Route::resource('comment', 'App\Devpanel\Controllers\CommentController', ['except' => ['store', 'create', 'edit']]);
    Route::get('comment-type', [\App\Devpanel\Controllers\CommentController::class, 'commentType']);

    Route::post('{entity}/{id}/comment', [\App\Devpanel\Controllers\CommentController::class, 'store'])
        ->where('entity', '[a-z-A-Z]+')->whereNumber('id');
    Route::get('{entity}/{id}/comment', [\App\Devpanel\Controllers\CommentController::class, 'getEntityComment'])
        ->where('entity', '[a-z-A-Z]+')->whereNumber('id');

});
