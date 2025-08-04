<?php

use App\Http\Controllers\Auth\Api\CustomerAuthController as ApiCustomerAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerAuthController;

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
