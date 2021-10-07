<?php

use Modules\Account\Http\Controllers\{AuthController,
    DashboardController,
    DepartmentController,
    Goods\CategoryController,
    Goods\GoodsImportController,
    Goods\GroupController,
    Order\CartController,
    Order\HistoryController,
    Order\OrderController,
    Stock\StockUpdateController,
    Stock\StockViewController,
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

    Route::prefix('order')->as('order')->group(function () {
        Route::get('codes', [OrderController::class, 'byCodes'])->name('.codes');
        Route::post('codes', [OrderController::class, 'byCodes'])->name('.codes.goods');

        Route::get('{group?}/{category?}', [OrderController::class, 'page']);
        Route::post('', [OrderController::class, 'update'])->name('.update');

        Route::post('create', [OrderController::class, 'create'])->name('.create');
    });

    Route::prefix('history')->as('history')->group(function () {
        Route::get('', [HistoryController::class, 'index']);
        Route::get('{order}', [HistoryController::class, 'show'])->name('.show');
        Route::get('{order}/repeat', [HistoryController::class, 'repeat'])->name('.repeat');
    });

    Route::prefix('cart')->as('cart')->group(function () {
        Route::get('', [CartController::class, 'page']);
        Route::post('', [CartController::class, 'submit'])->name('.submit');

        Route::get('excel', [CartController::class, 'excel'])->name('.excel');
        Route::get('pdf', [CartController::class, 'pdf'])->name('.pdf');

        Route::post('plus/{id}', [CartController::class, 'plus'])->name('.plus');
        Route::post('minus/{id}', [CartController::class, 'minus'])->name('.minus');

        Route::delete('', [CartController::class, 'clear'])->name('.clear');
        Route::delete('{id}', [CartController::class, 'remove'])->name('.remove');
    });

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
    Route::post('categories/sales', [CategoryController::class, 'updateSales'])
        ->name('categories.sales')
        ->middleware('can:categories.sales.update');

    Route::prefix('goods/update')->as('goods.update')->middleware('can:goods.update')->group(function () {
        Route::get('', [GoodsImportController::class, 'page']);
        Route::post('', [GoodsImportController::class, 'handle'])->name('.handle');
    });


    Route::prefix('stock')->as('stock.')->group(function () {
        Route::prefix('update')->as('update.')->middleware('can:stocks.update')->group(function () {
            Route::get('', [StockUpdateController::class, 'page'])->name('page');
            Route::post('', [StockUpdateController::class, 'handle'])->name('handle');
        });

        Route::get('search', [StockViewController::class, 'search'])->name('search')->middleware('can:stocks.search');
        Route::get('{department?}/{category?}', [StockViewController::class, 'view'])->name('view')->middleware('can:stocks.view');
    });
});
