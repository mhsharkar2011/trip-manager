<?php

use App\LiveCMS\Controllers;
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

Route::get('livecms/image-upload-form', [ImagesController::class, 'index'])
->name('imageUploadForm');

Route::post('livecms/image-upload', [ImagesController::class, 'post_upload'])
->name('imagesUpload');

Route::post('livecms/text-update', [ImagesController::class, 'update'])
->name('textUpdate');

