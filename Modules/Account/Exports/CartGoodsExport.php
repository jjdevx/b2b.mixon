<?php

namespace Modules\Account\Exports;

use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CartGoodsExport implements FromCollection, ShouldAutoSize
{
    public function __construct(private Collection $items)
    {

    }

    public function collection(): Collection
    {
        return $this->items->map(fn(array $g) => ['sku' => $g['sku'], 'qty' => $g['qty'], 'price' => $g['salePrice'], 'name' => $g['name']]);
    }
}
