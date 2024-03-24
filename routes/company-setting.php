<?php

use App\Http\Controllers\CompanySetting\DeleteCompanySettingController;
use App\Http\Controllers\CompanySetting\ShowCompanySettingController;
use App\Http\Controllers\CompanySetting\StoreCompanySettingController;
use App\Http\Controllers\CompanySetting\UpdateCompanySettingController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('company-setting')
    ->name('company-setting.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_COMPANY_SETTING])
    ->group(function () {
        Route::post('/create', StoreCompanySettingController::class)
            ->name('create.submit');

        Route::get('/{companySetting}', ShowCompanySettingController::class)
            ->name('show');

        Route::put('/{companySetting}/update', UpdateCompanySettingController::class)
            ->name('update');
        Route::delete('/{admin}', DeleteCompanySettingController::class)
            ->name('delete');
    });
