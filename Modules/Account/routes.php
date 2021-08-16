<?php

use Modules\Account\Http\Controllers\{AuthController,
    DashboardController,
    DepartmentController,
    Goods\CategoryController,
    Goods\GroupController,
    Stock\StockUpdateController,
    Users\ProfileController,
    Users\UserController
};
use Modules\Account\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::prefix('login')->as('login')->group(function () {
        Route::get('', [AuthController::class, 'login'])->name('');
        Route::post('', [AuthController::class, 'try'])->name('.try')->middleware('throttle:5,1');
    });
    Route::prefix('register')->as('register')->group(function () {
        Route::get('', [AuthController::class, 'register'])->name('');
        Route::post('', [AuthController::class, 'tryRegister'])->name('.try')->middleware('throttle:2,1');
    });
    Route::prefix('password-reset')->as('passwordReset')->group(function () {
        Route::get('', [AuthController::class, 'reset']);
        Route::post('', [AuthController::class, 'tryReset'])->name('.try')->middleware('throttle:2,1');
    });
});

Route::middleware(['auth', 'can:account.access'])->group(function () {
    Route::get('verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');

    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('', [DashboardController::class, 'page'])->name('dashboard');

    Route::resource('users', UserController::class)
        ->parameter('user', 'id')
        ->except(['show'])
        ->middleware('can:users.index');
    Route::delete('users/{id}/avatar', [UserController::class, 'destroyAvatar'])
        ->name('users.avatar.destroy')
        ->middleware('can:users.edit');

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::delete('avatar', [ProfileController::class, 'destroyAvatar'])->name('avatar.destroy');
    });

    Route::resource('departments', DepartmentController::class)
        ->parameter('department', 'id')
        ->except(['show'])
        ->middleware('can:departments.index');

    Route::resource('groups', GroupController::class)
        ->parameter('group', 'id')
        ->except(['show'])
        ->middleware('can:groups.index');

    Route::resource('categories', CategoryController::class)
        ->parameter('category', 'id')
        ->except(['show'])
        ->middleware('can:categories.index');

    Route::prefix('stock')->as('stock.')->group(function () {
        Route::prefix('update')->as('update.')->middleware('can:stock.update')->group(function () {
            Route::get('', [StockUpdateController::class, 'page'])->name('page');
            Route::post('', [StockUpdateController::class, 'handle'])->name('handle');
        });

    });
});
