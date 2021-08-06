<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $table = 'goods_groups';

    protected $fillable = ['name'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
