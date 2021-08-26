<?php

namespace Modules\Account\Http\Controllers\Goods;

use App\Http\Requests\StockUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Imports\GoodsImport;

class GoodsImportController extends Controller
{
    public function page(): Response
    {
        $this->seo()->setTitle('Загрузка товаров');

        return inertia('Goods/Update');
    }

    public function handle(StockUpdateRequest $request): RedirectResponse
    {
        try {
            \Excel::import(new GoodsImport(), $request->file('excel'));
        } catch (\Exception $e) {
            return back()->with(['flash' => ['text' => "Ошибка при обновлении: {$e->getMessage()}", 'icon' => 'error']]);
        }

        return back()->with(['toast' => ['text' => 'Товары были обновлены.']]);
    }
}
