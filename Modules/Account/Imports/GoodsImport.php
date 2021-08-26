<?php

namespace Modules\Account\Imports;

use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsImport implements ToCollection
{
    public function collection(Collection $collection): void
    {
        \DB::transaction(function () use ($collection) {
            $collection->each(function (Collection $item) {
                [$sku, $name, $rrp, , , , , , , , , , , , $weight, $category_id] = $item;

                if ($name[0] === '.') {
                    $name = substr($name, 1);
                }
                if ($weight === 0.0) {
                    $weight = null;
                }

                try {
                    Good::updateOrCreate(['sku' => $sku], compact('category_id', 'sku', 'name', 'rrp', 'weight'));
                } catch (\Exception $e) {
                }
            });
        });
    }
}
