<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // ----------------------- editors -----------------------

    Route::get('/editors', \App\Livewire\Panel\Admin\Editor::class)->name('editors');
    Route::get('/categories', \App\Livewire\Panel\Admin\Categories::class)->name('categories');
    Route::get('/styles', \App\Livewire\Panel\Admin\StylesView::class)->name('styles');
    Route::get('admin-order-data', \App\Livewire\Panel\Admin\Order\OrderView::class)->name('admin-order-data');
});
