<?php

namespace Modules\Account\Exports;

use App\Models\Good;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderGoodsExport implements FromCollection, ShouldAutoSize, WithStyles
{
    public function __construct(private Collection $items, private User $user, private Order $order)
    {

    }

    public function collection(): Collection
    {
        $items = collect([
            ['Код товара', 'Количество', 'Сумма', 'Наименование']
        ]);

        $items = $items->merge(
            $this->items->map(fn(Good $g) => ['sku' => $g->sku, 'qty' => $g->pivot->qty, 'price' => $g->pivot->price, 'name' => $g->name])
        );

        $items->push(['']);
        $items->push(['Общее количество, ед.:', $this->order->qty]);
        $items->push(['Cумма(РРЦ) UAH:', $this->order->rrp]);
        $items->push(['Ваша стоимость (фактическая стоимость):', $this->order->total]);
        $items->push(['Общий вес, кг.:', $this->order->weight]);
        $items->push(['Общий объем, м².:', $this->order->volume]);
        $items->push(['Форма расчета:', Order::$billing[$this->order->billing]]);
        $items->push(['Тип заказа:', Order::$types[$this->order->type]]);
        $items->push(['Примечание:', $this->order->comment]);
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
