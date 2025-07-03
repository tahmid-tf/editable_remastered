<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // ----------------------- editors -----------------------

    Route::get('/editors', \App\Livewire\Panel\Admin\Editor::class)->name('editors');

});
