<?php

use App\Http\Controllers\UserLog\CreateUserLogController;
use App\Http\Controllers\UserLog\DeleteUserLogController;
use App\Http\Controllers\UserLog\GetUserLogCreatingDataController;
use App\Http\Controllers\UserLog\UpdateUserLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('logs')->name('logs.')->middleware(config('user-activity-log.middleware'))->group(function () {
    Route::post('/', CreateUserLogController::class)->name('store');
    Route::put('/{log}', UpdateUserLogController::class)->name('update');
    Route::delete('/{log}/delete', DeleteUserLogController::class)->name('delete');
    Route::get('/data', GetUserLogCreatingDataController::class)->name('creating.data');
});

Route::prefix('user-logs')->name('logs.')->group(function () {
    Route::get('/data', GetUserLogCreatingDataController::class)->name('creating.data');
});
