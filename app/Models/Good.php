<?php

namespace App\Models;

use App\Models\Goods\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Good extends Model
{
    protected $fillable = ['category_id', 'sku', 'name', 'rrp'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_has_goods', 'sku', 'department_id', 'sku', 'id')->withPivot('qty');
    }
}
