<?php

use App\Http\Controllers\GlobalNetworkApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('global-network')->name('global-network.')->group(function () {
    Route::get('/applications/new', [GlobalNetworkApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [GlobalNetworkApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [GlobalNetworkApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{application}/edit', [GlobalNetworkApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [GlobalNetworkApplicationController::class, 'update'])->name('applications.update');
});
