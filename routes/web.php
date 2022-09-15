<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\AizUploadController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user-login', [HomeController::class, 'user_login'])->name('user.login');
Route::get('/user-signup', [HomeController::class, 'user_signup'])->name('user.signup');

Route::get('/user/logout', [LoginController::class, 'logout'])->name('user.logout');
Auth::routes();

// AIZ Uploader
Route::controller(AizUploadController::class)->group(function () {
    Route::post('/aiz-uploader', 'show_uploader');
    Route::post('/aiz-uploader/upload', 'upload');
    Route::get('/aiz-uploader/get_uploaded_files', 'get_uploaded_files');
    Route::post('/aiz-uploader/get_file_by_ids', 'get_preview_files');
    Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
});

