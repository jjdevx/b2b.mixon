<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    public const BRANCH = 'branch';
    public const OFFICE = 'office';
    public const SHOP = 'shop';

    public static array $types = [
        self::BRANCH => 'Филиал',
        self::OFFICE => 'Отдел Продаж',
        self::SHOP => 'Магазин'
    ];

    protected $fillable = ['name', 'type'];

    protected $casts = ['stock_updated_at' => 'timestamp'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'department_has_users');
    }

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class, 'department_has_goods', 'department_id', 'sku', 'id', 'sku');
    }
}
