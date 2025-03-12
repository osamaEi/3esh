<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\DashboardController;


Route::group(['middleware' => 'setlocale'], function () {
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/register', [RegisterController::class, 'adminRegisterView'])->name('admin.register.view');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');
    Route::get('/login', [LoginController::class, 'adminLoginView'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('Logout');
    

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('categories/tree', [CategoryController::class, 'tree'])->name('categories.tree');
    

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/{setting}', [SettingController::class, 'show'])->name('settings.show');
    Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');
    

    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
    Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store');
    Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendors.show');
    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
    Route::put('/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');
    Route::delete('/vendors/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy');
    Route::post('vendors/{id}/approve', [VendorController::class, 'approve'])->name('vendors.approve');
    Route::post('vendors/{id}/block', [VendorController::class, 'block'])->name('vendors.block');
    Route::post('vendors/{id}/unblock', [VendorController::class, 'unblock'])->name('vendors.unblock');
    

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');    

    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');    
    Route::resource('users', UserController::class);
    Route::put('/users/{id}/block', [UserController::class, 'block'])->name('users.block');
    Route::put('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
    Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::post('/users/{user_id}/attach-subscription', [UserController::class, 'attachSubscription'])->name('users.attachSubscription');
    
    Route::resource('subscriptions', SubscriptionController::class);
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');

    Route::resource('UserProfile', ProfileController::class);
    Route::post('/update-email', [ProfileController::class, 'updateEmail'])->name('update.email');
});
});