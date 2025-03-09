<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\LoginController;
use App\Http\Controllers\Vendor\EmployeeController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\VendorRequestController;


Route::group(['prefix' => 'vendors', 'as' => 'vendors.'], function () {

    Route::get('/register', [VendorRequestController::class, 'create'])->name('register');
    Route::post('/register', [VendorRequestController::class, 'store'])->name('store');
    Route::get('/register/success', [VendorRequestController::class, 'success'])->name('register.success');
    
});

Route::group(['prefix' => 'vendors', 'middleware' => 'guest:employee'], function () {

    Route::get('/login', [LoginController::class, 'vendorLoginView'])->name('vendors.login');

    Route::post('/login', [LoginController::class, 'vendorLogin'])->name('vendors.login.store');
});


Route::group(['prefix' => 'vendors', 'middleware' => 'auth:employee', 'as' => 'vendors.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data', [DashboardController::class, 'data'])->name('data');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');

    Route::post('/logout', [LoginController::class, 'vendorLogout'])->name('logout'); // Changed 'Logout' to 'logout'
});

