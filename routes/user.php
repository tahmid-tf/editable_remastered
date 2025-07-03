<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Panel\User\Settings\Settings;

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    // ----------------------- General Settings -----------------------

    Route::get('settings', Settings::class)->name('user.settings');

});
