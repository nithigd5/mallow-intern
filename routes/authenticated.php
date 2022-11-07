<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard' , 'index')
            ->name('dashboard');

        Route::resource('/dashboard/posts' , PostController::class);

        Route::get('/dashboard/roles', [PermissionController::class, 'viewAllRoles']);
        Route::get('/dashboard/roles/create', [PermissionController::class, 'createRole']);
        Route::post('/dashboard/roles', [PermissionController::class, 'storeRole']);
        Route::get('/dashboard/roles/users', [PermissionController::class, 'viewAllUserRoles']);

        Route::get('/dashboard/roles/assign', [PermissionController::class, 'assignRole']);
        Route::post('/dashboard/roles/assign', [PermissionController::class, 'storeAssignRole']);

        Route::put('/dashboard/roles/assign/{user}', [PermissionController::class, 'updateAssignRole']);
        Route::get('/dashboard/roles/assign/{user}/edit', [PermissionController::class, 'editAssignRole']);

        Route::delete('/dashboard/roles/{role:name}/users/{user}', [PermissionController::class, 'revokeRole'])
        ->name('roles.revoke');
        Route::put('/dashboard/roles/{role}', [PermissionController::class, 'updateRole']);
        Route::get('/dashboard/roles/{role}/edit', [PermissionController::class, 'editRole']);
    });
});
