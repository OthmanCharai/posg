<?php

use App\Http\Controllers\BankAccount\CreateBankAccountController;
use App\Http\Controllers\BankAccount\DeleteBankAccountController;
use App\Http\Controllers\BankAccount\ListBankAccountController;
use App\Http\Controllers\BankAccount\ShowBankAccountController;
use App\Http\Controllers\BankAccount\UpdateBankAccountController;
use App\src\Domain\Permissions\Constants\AdminPermission;
use Illuminate\Support\Facades\Route;

Route::prefix('bank-accounts')
    ->name('bank-accounts.')
    ->middleware(['permissions:' . AdminPermission::MANAGE_BANK_ACCOUNT])
    ->group(function () {
        Route::get('/', ListBankAccountController::class)
            ->name('index');

        Route::post('/create', CreateBankAccountController::class)
            ->name('submit');

        Route::get('/{bankAccount}', ShowBankAccountController::class)
            ->name('show');

        Route::put('/{bankAccount}/update', UpdateBankAccountController::class)
            ->name('update');

        Route::delete('/{bankAccount}', DeleteBankAccountController::class)
            ->name('delete');
    });