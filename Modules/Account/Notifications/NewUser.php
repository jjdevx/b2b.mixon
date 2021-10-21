<?php

namespace Modules\Account\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected User $user)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', TelegramChannel::class];
    }

    public function toMail($notifiable): MailMessage
    {
        $user = $this->user;

        $mail = (new MailMessage)
            ->subject('Регистрация нового пользователя в Mixon')
            ->greeting('Зарегистрировался новый пользователь.')
            ->line(new HtmlString("ID: {$user->id},<br> имя: {$user->name},<br> почта: {$user->email}."));

        if ($phone = $user->phone) {
            $mail->line("Телефон: {$phone}");
        }
        if ($company = $user->company) {
            $mail->line("Компания: {$company}");
        }
        if ($city = $user->city) {
            $mail->line("Город: {$city} {$user->country}.");
        }

        $mail->action('Просмотреть', $this->getUrl());

        return $mail;
    }

    public function toTelegram($channel): TelegramMessage
    {
        $message = "Регистрация нового пользователя\n\n";

        $user = $this->user;
        $url = $this->getUrl();

        $message .= "Имя: {$user->name} {$user->surname}\nID: {$user->id}\nпочта: {$user->email}\n";
        if ($phone = $user->phone) {
            $message .= "Телефон: $phone\n\n";
        }
        $message .= "[Просмотреть]($url)";

        return TelegramMessage::create()
            ->to($channel->routeNotificationFor('telegram'))
            ->content($message);
    }

    protected function getUrl(): string
    {
        return route('account.users.edit', $this->user->id);
    }
}
