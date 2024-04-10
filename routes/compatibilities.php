<?php


use App\Http\Controllers\Compatibility\CreateCompatibilityController;
use App\Http\Controllers\Compatibility\DeleteCompatibilityController;
use App\Http\Controllers\Compatibility\GetCompatibilitiesController;
use App\Http\Controllers\Compatibility\ShowCompatibilityController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('compatibilities')
    ->name('compatibilities.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ARTICLE])
    ->group(function () {
        Route::get('/', GetCompatibilitiesController::class)
            ->name('index');

        Route::post('/create', CreateCompatibilityController::class)
            ->name('create.submit');

        Route::get('/{compatibility}', ShowCompatibilityController::class)
            ->name('show');

        Route::put('/{compatibility}/update', \App\Http\Controllers\Compatibility\UpdateCompatibilityController::class)
            ->name('update');

        Route::delete('/{compatibility}', DeleteCompatibilityController::class)
            ->name('delete');
    });
