<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Panel\User\Settings\Settings;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    // ----------------------- General Settings -----------------------

    Route::get('settings', Settings::class)->name('user.settings');

    // ----------------------- order page -----------------------

    Route::get('orders_data', \App\Livewire\Panel\User\Order\OrderView::class)->name('users.orders.data');
    Route::get('make_order', \App\Livewire\Panel\User\Order\MakeOrder::class)->name('users.orders.make');

});
