<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\DashboardController;

// Guest routes (accessible only when not logged in)
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/register', [RegisterController::class, 'adminRegisterView'])->name('admin.register.view');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');
    Route::get('/login', [LoginController::class, 'adminLoginView'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login.store');
});

// Authenticated routes (accessible only when logged in)
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('Logout');
    
    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('categories/tree', [CategoryController::class, 'tree'])->name('categories.tree');
    
    // Settings
    Route::resource('settings', SettingController::class);
    
    // Vendors
    Route::resource('vendors', VendorController::class);
    Route::post('vendors/{id}/approve', [VendorController::class, 'approve'])->name('vendors.approve');
    Route::post('vendors/{id}/block', [VendorController::class, 'block'])->name('vendors.block');
    Route::post('vendors/{id}/unblock', [VendorController::class, 'unblock'])->name('vendors.unblock');
    
    // Employees
    Route::resource('employees', EmployeeController::class);
    
    // Branches
    Route::resource('branches', BranchController::class);
    
    // Users
    Route::resource('users', UserController::class);
    Route::put('/users/{id}/block', [UserController::class, 'block'])->name('users.block');
    Route::put('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
    Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::post('/users/{user_id}/attach-subscription', [UserController::class, 'attachSubscription'])->name('users.attachSubscription');
    
    // Subscriptions
    Route::resource('subscriptions', SubscriptionController::class);
});