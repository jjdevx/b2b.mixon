<?php

namespace App\Models;

use App\Models\Goods\Category;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\CanBeBought;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Good extends Model implements Buyable
{
    use CanBeBought;

    protected $fillable = ['category_id', 'sku', 'name', 'rrp'];

    public function getBuyablePrice($options = null)
    {
        return $this->salePrice;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_has_goods', 'sku', 'department_id', 'sku', 'id')->withPivot('qty');
    }
}
