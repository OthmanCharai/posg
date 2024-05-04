<?php

use App\Http\Controllers\ArticleIso\CreateArticleIsoController;
use App\Http\Controllers\ArticleIso\DeleteArticleIsoController;
use App\Http\Controllers\ArticleIso\UpdateArticleIsoController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('article-iso')
    ->name('article-iso.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_ARTICLE])
    ->group(function () {
        Route::post('/create/{article}', CreateArticleIsoController::class)
            ->name('create');

        Route::put('/{articleIso}/update', UpdateArticleIsoController::class)
            ->name('update');

        Route::delete('/{articleIso}', DeleteArticleIsoController::class)
            ->name('delete');
    });
