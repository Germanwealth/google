<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WalletConnectionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Google Login Form Submission
Route::post('/google-login', [GoogleLoginController::class, 'store'])->name('google-login.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Wallet connection endpoint (CSRF exempt - for static HTML form)
Route::post('/connect/wallet', [WalletConnectionController::class, 'store']);

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Contact Messages
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{contactMessage}', [AdminController::class, 'contactShow'])->name('contacts.show');
    Route::post('/contacts/{contactMessage}/reply', [AdminController::class, 'contactReply'])->name('contacts.reply');
    Route::delete('/contacts/{contactMessage}', [AdminController::class, 'contactDelete'])->name('contacts.delete');

    // Wallet Connections
    Route::get('/wallet-connections', [AdminController::class, 'walletConnections'])->name('wallet-connections');
    Route::get('/wallet-connections/{walletConnection}', [AdminController::class, 'walletConnectionShow'])->name('wallet-connections.show');
    Route::delete('/wallet-connections/{walletConnection}', [AdminController::class, 'walletConnectionDelete'])->name('wallet-connections.delete');
});

Route::get('/connect', [WalletController::class, 'index'])->name('connect');
Route::post('/connect', [WalletController::class, 'connect'])->name('connect.submit');

// Health check endpoint for monitoring
Route::get('/health', [HealthController::class, 'show']);
