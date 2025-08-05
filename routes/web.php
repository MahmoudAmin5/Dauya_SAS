<?php

use App\Http\Controllers\Auth\Api\CustomerAuthController as ApiCustomerAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\AdminAuthController as ApiAdminAuthController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest.customer')->group(function () {
    Route::get('/customer/register', [ApiCustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('/customer/register', [ApiCustomerAuthController::class, 'register']);
    Route::get('/customer/login', [ApiCustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/customer/login', [ApiCustomerAuthController::class, 'login']);
});

Route::middleware('auth:customer')->group(function () {
    Route::get('/customer/dashboard', function () {
        return 'Customer Dashboard';
    })->name('customer.dashboard');

    Route::post('/customer/logout', [ApiCustomerAuthController::class, 'logout'])->name('customer.logout');
});
Route::middleware('guest.Admin')->group(function () {
    Route::get('/Admin/login', [ApiAdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [ApiAdminAuthController::class, 'login']);
});
