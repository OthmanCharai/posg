<?php

use App\Http\Controllers\Depot\CreateDepotController;
use App\Http\Controllers\Depot\DeleteDepotController;
use App\Http\Controllers\Depot\ListDepotController;
use App\Http\Controllers\Depot\ShowDepotController;
use App\Http\Controllers\Depot\UpdateDepotController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('depots')
    ->name('depots.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_SUPPLIER])
    ->group(function () {
        Route::get('/', ListDepotController::class)
            ->name('index');

        Route::post('/create', CreateDepotController::class)
            ->name('create.submit');

        Route::get('/{depot}', ShowDepotController::class)
            ->name('show');

        Route::put('/{depot}/update', UpdateDepotController::class)
            ->name('update');

        Route::delete('/{depot}', DeleteDepotController::class)
            ->name('delete');
    });
