<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HelpContentController;

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

    Route::get('login-social/{provider}',  [SocialLoginController::class, 'redirect']);
    Route::post('auto-login', [AuthController::class, 'auto_login']);
});


Route::prefix('v1')
->middleware([
    'auth:sanctum'
])
->group(function () { //auth required routes will go here
    Route::resource('users', UserController::class)->except(['edit', 'create']);
    Route::get('roles-old', [UserController::class, 'get_roles']);

    Route::get('my-profile', [UserProfileController::class, 'get']);
    Route::put('my-profile', [UserProfileController::class, 'update']);
    Route::put('my-password-change', [UserProfileController::class, 'change_password']);

    Route::resource('projects', 'App\Http\Controllers\ProjectController', ['except' => ['create', 'edit']]);
    Route::resource('projects.jobs', 'App\Http\Controllers\ProjectJobController', ['except' => ['create', 'edit']]);
    Route::resource('jobs.milestone', 'App\Http\Controllers\JobMilestoneController', ['except' => ['create', 'edit']]);

    // Role permission api lists


    Route::get('roles', [RolePermissionController::class, 'roles']);
    Route::post('roles', [RolePermissionController::class, 'role_store']);
    Route::put('roles/{role}', [RolePermissionController::class, 'role_update']);
    Route::delete('roles/{role}', [RolePermissionController::class, 'role_destroy']);
    Route::get('permissions', [RolePermissionController::class, 'permissions']);
    Route::post('permissions', [RolePermissionController::class, 'permission_store']);
    Route::put('permissions/{permission}', [RolePermissionController::class, 'permission_update']);
    Route::delete('permissions/{permission}', [RolePermissionController::class, 'permission_destroy']);
    Route::post('roles/{role}/permissions', [RolePermissionController::class, 'roles_permission_store']);
    Route::get('roles/{role}/permissions', [RolePermissionController::class, 'roles_permissions']);
    Route::delete('roles/{role}/permissions/{permission}', [RolePermissionController::class, 'roles_permissions_destroy']);
    Route::post('permissions/{permission}/roles', [RolePermissionController::class, 'permissionRoles_store']);
    Route::get('permissions/{permission}/roles', [RolePermissionController::class, 'permission_roles']);
    Route::delete('permissions/{permission}/roles/{role}', [RolePermissionController::class, 'permissions_roles_destroy']);
    Route::post('users/{user}/roles', [RolePermissionController::class, 'user_roles_store']);
    Route::get('users/{user}/roles', [RolePermissionController::class, 'user_roles']);
    Route::delete('users/{user}/roles/{role}', [RolePermissionController::class, 'user_roles_destroy']);
    Route::post('users/{user}/permission', [RolePermissionController::class, 'user_permission_store']);
    Route::get('users/{user}/permission', [RolePermissionController::class, 'user_permission_show']);
    Route::delete('users/{user}/permission', [RolePermissionController::class, 'user_permission_destroy']);

    Route::resource('help-content', 'App\Http\Controllers\HelpContentController', ['except' => ['create', 'edit','show']]);
    Route::get('help-content/{help_content:key}', [HelpContentController::class, 'show']);
});
