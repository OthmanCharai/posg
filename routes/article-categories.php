<?php

use App\Http\Controllers\ArticleCategory\CreateArticleCategoryController;
use App\Http\Controllers\ArticleCategory\DeleteArticleCategoryController;
use App\Http\Controllers\ArticleCategory\ListArticleCategoryController;
use App\Http\Controllers\ArticleCategory\ShowArticleCategoryController;
use App\Http\Controllers\ArticleCategory\UpdateArticleCategoryController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('article-categories')
    ->name('article-categories.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_SUPPLIER])
    ->group(function () {
        Route::post('/create', CreateArticleCategoryController::class)
            ->name('create.submit');

        Route::get('/{articleCategory}', ShowArticleCategoryController::class)
            ->name('show');

        Route::put('/{articleCategory}/update', UpdateArticleCategoryController::class)
            ->name('update');

        Route::delete('/{articleCategory}', DeleteArticleCategoryController::class)
            ->name('delete');

        Route::get('/', ListArticleCategoryController::class)
            ->name('list');
    });
