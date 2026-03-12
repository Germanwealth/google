<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WalletConnectionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Wallet connection endpoint
Route::post('/connect/wallet', [WalletConnectionController::class, 'store']);

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Contact Messages
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{contactMessage}', [AdminController::class, 'contactShow'])->name('contacts.show');
    Route::post('/contacts/{contactMessage}/reply', [AdminController::class, 'contactReply'])->name('contacts.reply');
    Route::delete('/contacts/{contactMessage}', [AdminController::class, 'contactDelete'])->name('contacts.delete');

    // Transactions
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{transaction}', [AdminController::class, 'transactionShow'])->name('transactions.show');
    Route::patch('/transactions/{transaction}', [AdminController::class, 'transactionUpdate'])->name('transactions.update');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'userShow'])->name('users.show');

    // Investment Plans
    Route::get('/investment-plans', [AdminController::class, 'investmentPlans'])->name('investment-plans');
    Route::get('/investment-plans/{investmentPlan}', [AdminController::class, 'investmentPlanShow'])->name('investment-plans.show');

    // Wallet Connections
    Route::get('/wallet-connections', [AdminController::class, 'walletConnections'])->name('wallet-connections');
    Route::get('/wallet-connections/{walletConnection}', [AdminController::class, 'walletConnectionShow'])->name('wallet-connections.show');
});

Route::get('/connect', [WalletController::class, 'index'])->name('connect');
Route::post('/connect', [WalletController::class, 'connect'])->name('connect.submit');

// Health check endpoint for monitoring
Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});
