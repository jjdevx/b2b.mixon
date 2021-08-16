<?php

namespace Modules\Account\Http\Controllers\Stock;

use App\Http\Requests\StockUpdateRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Imports\StockImport;

final class StockUpdateController extends Controller
{
    public function page(): InertiaResponse
    {
        $this->seo()->setTitle('Загрузка наличия');

        return inertia('Stock/Update', [
            'data' => [
                'department' => $this->getDepartment()
            ]
        ]);
    }

    public function handle(StockUpdateRequest $request): RedirectResponse
    {
        $department = $this->getDepartment();
        abort_if($department === null, Response::HTTP_FORBIDDEN, 'Вы не можете загружать наличие.');

        $importer = new StockImport($department);

        \Excel::import($importer, $request->file('excel'));

        $department->stock_updated_at = now();
        $department->save();

        return back()->with(['toast' => ['text' => 'Наличие товара было обновлено.']]);
    }

    private function getDepartment(): Department
    {
        return \Auth::user()->departments()->first();
    }
}
