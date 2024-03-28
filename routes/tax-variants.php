<?php

use App\Http\Controllers\TaxVariant\DeleteTaxVariantController;
use App\Http\Controllers\TaxVariant\ShowTaxVariantController;
use App\Http\Controllers\TaxVariant\StoreTaxVariantController;
use App\Http\Controllers\TaxVariant\UpdateTaxVariantController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('tax-variants')
    ->name('tax-variant.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_TAXES])
    ->group(function () {
        Route::post('/create/{tax}', StoreTaxVariantController::class)
            ->name('create.submit');

        Route::get('/{taxVariant}', ShowTaxVariantController::class)
            ->name('show');

        Route::put('/{taxVariant}/update', UpdateTaxVariantController::class)
            ->name('update');

        Route::delete('/{taxVariant}', DeleteTaxVariantController::class)
            ->name('delete');

        Route::get('/{tax}', \App\Http\Controllers\TaxVariant\GetTaxVariantsController::class)
            ->name('tax');
    });
