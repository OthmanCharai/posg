<?php

use App\src\Auth\AdminAuth;
use Illuminate\Support\Facades\Route;

// Guest
Route::group([], static function () {
    require __DIR__ . '/auth.php';
});

Route::group(
    [
        "middleware" => "auth:" . AdminAuth::GUARD_NAME,
    ],
    static function () {
        require __DIR__ . '/admins.php';
        require __DIR__ . '/admin-roles.php';
        require __DIR__ . '/tax.php';
        require __DIR__ . '/tax-variants.php';
        require __DIR__ . '/company-setting.php';
        require __DIR__ . '/bank-accounts.php';
        require __DIR__ . '/suppliers.php';
        require __DIR__ . '/brands.php';
        require __DIR__ . '/article-categories.php';
        require __DIR__ . '/depots.php';
    }
);