<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth:web', 'verified', 'admin'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Google Login Form Submission
Route::post('/google-login', [GoogleLoginController::class, 'store'])->name('google-login.store');

// Admin Routes
Route::middleware(['auth:web', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Google Form Submissions
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('submissions');
    Route::get('/submissions/{submission}', [AdminController::class, 'submissionShow'])->name('submissions.show');
    Route::delete('/submissions/{submission}', [AdminController::class, 'submissionDelete'])->name('submissions.delete');
});

require __DIR__.'/auth.php';

// Health check endpoint for monitoring
Route::get('/health', [HealthController::class, 'show']);
