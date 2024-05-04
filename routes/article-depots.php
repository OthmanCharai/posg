<?php

use App\Http\Controllers\ArticleDepot\CreateArticleDepotController;
use App\Http\Controllers\ArticleDepot\DeleteArticleDepotController;
use App\Http\Controllers\ArticleDepot\UpdateArticleDepotController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('article-depots')
    ->name('article-depots.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ARTICLE])
    ->group(function () {
        Route::post('/{article}/create', CreateArticleDepotController::class)
            ->name('create');

        Route::put('/{articleDepot}/update', UpdateArticleDepotController::class)
            ->name('update');

        Route::delete('/{articleDepot}', DeleteArticleDepotController::class)
            ->name('delete');
    });
