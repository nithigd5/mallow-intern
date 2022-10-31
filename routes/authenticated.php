<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard' , 'index')
            ->name('dashboard');

        Route::resource('/dashboard/posts' , PostController::class);
    });
});
