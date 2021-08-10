<?php

namespace Modules\Account\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request = null): array
    {
        /* @var $user User */
        $user = $this->resource;

        return [
            'id' => $user->id,
            'icon' => $this->when($user->relationLoaded('avatarMedia'), fn() => $user->icon),
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'emailVerified' => $user->hasVerifiedEmail(),
            'company' => $user->company,
            'okpo' => $user->okpo,
            'country' => $user->country,
            'city' => $user->city,
            'address' => $user->address,
            'fax' => $user->fax,
            'phone' => $user->phone,
            'roles' => $this->when($user->relationLoaded('roles'), fn() => $user->roles->pluck('label'))
        ];
    }
}
