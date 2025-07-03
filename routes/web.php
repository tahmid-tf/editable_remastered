<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('log_out', [DashboardController::class, 'logout'])->middleware(['auth', 'verified'])->name('log_out');
// ---------------------------------- Auth Routes ----------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// --------------------------- Admin routes ---------------------------
require __DIR__ . '/admin.php';

// --------------------------- User routes ---------------------------
require __DIR__ . '/user.php';

// --------------------------- Spatie test ---------------------------

