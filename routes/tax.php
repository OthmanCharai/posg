<?php

use App\Http\Controllers\Tax\DeleteTaxController;
use App\Http\Controllers\Tax\ShowTaxController;
use App\Http\Controllers\Tax\StoreTaxController;
use App\Http\Controllers\Tax\UpdateTaxController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('tax')
    ->name('tax.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_TAXES])
    ->group(function () {
        Route::post('/create', StoreTaxController::class)
            ->name('create.submit');

        Route::get('/{tax}', ShowTaxController::class)
            ->name('show');

        Route::put('/{tax}/update', UpdateTaxController::class)
            ->name('update');

        Route::delete('/{tax}', DeleteTaxController::class)
            ->name('delete');
    });
