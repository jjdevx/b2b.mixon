<?php

namespace App\Models\Goods;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'goods_categories';

    protected $fillable = ['id', 'group_id', 'name', 'sale_small', 'sale', 'sale_big'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }
}
