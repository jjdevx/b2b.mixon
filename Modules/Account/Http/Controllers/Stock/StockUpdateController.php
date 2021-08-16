<?php

namespace Modules\Account\Http\Controllers\Stock;

use App\Http\Requests\StockUpdateRequest;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;

class StockUpdateController extends Controller
{
    public function page(): Response
    {
        $this->seo()->setTitle('Загрузка наличия');

        return inertia('Stock/Update');
    }

    public function handle(StockUpdateRequest $request)
    {
        dd($this->file('excel'));
    }
}
