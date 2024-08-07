<?php

use App\Http\Controllers\Admins\CreateAdminController;
use App\Http\Controllers\Admins\ListAdminsController;
use App\Http\Controllers\Admins\ShowAdminController;
use App\Http\Controllers\Admins\UpdateAdminController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ADMINS])
    ->group(function () {
        Route::get('/', ListAdminsController::class)
            ->name('index');

        Route::post('/create', CreateAdminController::class)
            ->name('create.submit');

        Route::get('/{user}', ShowAdminController::class)
            ->name('show');

        Route::put('/{user}/update', UpdateAdminController::class)
            ->name('update');
        Route::delete('/{user}', \App\Http\Controllers\Admins\DeleteAdminController::class)
            ->name('delete');
    });
