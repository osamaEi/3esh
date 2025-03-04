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


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/register', [RegisterController::class, 'adminRegisterView'])->name('admin.register.view');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');
    Route::get('/login', [LoginController::class, 'adminLoginView'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login.store');
});

Route::put('/users/{id}/block', [UserController::class, 'block'])->name('users.block');
Route::put('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

Route::group(['prefix' => 'admin','auth:admin'], function () {


   Route::get('/dashboard',[DashboardController::class ,'index'])->name('admin.dashboard');

   Route::post('/logout',[LoginController::class ,'adminLogout'])->name('adminLogout');

   Route::resource('categories', CategoryController::class)->except(['show']);
    
   Route::get('categories/tree', [CategoryController::class, 'tree'])->name('categories.tree');
   
   Route::resource('settings', SettingController::class);


   Route::prefix('admin')->name('admin.')->group(function() {
    
    Route::resource('branches', BranchController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/{user_id}/attach-subscription', [UserController::class, 'attachSubscription'])->name('users.attachSubscription');
});


   Route::resource('vendors', VendorController::class);

   Route::resource('employees', EmployeeController::class);
   Route::post('vendors/{id}/approve', [VendorController::class, 'approve'])->name('vendors.approve');
   Route::post('vendors/{id}/block', [VendorController::class, 'block'])->name('vendors.block');
   Route::post('vendors/{id}/unblock', [VendorController::class, 'unblock'])->name('vendors.unblock');

});

Route::prefix('admin')->group(function () {
    Route::resource('subscriptions', SubscriptionController::class)->names([
        'index' => 'admin.subscriptions.index',
        'create' => 'admin.subscriptions.create',
        'store' => 'admin.subscriptions.store',
        'show' => 'admin.subscriptions.show',
        'edit' => 'admin.subscriptions.edit',
        'update' => 'admin.subscriptions.update',
        'destroy' => 'admin.subscriptions.destroy',
    ]);
});