<?php

namespace App\Models;

use App\Models\Goods\Category;
use App\Models\Traits\Searchable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Modules\Account\Notifications\VerifyEmailNotification;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory,
        Notifiable,
        HasRoles,
        InteractsWithMedia,
        SoftDeletes,
        CascadeSoftDeletes,
        Searchable;

    public const SALE_SMALL = 'sale_small';
    public const SALE = 'sale';
    public const SALE_BIG = 'sale_big';

    public static array $saleTypes = [
        self::SALE_SMALL => 'Мелкий опт',
        self::SALE => 'Опт',
        self::SALE_BIG => 'Крупный опт'
    ];

    protected $fillable = [
        'name', 'surname',
        'email', 'password',
        'company', 'okpo', 'country', 'city', 'address', 'fax', 'phone',
        'shipping_point', 'sale_type'
    ];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $search = ['id', 'email', 'name', 'surname', 'company'];

    // FUNCTIONS
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('big')
                    ->width(225)
                    ->sharpen(0)
                    ->nonQueued();
                $this->addMediaConversion('icon')
                    ->height(50)
                    ->crop('crop-center', 100, 100)
                    ->sharpen(0)
                    ->nonQueued();
            });
    }

    public function uploadAvatar(UploadedFile $image = null): bool
    {
        if ($this->avatarMedia) {
            $this->deleteMedia($this->avatarMedia);
        }

        return $this->addMedia($image)->toMediaCollection('avatar') !== null;
    }

    public function deleteAvatar(): void
    {
        try {
            $this->deleteMedia($this->avatarMedia);
        } catch (MediaCannotBeDeleted $e) {
            \Log::error('Avatar cannot be deleted: ' . $e->getMessage());
        }
    }

    public function getAvatar(string $size = ''): string
    {
        if ($this->avatarMedia !== null) {
            return $this->avatarMedia->getUrl($size);
        }

        return asset('/dist/img/no-avatar.png');
    }

    // RELATIONS
    public function avatarMedia(): MorphOne|Media
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'avatar');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_has_users');
    }

    public function shippingPoint(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'shipping_point');
    }

    public function availableCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'user_can_view_stocks');
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'user_has_sales')->withPivot('size');
    }

    // ACCESSORS
    public function getFullNameAttribute(): string
    {
        return "$this->surname $this->name";
    }

    public function getIconAttribute(): string
    {
        return $this->getAvatar('icon');
    }
}
