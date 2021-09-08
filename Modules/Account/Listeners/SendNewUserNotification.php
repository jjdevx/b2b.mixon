<?php

namespace Modules\Account\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Modules\Account\Notifications\NewUser;

class SendNewUserNotification
{
    public function handle(Registered $event): void
    {
        $notification = new NewUser($event->user);

        User::whereHas('roles', fn($q) => $q->where('name', '=', 'admin'))->get()->each(
            fn(User $u) => \Notification::route('mail', $u->email)->notify($notification)
        );

        \Notification::route('telegram', config('account.telegram_channel_id'))->notify($notification);
    }
}
