<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\src\Auth\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::middleware(['guest:' . AdminAuth::GUARD_NAME])
            ->group(function () {
                Route::post('/login', LoginController::class)
                    ->name('login.submit');
            });

        Route::middleware(['auth:' . AdminAuth::GUARD_NAME])
            ->group(function () {
                Route::post('/logout', LogoutController::class)
                    ->name('logout');
            });
    });
