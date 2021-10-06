<?php

namespace Modules\Account\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request = null): array
    {
        /* @var $order Order */
        $order = $this->resource;

        return [
            'id' => $order->id,
            'user' => [
                'name' => $order->user->name,
                'surname' => $order->user->surname,
            ],
            'goodsCount' => $order->goods_count,
            'weight' => $order->weight,
            'volume' => $order->volume,
            'createdAt' => $order->created_at
        ];
    }
}
