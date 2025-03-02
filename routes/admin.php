<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\DashboardController;


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/register', [RegisterController::class, 'adminRegisterView'])->name('admin.register.view');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');
    Route::get('/login', [LoginController::class, 'adminLoginView'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login.store');
});

Route::group(['prefix' => 'admin','auth:admin'], function () {


   Route::get('/dashboard',[DashboardController::class ,'index'])->name('admin.dashboard');

   Route::post('/logout',[LoginController::class ,'adminLogout'])->name('adminLogout');

   Route::resource('categories', CategoryController::class)->except(['show']);
    
   Route::get('categories/tree', [CategoryController::class, 'tree'])->name('categories.tree');
   
   Route::resource('settings', SettingController::class);


   Route::prefix('admin')->name('admin.')->group(function() {
    
    Route::resource('branches', BranchController::class);
});


   Route::resource('vendors', VendorController::class);

   Route::resource('employees', EmployeeController::class);
   Route::post('vendors/{id}/approve', [VendorController::class, 'approve'])->name('vendors.approve');
   Route::post('vendors/{id}/block', [VendorController::class, 'block'])->name('vendors.block');
   Route::post('vendors/{id}/unblock', [VendorController::class, 'unblock'])->name('vendors.unblock');

});
