<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\WalletsController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ActivetionController;
use App\Http\Controllers\Backend\InviteController;
use App\Http\Controllers\Backend\PayoutController;
use App\Http\Controllers\Backend\BnakAccountController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\CashfreeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\AizUploadController;
use App\Http\Controllers\Backend\PoolController;
/*
|--------------------------------------------------------------------------
| Back-end Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Back-end routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/
Route::get('/back-office', [DashboardController::class, 'index'])->name('back.office');
//clear-cache
Route::get('/clear-cache', [DashboardController::class, 'clearCache'])->name('clear');
Route::group(['prefix' => 'back-office', 'middleware' => ['auth']], function () {
    Route::get('welcome', [DashboardController::class, 'welcome'])->name('welcome');
    Route::get('profile', [CustomerController::class, 'profile'])->name('profile');
    Route::get('users/level', [CustomerController::class, 'levels'])->name('user.levels');
    Route::get('dashboard', [DashboardController::class, 'clintdashboard'])->name('client.dashboard')->middleware('activation');
    //member
    Route::resource('customer', CustomerController::class);
    Route::get('pool/community/{id}', [PoolController::class, 'treeView'])->name('user.pool.community');
    Route::get('pool/slabs', [PoolController::class, 'slabs'])->name('user.pool.slabs');
    Route::resource('pool', PoolController::class);
    //wallets
    Route::resource('wallets', WalletsController::class);
    Route::group(['prefix' => 'wallets'], function () {
          Route::get('payment/{id}/{plan}', [WalletsController::class, 'plan_payment'])->name('wallets.plan.payment');
          Route::get('transactions/{id}', [WalletsController::class, 'transactions'])->name('wallets.transactions');
          Route::get('debitcredit/{id}', [WalletsController::class, 'debitcredit'])->name('wallets.debitcredit');
          Route::get('recharge/{id}', [WalletsController::class, 'recharge'])->name('wallets.recharge');
    });
    Route::post('recharge/wallet/cashfree', [CashfreeController::class,'recharge'])->name('recharge.cashfree');
    //setting
    Route::resource('setting', SettingController::class);
    //invite
    Route::resource('invite', InviteController::class);
    //subscriprion
    Route::resource('subscriprion', ActivetionController::class);
    Route::group(['prefix' => 'subscriprion'], function () {
        Route::get('payment/{id}', [ActivetionController::class, 'manual_payment'])->name('subscriprion.payment');
        Route::get('manual/{id}', [ActivetionController::class, 'manual_offline'])->name('subscriprion.manual');
    });
    //invite
    Route::resource('payout', PayoutController::class);
    Route::group(['prefix' => 'payout'], function () {
        //Route::post('store', [PayoutController::class, 'store'])->name('payout.store')->middleware(['throttle:payout']);
        Route::get('status/{payout}/{status}', [PayoutController::class, 'status_update'])->name('payout.status.update');
        Route::get('remove/{payout}', [PayoutController::class, 'destroy'])->name('payout.remove');
    });
    //banks
    Route::resource('bank', BnakAccountController::class);
    Route::group(['prefix' => 'bank'], function () {
        Route::get('status/{bank}/{status}', [BnakAccountController::class, 'status_update'])->name('bank.status.update');
        Route::get('remove/{bank}', [BnakAccountController::class, 'destroy'])->name('bank.remove');
    });
    //document
    Route::resource('document', DocumentController::class);
    Route::group(['prefix' => 'document'], function () {
        Route::post('upload/aadhaar', [DocumentController::class, 'uploadAadhaar'])->name('upload.aadhaar');
        Route::post('upload/pan', [DocumentController::class, 'uploadPan'])->name('upload.pan');
        Route::get('update/{status}/{id}', [DocumentController::class, 'updateStatus'])->name('update.status');
    });

    Route::get('payment/{id}/{plan}', [CashfreeController::class, 'online_pay'])->name('plan.payment');
    //uploaded files
    Route::resource('/uploaded-files', AizUploadController::class);
    Route::controller(AizUploadController::class)->group(function () {
        Route::any('/uploaded-files/file-info', 'file_info')->name('uploaded-files.info');
        //Route::get('/uploaded-files/destroy/{id}', 'destroy')->name('uploaded-files.destroy');
    });
});
Route::post('payment/success/{user_id}/{plan}', [CashfreeController::class, 'payment_success'])->name('payment.success');
Route::post('payment/recharge/wallets/success', [CashfreeController::class,'recharge_success'])->name('recharge.success');
