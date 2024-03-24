<?php

use App\Http\Controllers\Admins\CreateAdminController;
use App\Http\Controllers\Admins\ListAdminsController;
use App\Http\Controllers\Admins\ShowAdminController;
use App\Http\Controllers\Admins\UpdateAdminController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('admins')
    ->name('admins.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ADMINS])
    ->group(function () {
        Route::get('/', ListAdminsController::class)
            ->name('index');

        Route::post('/create', CreateAdminController::class)
            ->name('create.submit');

        Route::get('/{admin}', ShowAdminController::class)
            ->name('show');

        Route::put('/{admin}/update', UpdateAdminController::class)
            ->name('update');
        Route::delete('/{admin}', \App\Http\Controllers\Admins\DeleteAdminController::class)
            ->name('delete');
    });
