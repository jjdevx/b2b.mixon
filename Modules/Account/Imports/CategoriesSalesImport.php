<?php

namespace Modules\Account\Imports;

use App\Models\Goods\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CategoriesSalesImport implements ToCollection
{
    public function collection(Collection $collection): void
    {
        \DB::transaction(function () use ($collection) {
            $collection->each(function (Collection $item) {
                $saleBig = null;
                if ($item[2] && $item[3]) {
                    $saleBig = $item[2] * ($item[3] / 100 + 1);
                }

                if ($category = Category::find($item[0])) {
                    $category->update([
                        'sale_small' => $item[1] ?? null,
                        'sale' => $item[2] ?? null,
                        'sale_big' => $saleBig
                    ]);
                }
            });
        });
    }
}
