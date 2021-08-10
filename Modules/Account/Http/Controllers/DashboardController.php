<?php

namespace Modules\Account\Http\Controllers;

use Inertia\Response;

class DashboardController extends Controller
{
    public function page(): Response
    {
        $this->seo()->setTitle('Онлайн заказ');

        return inertia('Dashboard');
    }
}
