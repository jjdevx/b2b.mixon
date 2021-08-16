<?php

namespace App\Models;

use App\Models\Goods\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Good extends Model
{
    protected $fillable = ['category_id', 'sku', 'name', 'rrp'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
