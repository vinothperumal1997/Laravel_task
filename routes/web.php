<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\EmiController;

/*
|--------------------------------------------------------------------------
| Public Routes (Login)
|--------------------------------------------------------------------------
*/

// Laravel default auth expects a route named "login"
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login');

// Admin login form (you can use same function as /login)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

// Admin login submit
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes (auth required)
|--------------------------------------------------------------------------
| These routes are accessible only after login
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Loan Create
    Route::get('/loan/create', [LoanDetailController::class, 'create'])->name('loan.create');

    // Loan Store
    Route::post('/loan/store', [LoanDetailController::class, 'store'])->name('loan.store');

    // Loan List
    Route::get('/loan-details', [LoanDetailController::class, 'index'])->name('loan.index');

    // EMI Form
    Route::get('/emi', [EmiController::class, 'emi'])->name('loan.emi');

    // EMI Processing
    Route::post('/emi-process', [EmiController::class, 'process'])->name('emi.process');

    // Logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
