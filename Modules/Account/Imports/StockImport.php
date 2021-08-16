<?php

namespace Modules\Account\Imports;

use App\Models\Department;
use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StockImport implements ToCollection
{
    public function __construct(protected Department $department)
    {
    }

    public function collection(Collection $collection): void
    {
        \DB::transaction(function () use ($collection) {
            $this->department->goods()->detach();

            $stock = $collection->pluck('1', '0');
            $goods = Good::whereIn('sku', $stock->keys())->get();

            foreach ($goods as $good) {
                $this->department->goods()->save($good, ['qty' => $stock[$good->sku]]);
            }
        });
    }
}
