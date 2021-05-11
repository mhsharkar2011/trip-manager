<?php

use App\Models\User;
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

Route::get('devpanel/login', function () {
    if (isDevpanelAutoLoginEnabled()) {
        if (! User::superAdminExists()) {
            \Artisan::call('project:create-super-admin');
        }

        $superadmin = User::getSuperAdmin();

        auth()->loginUsingId($superadmin->id);

        return redirect()->intended('/devtools/dashboard');
    }

    abort(403, 'Superadmin login is not allowed');
})->name('devpanel.superadmin.login');

Route::group([
    'prefix' => 'devtools',
    'middleware' => ['auth:sanctum', 'verified']
], function () {
    Route::view('log-viewer', 'devpanel.tools.show-in-iframe', [
        'src' => config('log-viewer.route.attributes.prefix')
    ])
    ->name('logviewer.iframe');

    Route::view('telescope-frame', 'devpanel.tools.show-in-iframe', [
        'src' => config('telescope.path')
    ])
    ->name('telescope.iframe');
    
    Route::view('artisangui-iframe', 'devpanel.tools.show-in-iframe', [
        'src' => '~artisan'
    ])
    ->name('artisangui.iframe');

    Route::view('webtinker-iframe', 'devpanel.tools.show-in-iframe', [
        'src' => str_replace('/', '', config('web-tinker.path'))
    ])
    ->name('webtinker.iframe');

    Route::view('api-explorer-compass', 'devpanel.tools.show-in-iframe', [
        'src' => config('compass.path')
    ])
    ->name('apiexplorer.compass.iframe');
    
    Route::view('api-explorer', 'devpanel.tools.show-in-iframe', [
        'src' => config('laravelapiexplorer.route')
    ])
    ->name('apiexplorer.iframe');

    Route::view('phpinfo', 'devpanel.tools.phpinfo')
    ->name('phpinfo');

    //theme pages
    Route::view('dashboard', 'devpanel.dashboard')->name('dashboard');
    Route::view('forms', 'devpanel.forms')->name('forms');
    Route::view('cards', 'devpanel.cards')->name('cards');
    Route::view('charts', 'devpanel.charts')->name('charts');
    Route::view('buttons', 'devpanel.buttons')->name('buttons');
    Route::view('modals', 'devpanel.modals')->name('modals');
    Route::view('tables', 'devpanel.tables')->name('tables');
    Route::view('calendar', 'devpanel.calendar')->name('calendar');
});
