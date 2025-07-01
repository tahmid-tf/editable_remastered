<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ---------------------------------- Auth Routes ----------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// --------------------------- Spatie test ---------------------------

//Route::get('/test', function () {
//    $role = Role::create(['name' => 'user']);
//    \App\Models\User::find(2)->assignRole('user');
//    return \App\Models\User::find(1)->hasRole('admin');
//});

Route::get('dashboard_test', function () {
    return view('layouts.dashboard.main');
});
