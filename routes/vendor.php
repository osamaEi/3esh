<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorRequestController;


Route::group(['prefix' => 'vendors', 'as' => 'vendors.'], function () {

    Route::get('/register', [VendorRequestController::class, 'create'])->name('register');
    Route::post('/register', [VendorRequestController::class, 'store'])->name('store');
    Route::get('/register/success', [VendorRequestController::class, 'success'])->name('register.success');
    
});