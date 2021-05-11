<?php

use App\LiveCMS\Models\Template;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\LiveCMS\Controllers\ImagesController;
use App\LiveCMS\Controllers\PagesController;
use App\LiveCMS\Controllers\TextEditController;

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

Route::get('livecms/image-upload-form', [ImagesController::class, 'index'])
->name('imageUploadForm');

Route::post('livecms/image-upload', [ImagesController::class, 'post_upload'])
->name('imagesUpload');

Route::post('livecms/text-update', [TextEditController::class, 'update'])
->name('textUpdate');

Route::resource('cms', PagesController::class)
->middleware('auth:sanctum');

if (Schema::hasTable('live_cms_pages')) {
    foreach(Template::all() as $tpl) {
        $data = [];
        Route::view($tpl->route, $tpl->path, $data)->name($tpl->path);
    }
}
