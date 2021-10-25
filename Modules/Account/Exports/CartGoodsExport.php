<?php

namespace Modules\Account\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CartGoodsExport implements FromCollection, ShouldAutoSize, WithStyles
{
    public function __construct(private Collection $items, private User $user, private array $data)
    {

    }

    public function collection(): Collection
    {
        $items = collect([
            ['Код товара', 'Количество', 'Сумма', 'Наименование']
        ]);

        $items = $items->merge($this->items->map(
            fn(array $g) => ['sku' => $g['sku'], 'qty' => $g['qty'], 'price' => $g['salePrice'], 'name' => $g['name']])
        );

        $items->push(['']);
        $items->push(['Общее количество, ед.:', $this->data['qty']]);
        $items->push(['Cумма(РРЦ) UAH:', $this->data['rrp']]);
        $items->push(['Ваша стоимость (фактическая стоимость):', $this->data['total']]);
        $items->push(['Общий вес, кг.:', $this->data['weight']]);
        $items->push(['Общий объем, м².:', $this->data['volume']]);
        $items->push(['']);
        $items->push(['О клиенте:']);
        $items->push(['Телефон:', $this->user->phone]);
        $items->push(['Факс:', $this->user->fax]);
        $items->push(['Почта:', $this->user->email]);
        $items->push(['Компания:', $this->user->company]);
        $items->push(['Страна:', $this->user->country]);
        $items->push(['Город:', $this->user->city]);
        $items->push(['Адрес:', $this->user->address]);

        return $items;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            'B' => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER,]
             ]
        ];
    }
}
