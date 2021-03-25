<?php

use Illuminate\Support\Facades\Route;

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


Route::group([
    'prefix' => 'devtools',
    'middleware' => ['auth:sanctum', 'verified']
], function () {
    Route::view('log-viewer', 'devtools.show-in-iframe', [
        'src' => config('log-viewer.route.attributes.prefix')
    ])
    ->name('logviewer.iframe');

    Route::view('telescope-frame', 'devtools.show-in-iframe', [
        'src' => config('telescope.path')
    ])
    ->name('telescope.iframe');
    
    Route::view('artisangui-iframe', 'devtools.show-in-iframe', [
        'src' => '~artisan'
    ])
    ->name('artisangui.iframe');

    Route::view('webtinker-iframe', 'devtools.show-in-iframe', [
        'src' => str_replace('/', '', config('web-tinker.path'))
    ])
    ->name('webtinker.iframe');

    Route::view('api-explorer', 'devtools.show-in-iframe', [
        'src' => config('laravelapiexplorer.route')
    ])
    ->name('apiexplorer.iframe');
    

    //theme pages
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('forms', 'forms')->name('forms');
    Route::view('cards', 'cards')->name('cards');
    Route::view('charts', 'charts')->name('charts');
    Route::view('buttons', 'buttons')->name('buttons');
    Route::view('modals', 'modals')->name('modals');
    Route::view('tables', 'tables')->name('tables');
    Route::view('calendar', 'calendar')->name('calendar');
});
