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
        Route::resource('dashboard',AdminController::class);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
        Route::resource('drivers',DriverController::class);
        Route::resource('customers',CustomerController::class);
        Route::resource('employees',EmployeeController::class);
        Route::get('all/employees/card',[EmployeeController::class,'allEmployeeCard'])->name('all-employee-card');
        Route::resource('vehicles',VehiclesController::class);
        Route::resource('trips',TripController::class);
        Route::resource('trip-packages', PackageController::class);
    });
});



// ----------------------------- form employee ------------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('all/employee/card', 'cardAllEmployee')->middleware('auth')->name('all/employee/card');
    Route::get('all/employee/list', 'listAllEmployee')->middleware('auth')->name('all/employee/list');
    Route::post('all/employee/save', 'saveRecord')->middleware('auth')->name('all/employee/save');
    Route::get('all/employee/view/edit/{employee_id}', 'viewRecord');
    Route::post('all/employee/update', 'updateRecord')->middleware('auth')->name('all/employee/update');
    Route::get('all/employee/delete/{employee_id}', 'deleteRecord')->middleware('auth');
    Route::post('all/employee/search', 'employeeSearch')->name('all/employee/search');
    Route::post('all/employee/list/search', 'employeeListSearch')->name('all/employee/list/search');

    Route::get('form/departments/page', 'index')->middleware('auth')->name('form/departments/page');    
    Route::post('form/departments/save', 'saveRecordDepartment')->middleware('auth')->name('form/departments/save');    
    Route::post('form/department/update', 'updateRecordDepartment')->middleware('auth')->name('form/department/update');    
    Route::post('form/department/delete', 'deleteRecordDepartment')->middleware('auth')->name('form/department/delete');  
    
    Route::get('form/designations/page', 'designationsIndex')->middleware('auth')->name('form/designations/page');    
    Route::post('form/designations/save', 'saveRecordDesignations')->middleware('auth')->name('form/designations/save');    
    Route::post('form/designations/update', 'updateRecordDesignations')->middleware('auth')->name('form/designations/update');    
    Route::post('form/designations/delete', 'deleteRecordDesignations')->middleware('auth')->name('form/designations/delete');
    
    Route::get('form/timesheet/page', 'timeSheetIndex')->middleware('auth')->name('form/timesheet/page');    
    Route::post('form/timesheet/save', 'saveRecordTimeSheets')->middleware('auth')->name('form/timesheet/save');    
    Route::post('form/timesheet/update', 'updateRecordTimeSheets')->middleware('auth')->name('form/timesheet/update');    
    Route::post('form/timesheet/delete', 'deleteRecordTimeSheets')->middleware('auth')->name('form/timesheet/delete');
    
    Route::get('form/overtime/page', 'overTimeIndex')->middleware('auth')->name('form/overtime/page');    
    Route::post('form/overtime/save', 'saveRecordOverTime')->middleware('auth')->name('form/overtime/save');    
    Route::post('form/overtime/update', 'updateRecordOverTime')->middleware('auth')->name('form/overtime/update');    
    Route::post('form/overtime/delete', 'deleteRecordOverTime')->middleware('auth')->name('form/overtime/delete');  
});

// ----------------------------- profile employee ------------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee/profile/{user_id}', 'profileEmployee')->middleware('auth');
});


// ----------------------------- form leaves ------------------------------//
Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leaves/new', 'leaves')->middleware('auth')->name('form/leaves/new');
    Route::get('form/leavesemployee/new', 'leavesEmployee')->middleware('auth')->name('form/leavesemployee/new');
    Route::post('form/leaves/save', 'saveRecord')->middleware('auth')->name('form/leaves/save');
    Route::post('form/leaves/edit', 'editRecordLeave')->middleware('auth')->name('form/leaves/edit');
    Route::post('form/leaves/edit/delete','deleteLeave')->middleware('auth')->name('form/leaves/edit/delete');    
});

// ----------------------------- form attendance  ------------------------------//
Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leavesettings/page', 'leaveSettings')->middleware('auth')->name('form/leavesettings/page');
    Route::get('attendance/page', 'attendanceIndex')->middleware('auth')->name('attendance/page');
    Route::get('attendance/employee/page', 'AttendanceEmployee')->middleware('auth')->name('attendance/employee/page');
    Route::get('form/shiftscheduling/page', 'shiftScheduLing')->middleware('auth')->name('form/shiftscheduling/page');
    Route::get('form/shiftlist/page', 'shiftList')->middleware('auth')->name('form/shiftlist/page');    
});


Route::resource('fuels', 'App\Http\Controllers\FuelsController', ['except' => ['create', 'edit']]);

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate']);


// Bikash Charge Calculation
// Route::get('/bikash-charge', [BikashChargeController::class, 'index']);
// Route::post('/bikash-charge', [BikashChargeController::class, 'calculateCharge'])->name('calculate.charge');

Route::get('/bikash', [BikashController::class, 'index']);
Route::get('/bikash/charge', [BikashController::class, 'calculateCharge'])->name('bikash-charge');
