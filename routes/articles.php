<?php


use App\Http\Controllers\Article\CreateArticleController;
use App\Http\Controllers\Article\DeleteArticleController;
use App\Http\Controllers\Article\ListArticleController;
use App\Http\Controllers\Article\ShowArticleController;
use App\Http\Controllers\Article\UpdateArticleController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')
    ->name('articles.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_SUPPLIER])
    ->group(function () {
        Route::get('/', ListArticleController::class)
            ->name('index');

        Route::post('/create', CreateArticleController::class)
            ->name('create.submit');

        Route::get('/{article}', ShowArticleController::class)
            ->name('show');

        Route::put('/{article}/update', UpdateArticleController::class)
            ->name('update');

        Route::delete('/{article}', DeleteArticleController::class)
            ->name('delete');
    });
