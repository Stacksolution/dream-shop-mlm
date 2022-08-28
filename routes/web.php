<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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

