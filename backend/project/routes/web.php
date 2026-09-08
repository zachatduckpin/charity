<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Gateway\Razorpay;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return redirect()->route('admin.login');
});





Route::post('the/genius/ocean/2441139', [LoginController::class, 'subscription']);
Route::get('finalize', [LoginController::class, 'finalize']);
Route::get('update-finalize', [LoginController::class, 'updateFinalize']);
Route::post('razorpay/notify', [Razorpay::class, 'notify'])->name('razorpay.notify');