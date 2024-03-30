<?php

use App\Http\Controllers\Brands\CreateBrandController;
use App\Http\Controllers\Brands\DeleteBrandController;
use App\Http\Controllers\Brands\ListBrandsController;
use App\Http\Controllers\Brands\ShowBrandController;
use App\Http\Controllers\Brands\UpdateBrandController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('brands')
    ->name('brands.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_SUPPLIER])
    ->group(function () {
        Route::get('/', ListBrandsController::class)
            ->name('index');

        Route::post('/create', CreateBrandController::class)
            ->name('create.submit');

        Route::get('/{brand}', ShowBrandController::class)
            ->name('show');

        Route::put('/{brand}/update', UpdateBrandController::class)
            ->name('update');

        Route::delete('/{brand}', DeleteBrandController::class)
            ->name('delete');
    });
