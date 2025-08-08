<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\EmiController;

Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login'); // ✅ Added
Route::post('/', [AdminLoginController::class, 'login'])->name('admin.login.submit');


// Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// ✅ Dashboard (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/loan/create', [LoanDetailController::class, 'create'])->name('loan.create');
    
    Route::post('/loan/store', [LoanDetailController::class, 'store'])->name('loan.store');
    Route::get('/loan-details', [LoanDetailController::class, 'index'])->name('loan.index');
    Route::get('/emi', [EmiController::class, 'emi'])->name('loan.emi');
    Route::post('/emi-process', [EmiController::class, 'process'])->name('emi.process');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});