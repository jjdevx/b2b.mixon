<?php

namespace Modules\Account\Imports;

use App\Models\Department;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StockImport implements ToCollection
{
    public function __construct(protected Department $department){}

    public function collection(Collection $collection)
    {
        \DB::transaction(function () use ($collection) {
            dd($collection->pluck('1','0'));
        });
    }
}
