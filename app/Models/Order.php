<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    public const CASH = 'CASH';
    public const CASHLESS = 'CASHLESS';

    public static array $billing = [
        self::CASH => 'Наличный',
        self::CASHLESS => 'Безналичный',
    ];

    public const CURRENT = 'CURRENT';
    public const PRELIMINARY = 'PRELIMINARY';
    public const SPECIAL = 'SPECIAL';

    public static array $types = [
        self::CURRENT => 'Текущий',
        self::PRELIMINARY => 'Предварительный',
        self::SPECIAL => 'Спец',
    ];

    public const UPDATED_AT = null;

    protected $fillable = ['billing', 'type', 'comment', 'total', 'qty', 'weight', 'volume'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class, 'order_items')->withPivot(['qty', 'price', 'weight', 'volume']);
    }
}
