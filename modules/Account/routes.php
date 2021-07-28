<?php

use Modules\Account\Http\Middleware\RedirectIfAuthenticated;
use Modules\Account\Http\Controllers\AuthController;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::prefix('login')->as('login')->group(function () {
        Route::get('', [AuthController::class, 'login']);
        Route::post('', [AuthController::class, 'try'])->name('.try');
    });
});
