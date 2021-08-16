<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    public static array $types = [
        'branch' => 'Филиал',
        'office' => 'Офис',
        'shop' => 'Магазин'
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
