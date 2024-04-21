<?php

use App\Http\Controllers\AdminRole\DeleteAdminRoleController;
use App\Http\Controllers\AdminRole\ListAdminRoleController;
use App\Http\Controllers\AdminRole\ShowAdminRoleController;
use App\Http\Controllers\AdminRole\StoreAdminRoleController;
use App\Http\Controllers\AdminRole\UpdateAdminRoleController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')
    ->name('roles.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ROLES])
    ->group(function () {
        Route::get('/', ListAdminRoleController::class)
            ->name('index');

        Route::post('/create', StoreAdminRoleController::class)
            ->name('create');

        Route::get('/{adminRole}', ShowAdminRoleController::class)
            ->name('show');

        Route::put('/{adminRole}/update', UpdateAdminRoleController::class)
            ->name('update');
        Route::delete('/{adminRole}', DeleteAdminRoleController::class)
            ->name('delete');
    });
