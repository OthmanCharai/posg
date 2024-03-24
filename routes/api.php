<?php

use Illuminate\Support\Facades\Route;

// Guest
Route::group([], static function () {
    require __DIR__ . '/auth.php';
});