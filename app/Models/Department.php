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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'department_has_users');
    }
}
