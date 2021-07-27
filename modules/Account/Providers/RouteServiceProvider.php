<?php

namespace Modules\Account\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Middleware\HandleInertiaRequests;


class RouteServiceProvider extends ServiceProvider
{
    protected string $moduleNamespace = 'Modules\Account\Http\Controllers';

    public function map(): void
    {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware(['web', HandleInertiaRequests::class])
            ->namespace($this->moduleNamespace)
            ->as('account.')
            ->group(module_path('Account', '/routes.php'));
    }
}
