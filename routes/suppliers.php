<?php

use App\Http\Controllers\Supplier\DeleteSupplierController;
use App\Http\Controllers\Supplier\ListSupplierController;
use App\Http\Controllers\Supplier\ShowSupplierController;
use App\Http\Controllers\Supplier\StoreSupplierController;
use App\Http\Controllers\Supplier\UpdateSupplierController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('suppliers')
    ->name('suppliers.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_SUPPLIER])
    ->group(function () {
        Route::get('/', ListSupplierController::class)
            ->name('index');

        Route::post('/create', StoreSupplierController::class)
            ->name('create');

        Route::get('/{supplier}', ShowSupplierController::class)
            ->name('show');

        Route::put('/{supplier}/update', UpdateSupplierController::class)
            ->name('update');

        Route::delete('/{supplier}', DeleteSupplierController::class)
            ->name('delete');
    });