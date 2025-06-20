<?php

use Illuminate\Support\Facades\Route;

// WEB
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuthController;

// API
// use App\Http\Controllers\Admin\BaseController;


// Route::get('/csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('authentications')->controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name('authentications.login');
    Route::post('/store', 'store')->name('authentications.store');
    Route::get('/logout', 'logout')->name('authentications.logout');
    Route::get('/forgot-password' , 'forgotPassword')->name('authentications.forgot-password');
    Route::get('/test-event' , 'testEvent')->name('authentications.test-event');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/' , [DashboardController::class,'index'])->name('dashboard');

    // ADMIN
    Route::prefix('admins')->controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('admins.index');
        Route::get('/create', 'create')->name('admins.create');
        Route::post('/create/store', 'store')->name('admins.store');
        Route::get('/edit/{id}', 'edit')->name('admins.edit');
        Route::put('/edit/update/{id}', 'update')->name('admins.update');
        Route::get('/detail/{id}', 'show')->name('admins.show');
        Route::delete('/delete/{id}', 'destroy')->name('admins.destroy');
    });

    // EMPLOYEE
    Route::prefix('employees')->controller(EmployeeController::class)->group(function(){
        Route::get('/', 'index')->name('employees.index');
        Route::get('/create', 'create')->name('employees.create');
        Route::post('/create/store', 'store')->name('employees.store');
        Route::get('/edit/{id}', 'edit')->name('employees.edit');
        Route::put('/edit/update/{id}', 'update')->name('employees.update');
        Route::get('/detail/{id}', 'show')->name('employees.show');
        Route::delete('/delete/{id}', 'destroy')->name('employees.destroy');
    });

    // Role
    Route::prefix('roles')->controller(RoleController::class)->group(function(){
        Route::get('/', 'index')->name('roles.index');
        Route::get('/create', 'create')->name('roles.create');
        Route::post('/create/store', 'store')->name('roles.store');
        Route::get('/edit/{id}', 'edit')->name('roles.edit');
        Route::put('/edit/update/{id}', 'update')->name('roles.update');
        Route::get('/detail/{id}', 'show')->name('roles.show');
        Route::delete('/delete/{id}', 'destroy')->name('roles.destroy');
    });

    // Permission
    Route::prefix('permissions')->controller(PermissionController::class)->group(function(){
        Route::get('/', 'index')->name('permissions.index');
        Route::get('/create', 'create')->name('permissions.create');
        Route::post('/create/store', 'store')->name('permissions.store');
        Route::get('/edit/{id}', 'edit')->name('permissions.edit');
        Route::put('/edit/update/{id}', 'update')->name('permissions.update');
        Route::get('/detail/{id}', 'show')->name('permissions.show');
        Route::delete('/delete/{id}', 'destroy')->name('permissions.destroy');
    });

    // Template
    Route::prefix('templates')->controller(TemplateController::class)->group(function(){
        Route::get('/', 'index')->name('templates.index');
        Route::get('/create', 'create')->name('templates.create');
        Route::post('/create/store', 'store')->name('templates.store');
        Route::get('/edit/{id}', 'edit')->name('templates.edit');
        Route::put('/edit/update/{id}', 'update')->name('templates.update');
        Route::get('/detail/{id}', 'show')->name('templates.show');
        Route::delete('/delete/{id}', 'destroy')->name('templates.destroy');
    });

    // Branch
    Route::prefix('branchs')->controller(BranchController::class)->group(function(){
        Route::get('/', 'index')->name('branchs.index');
        Route::get('/create', 'create')->name('branchs.create');
        Route::post('/create/store', 'store')->name('branchs.store');
        Route::get('/edit/{id}', 'edit')->name('branchs.edit');
        Route::put('/edit/update/{id}', 'update')->name('branchs.update');
        Route::get('/detail/{id}', 'show')->name('branchs.show');
        Route::delete('/delete/{id}', 'destroy')->name('branchs.destroy');

        // filter
        // Route::get('/filter', 'filter')->name('branchs.filter');
    });

    // Transaction
    Route::prefix('transactions')->controller(TransactionController::class)->group(function(){
        Route::get('/', 'index')->name('transactions.index');
        Route::get('/create', 'create')->name('transactions.create');
        Route::post('/create/store', 'store')->name('transactions.store');
        Route::get('/edit/{id}', 'edit')->name('transactions.edit');
        Route::put('/edit/update/{id}', 'update')->name('transactions.update');
        Route::get('/detail/{id}', 'show')->name('transactions.show');
        Route::delete('/delete/{id}', 'destroy')->name('transactions.destroy');
    });

    // Voucher
    Route::prefix('vouchers')->controller(VoucherController::class)->group(function(){
        Route::get('/', 'index')->name('vouchers.index');
        Route::get('/create', 'create')->name('vouchers.create');
        Route::post('/create/store', 'store')->name('vouchers.store');
        Route::get('/edit/{id}', 'edit')->name('vouchers.edit');
        Route::put('/edit/update/{id}', 'update')->name('vouchers.update');
        Route::get('/detail/{id}', 'show')->name('vouchers.show');
        Route::delete('/delete/{id}', 'destroy')->name('vouchers.destroy');

        // Add Ons Route
        Route::post('/generate-code-auto' , 'generateCodeAuto')->name('vouchers.generate-code-auto');
    });
});
