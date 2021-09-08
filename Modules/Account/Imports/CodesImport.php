<?php

namespace Modules\Account\Imports;

use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CodesImport implements ToCollection
{
    public function collection(Collection $collection): Collection
    {
        return $collection->map(function (Collection $item) {
            [$sku, $qty] = $item;
            return compact('sku', 'qty');
        });
    }
}
