<?php

use Modules\Account\Http\Controllers\{
    AuthController,
    DashboardController
};
use Modules\Account\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::prefix('login')->as('login')->group(function () {
        Route::get('', [AuthController::class, 'login'])->name('');
        Route::post('', [AuthController::class, 'try'])->name('.try');
    });
    Route::prefix('password-reset')->as('passwordReset')->group(function () {
        Route::get('', [AuthController::class, 'reset']);
        Route::post('', [AuthController::class, 'tryReset'])->name('.try')->middleware('throttle:1,1');
    });
});

Route::middleware(['auth', 'can:account.access'])->group(function () {
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('', [DashboardController::class, 'page'])->name('dashboard');
});
